<?php

declare(strict_types=1);

namespace Tavaan\Engine\Http\Routing\Console;

use Tavaan\Core\Contracts\Console\CommandInterface;

/**
 * route:clear command.
 */
final class RouteClearCommand implements CommandInterface
{
    public function name(): string
    {
        return 'route:clear';
    }

    public function description(): string
    {
        return 'Run route:clear (TODO: fill description).';
    }

    public function handle(array $args = []): int
    {
        // TODO: پیاده‌سازی command مطابق مستندات.
        return 0;
    }
}
