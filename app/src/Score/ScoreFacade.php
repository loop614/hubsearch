<?php declare(strict_types=1);

namespace App\Score;

use App\Score\Model\ScoreInterface;
use App\Score\Transfer\ScoreTransfer;

class ScoreFacade implements ScoreFacadeInterface
{
    /**
     * @param \App\Score\Model\ScoreInterface $score
     */
    public function __construct(private readonly ScoreInterface $score) {}

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreTransfer
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreTransfer): ScoreTransfer
    {
        return $this->score->hydrateScore($scoreTransfer);
    }
}
