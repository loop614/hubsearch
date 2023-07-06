<?php declare(strict_types=1);

namespace App\Score;

use App\Core\CoreFacade;
use App\Score\Transfer\ScoreTransfer;

/**
 * @method \App\Score\ScoreFactory getFactory()
 */
class ScoreFacade extends CoreFacade implements ScoreFacadeInterface
{
    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreTransfer
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreTransfer): ScoreTransfer
    {
        return $this->getFactory()->createScore()->hydrateScore($scoreTransfer);
    }
}
