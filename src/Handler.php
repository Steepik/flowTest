<?php

namespace Steepik\Calc;

interface Handler
{
    public function handle(DTO $context): void;
}
