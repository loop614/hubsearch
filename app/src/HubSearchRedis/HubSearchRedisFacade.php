<?php declare(strict_types = 1);

namespace App\HubSearchRedis;

use App\HubSearchRedis\Model\HubSearchRedisInterface;
use App\Score\Transfer\ScoreTransfer;

final class HubSearchRedisFacade implements HubSearchRedisFacadeInterface
{
    /**
     * @param \App\HubSearchRedis\Model\HubSearchRedisInterface $HubSearchRedis
     */
    public function __construct(private readonly HubSearchRedisInterface $HubSearchRedis) {}

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer
    {
        return $this->HubSearchRedis->hydrateScore($scoreData);
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return void
     */
    public function setScore(ScoreTransfer $scoreData): void
    {
        $this->HubSearchRedis->setScore($scoreData);
    }
}
