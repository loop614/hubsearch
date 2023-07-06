<?php declare(strict_types=1);

namespace App\Score\Validator;

interface ScoreTermValidatorInterface
{
    /**
     * @param string|bool $termInput
     *
     * @return bool
     */
    public function validateScoreTerm(string|bool $termInput): bool;
}
