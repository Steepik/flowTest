<?php

namespace Steepik\Calc;

use Steepik\Calc\Logger\LoggerInfo;

interface Loggerable
{
    public function debug(DTO $numbers, LoggerInfo $loggerInfo): void;
}
