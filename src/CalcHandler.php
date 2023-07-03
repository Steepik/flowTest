<?php

declare(strict_types=1);

namespace Steepik\Calc;

use Steepik\Calc\Logger\LoggerFactory;
use Steepik\Calc\Logger\LoggerInfo;
use Steepik\Calc\Modes\Add;
use Steepik\Calc\Modes\Division;
use Steepik\Calc\Modes\Multiply;
use Steepik\Calc\Modes\Substract;

final class CalcHandler implements Handler
{
    private int $result = 0;
    private array $validCombinations = [];
    private array $invalidCombinations = [];
    private int $iterateNum = 0;

    public function handle(DTO $context): void
    {
        while (count($this->validCombinations) !== count($this->getModes())) {
            $modes = $this->getModes();
            $this->validCombinations = [];
            $hash = uniqid();

            foreach ($modes as $mode) {
                if ($mode->isValid($this->result)) {
                    $this->result = $mode->calc($context->firstNum, $context->secondNum);

                    $this->validCombinations[] = [
                        'mode' => $mode->name(),
                        'calcResult' => $this->result,
                    ];
                }

                $this->invalidCombinations[$hash][] = $mode->name();

                if (count($this->validCombinations) === count($this->getModes())) {
                    $this->invalidCombinations[$hash] = [];
                }
            }

            $this->iterateNum++;
        }

        $logger = LoggerFactory::create(php_sapi_name());
        $logger->debug(
            $context,
            new LoggerInfo(
                $this->validCombinations,
                $this->invalidCombinations,
                $this->iterateNum,
            )
        );
    }

    /**
     * @return array<Mode>
     */
    private function getModes(): array
    {
        $modes = [
            new Division(),
            new Add(),
            new Multiply(),
            new Substract(),
        ];

        shuffle($modes);

        return $modes;
    }
}
