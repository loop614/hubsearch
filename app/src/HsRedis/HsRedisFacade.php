<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\Core\CoreFacade;
use App\Score\Transfer\ScoreTransfer;

/**
 * @method \App\HsRedis\HsRedisFactory getFactory()
 */
final class HsRedisFacade extends CoreFacade implements HsRedisFacadeInterface
{
    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer
    {
        return $this->getFactory()
            ->createHsRedis()
            ->hydrateScore($scoreData);
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return void
     */
    public function setScore(ScoreTransfer $scoreData): void
    {
        $this->getFactory()
            ->createHsRedis()
            ->setScore($scoreData);
    }
}
