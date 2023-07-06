<?php declare(strict_types=1);

namespace App\Score;

use App\Core\CoreConfig;

final class ScoreConfig extends CoreConfig
{
    public const POSITIVE_WORDS = ['rocks'];

    public const NEGATIVE_WORDS = ['sucks'];
}
