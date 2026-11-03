<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing\Console;

use Tavaan\Core\Contracts\Console\CommandInterface;

/**
 * route:match command.
 */
final class RouteMatchCommand implements CommandInterface
{
    public function name(): string
    {
        return 'route:match';
    }

    public function description(): string
    {
        return 'Run route:match (TODO: fill description).';
    }

    public function handle(array $args = []): int
    {
        // TODO: پیاده‌سازی command مطابق مستندات.
        return 0;
    }
}
