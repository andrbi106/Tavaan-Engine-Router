<?php
declare(strict_types=1);
namespace Tavaan\Engine\Http\Routing;

final class Route
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly mixed $action,
        public readonly string $name = '',
        public array $middleware = [],
        public ?array $where = null,
    ) {}

    public function name(string $name): self
    {
        return new self($this->method, $this->uri, $this->action, $name, $this->middleware, $this->where);
    }

    public function middleware(array|string $mw): self
    {
        return new self($this->method, $this->uri, $this->action, $this->name, array_merge($this->middleware, (array)$mw), $this->where);
    }

    public function where(string $param, string $pattern): self
    {
        $where = ($this->where ?? []) + [$param => $pattern];
        return new self($this->method, $this->uri, $this->action, $this->name, $this->middleware, $where);
    }
}

final class RouteCollection
{
    private array $routes = [];
    private array $namedRoutes = [];

    public function add(Route $route): void
    {
        $this->routes[] = $route;
        if ($route->name !== '') $this->namedRoutes[$route->name] = $route;
    }

    public function match(string $method, string $uri): ?Route
    {
        foreach ($this->routes as $route) {
            if ($this->matches($route, $method, $uri)) return $route;
        }
        return null;
    }

    private function matches(Route $route, string $method, string $uri): bool
    {
        if (strcasecmp($route->method, $method) !== 0 && $route->method !== 'ANY') return false;
        $pattern = $this->compilePattern($route);
        return (bool) preg_match($pattern, $uri);
    }

    private function compilePattern(Route $route): string
    {
        $pattern = $route->uri;
        // Replace {param} with named capture groups
        $pattern = preg_replace_callback('/\{(\w+)(\?)?\}/', function($m) use ($route) {
            $name = $m[1];
            $optional = $m[2] ?? '';
            $constraint = $route->where[$name] ?? '[^/]+';
            return "(?P<{$name}>{$constraint})" . ($optional ? '?' : '');
        }, $pattern);
        return '#^' . $pattern . '$#u';
    }

    public function getRoute(string $name): ?Route
    {
        return $this->namedRoutes[$name] ?? null;
    }

    public function all(): array { return $this->routes; }
}

final class UrlGenerator
{
    public function __construct(private readonly RouteCollection $routes) {}

    public function route(string $name, array $params = []): ?string
    {
        $route = $this->routes->getRoute($name);
        if ($route === null) return null;
        $uri = $route->uri;
        foreach ($params as $key => $value) {
            $uri = str_replace('{' . $key . '}', (string)$value, $uri);
            $uri = str_replace('{' . $key . '?}', (string)$value, $uri);
        }
        return $uri;
    }
}

final class Router
{
    private RouteCollection $routes;
    private ?UrlGenerator $generator = null;
    private array $groupStack = [];

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function get(string $uri, mixed $action): Route
    {
        return $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, mixed $action): Route
    {
        return $this->addRoute('POST', $uri, $action);
    }

    public function put(string $uri, mixed $action): Route
    {
        return $this->addRoute('PUT', $uri, $action);
    }

    public function patch(string $uri, mixed $action): Route
    {
        return $this->addRoute('PATCH', $uri, $action);
    }

    public function delete(string $uri, mixed $action): Route
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function any(string $uri, mixed $action): Route
    {
        return $this->addRoute('ANY', $uri, $action);
    }

    public function match(array $methods, string $uri, mixed $action): Route
    {
        return $this->addRoute(implode('|', $methods), $uri, $action);
    }

    public function resource(string $name, string $controller): void
    {
        $this->get("/{$name}", [$controller, 'index'])->name("{$name}.index");
        $this->get("/{$name}/create", [$controller, 'create'])->name("{$name}.create");
        $this->post("/{$name}", [$controller, 'store'])->name("{$name}.store");
        $this->get("/{$name}/{{$name}}", [$controller, 'show'])->name("{$name}.show");
        $this->get("/{$name}/{{$name}}/edit", [$controller, 'edit'])->name("{$name}.edit");
        $this->put("/{$name}/{{$name}}", [$controller, 'update'])->name("{$name}.update");
        $this->delete("/{$name}/{{$name}}", [$controller, 'destroy'])->name("{$name}.destroy");
    }

    public function apiResource(string $name, string $controller): void
    {
        $this->get("/{$name}", [$controller, 'index'])->name("{$name}.index");
        $this->post("/{$name}", [$controller, 'store'])->name("{$name}.store");
        $this->get("/{$name}/{{$name}}", [$controller, 'show'])->name("{$name}.show");
        $this->put("/{$name}/{{$name}}", [$controller, 'update'])->name("{$name}.update");
        $this->delete("/{$name}/{{$name}}", [$controller, 'destroy'])->name("{$name}.destroy");
    }

    public function group(array $attributes, callable $callback): void
    {
        $this->groupStack[] = $attributes;
        $callback($this);
        array_pop($this->groupStack);
    }

    public function dispatch(string $method, string $uri): mixed
    {
        $route = $this->routes->match($method, $uri);
        if ($route === null) return null;
        // Extract params
        $params = [];
        $pattern = preg_replace_callback('/\{(\w+)(\?)?\}/', function($m) use (&$params, $route) {
            return '(?P<' . $m[1] . '>[^/]+)';
        }, $route->uri);
        if (preg_match('#^' . $pattern . '$#u', $uri, $matches)) {
            foreach ($matches as $k => $v) {
                if (!is_int($k)) $params[$k] = $v;
            }
        }
        return ['route' => $route, 'params' => $params];
    }

    public function getRoutes(): RouteCollection { return $this->routes; }

    public function url(string $name, array $params = []): ?string
    {
        if ($this->generator === null) $this->generator = new UrlGenerator($this->routes);
        return $this->generator->route($name, $params);
    }

    private function addRoute(string $method, string $uri, mixed $action): Route
    {
        // Apply group prefix
        $prefix = '';
        $middleware = [];
        foreach ($this->groupStack as $group) {
            if (isset($group['prefix'])) $prefix .= '/' . trim($group['prefix'], '/');
            if (isset($group['middleware'])) $middleware = array_merge($middleware, (array)$group['middleware']);
        }
        $fullUri = $prefix ? $prefix . $uri : $uri;
        $route = new Route($method, $fullUri, $action, middleware: $middleware);
        $this->routes->add($route);
        return $route;
    }
}

final class RouterServiceProvider
{
    private ?Router $router = null;
    public function __construct(private readonly array $config = []) {}
    public function register(): void { $this->router = new Router(); }
    public function boot(): void {}
    public function provides(): array { return [Router::class, Route::class]; }
    public function getRouter(): Router { if ($this->router === null) $this->register(); return $this->router; }
}
