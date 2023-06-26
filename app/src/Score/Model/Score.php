<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\HsClient\HsClientFacadeInterface;
use App\HsRedis\HsRedisFacadeInterface;
use App\Score\ScoreData;

class Score implements ScoreInterface
{
    /**
     * @var HsRedisFacadeInterface
     */
    private HsRedisFacadeInterface $hsRedisFacade;

    /**
     * @var HsClientFacadeInterface
     */
    private HsClientFacadeInterface $hsClientFacade;

    /**
     * @param HsRedisFacadeInterface $hsRedisFacade
     * @param HsClientFacadeInterface $hsClientFacade
     */
    public function __construct(HsRedisFacadeInterface $hsRedisFacade, HsClientFacadeInterface $hsClientFacade)
    {
        $this->hsRedisFacade = $hsRedisFacade;
        $this->hsClientFacade = $hsClientFacade;
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return ScoreData
     */
    public function getScore(ScoreData $scoreData): ScoreData
    {
        $scoreData = $this->hsRedisFacade->getScore($scoreData);

        if (!$scoreData->getScore()) {
            $scoreData = $this->hsClientFacade->getScore($scoreData);
        }

        return $scoreData;
    }
}
