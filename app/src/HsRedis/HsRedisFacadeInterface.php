<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\Score\Transfer\ScoreTransfer;

interface HsRedisFacadeInterface
{
    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer;

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return void
     */
    public function setScore(ScoreTransfer $scoreData): void;
}
