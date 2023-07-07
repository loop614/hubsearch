<?php declare(strict_types=1);

namespace App\Score\Validator;

use App\Core\Validator\CoreValidator;

/**
 * @method \App\Score\ScoreConfig getConfig()
 */
class ScoreTermValidator extends CoreValidator implements ScoreTermValidatorInterface
{
    /**
     * @param string|bool $termInput
     *
     * @return bool
     */
    public function validateScoreTerm(string|bool $termInput): bool
    {
        return $termInput && strlen($termInput) < $this->getConfig()->getMaxTermSize();
    }
}
