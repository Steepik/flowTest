<?php

declare(strict_types=1);

namespace Steepik\Calc\Logger;

use Steepik\Calc\DTO;
use Steepik\Calc\Loggerable;

final class LoggerCli implements Loggerable
{
    private string $output = '';

    public function debug(DTO $numbers, LoggerInfo $loggerInfo): void
    {
        $this->output .= $this->greenColor('Найдена удачная комбинация:') . PHP_EOL;
        $this->output .= 'Число 1 - ' . $numbers->firstNum . PHP_EOL;
        $this->output .= 'Число 2 - ' . $numbers->secondNum . PHP_EOL;

        $this->output .= $this->greenColor('Последовательность действий:') . PHP_EOL;
        $this->output .= $this->yellowColor(implode(' ', array_column($loggerInfo->validCombinations, 'mode'))) . PHP_EOL;
        $this->output .= $this->greenColor('Выполнено итераций ' . $loggerInfo->iterationCount) . PHP_EOL;

        $this->output .= 'Лог выполнения:' . PHP_EOL;
        $this->output .= 'Текущий результат 0' . PHP_EOL;

        foreach ($loggerInfo->validCombinations as $validCombination) {
            $this->output .= 'Выполенено действие: ' . $validCombination['mode'] . '. Рузультат ' . $validCombination['calcResult'] . PHP_EOL;
            $this->output .= 'Текущий результат ' . $validCombination['calcResult'] . PHP_EOL;
        }

        if (count($loggerInfo->invalidCombinations) >= 6) {
            $this->output .= $this->redColor('Неудачные комбинации: ') . PHP_EOL;

            foreach ($loggerInfo->invalidCombinations as $invalidCombination) {
                $this->output .= $this->redColor(implode(' ', $invalidCombination)) . PHP_EOL;
            }
        }

        echo $this->output;
    }

    private function greenColor(string $str): string
    {
        return "\033[32m$str\033[0m";
    }

    private function yellowColor(string $str): string
    {
        return "\033[33m$str\033[0m";
    }

    private function redColor(string $str): string
    {
        return "\033[31m$str\033[0m";
    }
}
