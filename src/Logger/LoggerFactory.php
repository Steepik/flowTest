<?php

declare(strict_types=1);

namespace Steepik\Calc\Logger;

use Steepik\Calc\Loggerable;

final class LoggerFactory
{
    public static function create(string $entryPoint): Loggerable
    {
        return match($entryPoint) {
            'cli' => new LoggerCli(),
            default => new LoggerHtml(),
        };
    }
}
