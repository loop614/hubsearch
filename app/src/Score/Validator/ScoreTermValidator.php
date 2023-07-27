<?php declare(strict_types=1);

namespace App\Score\Validator;

use App\Score\ScoreConfig;

class ScoreTermValidator implements ScoreTermValidatorInterface
{
    /**
     * @param string|bool $termInput
     *
     * @return bool
     */
    public function validateScoreTerm(string|bool $termInput): bool
    {
        return $termInput && strlen($termInput) < ScoreConfig::MAX_TERM_SIZE;
    }
}
