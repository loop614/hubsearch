<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsRedis\HsRedisFacade;
use App\Score\ScoreData;

class HsClient implements HsClientInterface
{
    private DazzleClient $dazzleClient;
    private HsRedisFacade $hsRedisFacade;

    /**
     * @param DazzleClient $dazzleClient
     */
    public function __construct(DazzleClient $dazzleClient)
    {
        $this->dazzleClient = $dazzleClient;
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return float
     */
    public function getScore(ScoreData $scoreData): ScoreData
    {
        // get dazzle get my values

        // set it to redis
        $this->hsRedisFacade->setKey($scoreData, 11.11);
        $scoreData->setScore(11.11);

        return $scoreData;
    }
}
