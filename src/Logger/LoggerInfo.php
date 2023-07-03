<?php

declare(strict_types=1);

namespace Steepik\Calc\Logger;

final class LoggerInfo
{
    public function __construct(
        public readonly array $validCombinations,
        public readonly array $invalidCombinations,
        public readonly int $iterationCount,
    ) {
    }
}
