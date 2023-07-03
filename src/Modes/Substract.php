<?php

declare(strict_types=1);

namespace Steepik\Calc\Modes;

use Steepik\Calc\Mode;

final class Substract implements Mode
{
    public function calc(int $a, int $b): int
    {
        return $a - $b;
    }

    public function isValid(int $total): bool
    {
        return $total < 1000;
    }

    public function name(): string
    {
        return 'вычитание';
    }
}
