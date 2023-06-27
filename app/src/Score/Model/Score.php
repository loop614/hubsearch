<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\HsClient\HsClientFacadeInterface;
use App\HsClient\Model\Strategy\Exception\HsClientStrategyException;
use App\HsRedis\HsRedisFacadeInterface;
use App\Score\ScoreConfig;
use App\Score\Carry\ScoreData;

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
     * @param HsRedisFacadeInterface  $hsRedisFacade
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
    public function hydrateScore(ScoreData $scoreData): ScoreData
    {
        $scoreData = $this->hsRedisFacade->hydrateScore($scoreData);
        if ($scoreData->getScore() !== null) {
            $scoreData->setMessage('Found this in the basement');
            return $scoreData;
        }

        try {
            $clientResponse = $this->hsClientFacade->getResponseData($scoreData);
        } catch (HsClientStrategyException $e) {
            $scoreData->setMessage('Not a good day for ' . $scoreData->getSite() . '. ' . $e->getMessage());
            return $scoreData;
        }

        $scoreData = $this->calculateScore($scoreData, $clientResponse->getTexts());
        $this->hsRedisFacade->setScore($scoreData);

        return $scoreData;
    }

    /**
     * @param string[] $texts
     *
     * @return ScoreData
     */
    private function calculateScore(ScoreData $scoreData, array $texts): ScoreData
    {
        $countPositive = 0;
        $countNegative = 0;
        foreach ($texts as $text) {
            if (!is_string($text)) {
                continue;
            }

            foreach (ScoreConfig::POSITIVE_WORDS as $positive) {
                $countPositive += substr_count($text, $positive);
            }

            foreach (ScoreConfig::NEGATIVE_WORDS as $negative) {
                $countNegative += substr_count($text, $negative);
            }
        }

        $total = $countPositive + $countNegative;
        if ($total > 0) {
            $scoreData->setScore($countPositive * (10 / $total));
            $scoreData->setMessage('Sounds good');
            return $scoreData;
        }

        $scoreData->setScore(0);
        $scoreData->setMessage('Could not say');
        return $scoreData;
    }
}
