<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing;

use Tavaan\Core\Contracts\Container\ContainerInterface;
use Tavaan\Core\Contracts\Config\RepositoryInterface as ConfigRepository;
use Tavaan\Engine\Http\Routing\Contracts\RouterInterface;
use Tavaan\Core\Provider\ServiceProvider;

/**
 * RouterServiceProvider — ثبت سرویس‌های موتور Router.
 */
final class RouterServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->singleton(RouterInterface::class, function (ContainerInterface $app) {
            /** @var ConfigRepository $config */
            $config = $app->get(ConfigRepository::class);
            return new Router($config);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        // ثبت Facade
        $this->app->instance('router', $this->app->get(RouterInterface::class));

        // ثبت commandها
        $this->commands[] = \Tavaan\Engine\Http\Routing\Console\Route_listCommand::class;
        $this->commands[] = \Tavaan\Engine\Http\Routing\Console\Route_cacheCommand::class;
        $this->commands[] = \Tavaan\Engine\Http\Routing\Console\Route_clearCommand::class;
        $this->commands[] = \Tavaan\Engine\Http\Routing\Console\Route_matchCommand::class;

    }

    /**
     * {@inheritdoc}
     */
    public function provides(): array
    {
        return [
            RouterInterface::class,
            'router',
        ];
    }
}