<?php declare(strict_types=1);

namespace App\Score\Validator;

use App\Core\Validator\CoreValidator;

class ScoreTermValidator extends CoreValidator implements ScoreTermValidatorInterface
{
    private const MAX_TERM_SIZE = 16;

    /**
     * @param string|bool $termInput
     *
     * @return bool
     */
    public function validateScoreTerm(string|bool $termInput): bool
    {
        return $termInput && strlen($termInput) < self::MAX_TERM_SIZE;
    }
}
