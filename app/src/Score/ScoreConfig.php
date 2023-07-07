<?php declare(strict_types=1);

namespace App\Score;

use App\Core\CoreConfig;

final class ScoreConfig extends CoreConfig
{
    public const POSITIVE_WORDS = ['rocks'];

    public const NEGATIVE_WORDS = ['sucks'];

    private const MAX_TERM_SIZE = 16;

    /**
     * @return int
     */
    public function getMaxTermSize(): int
    {
        return self::MAX_TERM_SIZE;
    }
}
