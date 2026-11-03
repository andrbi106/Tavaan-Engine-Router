<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing\Console;

use Tavaan\Core\Contracts\Console\CommandInterface;

/**
 * route:cache command.
 */
final class Route_cacheCommand implements CommandInterface
{
    public function name(): string
    {
        return 'route:cache';
    }

    public function description(): string
    {
        return 'Run route:cache (TODO: fill description).';
    }

    public function handle(array $args = []): int
    {
        // TODO: پیاده‌سازی command مطابق مستندات.
        return 0;
    }
}
