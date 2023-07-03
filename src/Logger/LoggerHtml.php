<?php

declare(strict_types=1);

namespace Steepik\Calc\Logger;

use Steepik\Calc\DTO;
use Steepik\Calc\Loggerable;

final class LoggerHtml implements Loggerable
{
    const BR = '<br>';

    private string $output = '';

    public function debug(DTO $numbers, LoggerInfo $loggerInfo): void
    {
        $this->output .= 'Найдена удачная комбинация: ' . self::BR;
        $this->output .= 'Число 1 - ' . $numbers->firstNum . self::BR;
        $this->output .= 'Число 2 - ' . $numbers->secondNum . self::BR;

        $this->output .= 'Последовательность действий:' . '<br/>';
        $this->output .= implode(' ', array_column($loggerInfo->validCombinations, 'mode')) . self::BR;
        $this->output .= 'Выполнено итераций ' . $loggerInfo->iterationCount . self::BR;

        $this->output .= 'Лог выполнения:' . self::BR;
        $this->output .= 'Текущий результат 0' . self::BR;

        foreach ($loggerInfo->validCombinations as $validCombination) {
            $this->output .= 'Выполенено действие: ' . $validCombination['mode'] . '. Рузультат ' . $validCombination['calcResult'] . self::BR;
            $this->output .= 'Текущий результат ' . $validCombination['calcResult'] . self::BR;
        }

        if (count($loggerInfo->invalidCombinations) >= 6) {
            $this->output .= 'Неудачные комбинации: ' . self::BR;

            foreach ($loggerInfo->invalidCombinations as $invalidCombination) {
                $this->output .= implode(' ', $invalidCombination) . self::BR;
            }
        }

        echo $this->output;
    }
}
