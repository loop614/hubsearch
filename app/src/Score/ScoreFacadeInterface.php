<?php declare(strict_types=1);

namespace App\Score;

use App\Score\Transfer\ScoreTransfer;

interface ScoreFacadeInterface
{
    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreTransfer
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreTransfer): ScoreTransfer;
}
