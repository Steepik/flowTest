<?php

declare(strict_types=1);

namespace Steepik\Calc;

final class DTO
{
    public function __construct(
        public readonly int $firstNum,
        public readonly int $secondNum,
    ) {
    }
}
