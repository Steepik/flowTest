<?php

declare(strict_types=1);

namespace Steepik\Calc;

use Steepik\Calc\Logger\LoggerFactory;
use Steepik\Calc\Logger\LoggerInfo;

final class CalcHandler implements Handler
{
    private int $result = 0;
    private array $validCombinations = [];
    private array $invalidCombinations = [];
    private int $iterateNum = 0;

    /**
     * @param array<Mode> $modes
     */
    public function __construct(
        private array $modes
    ) {
    }

    public function handle(DTO $context): void
    {
        while (count($this->validCombinations) !== count($this->modes)) {
            $modes = $this->getModesInRandomOrder();
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

                if (count($this->validCombinations) === count($this->modes)) {
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
    private function getModesInRandomOrder(): array
    {
        shuffle($this->modes);

        return $this->modes;
    }
}
