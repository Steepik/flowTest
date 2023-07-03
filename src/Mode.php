<?php

namespace Steepik\Calc;

interface Mode
{
    public function calc(int $a, int $b): int;
    public function isValid(int $total): bool;
    public function name(): string;
}
