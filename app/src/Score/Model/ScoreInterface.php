<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\Score\Transfer\ScoreTransfer;

interface ScoreInterface
{
    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer;
}
