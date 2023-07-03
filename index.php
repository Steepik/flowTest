<?php

require_once 'vendor/autoload.php';

$dto = new \Steepik\Calc\DTO(
    firstNum: rand(500, 2000),
    secondNum: rand(1, 500)
);

$o = new \Steepik\Calc\CalcHandler([
    new \Steepik\Calc\Modes\Add(),
    new \Steepik\Calc\Modes\Division(),
    new \Steepik\Calc\Modes\Substract(),
    new \Steepik\Calc\Modes\Multiply(),
]);
$o->handle($dto);
