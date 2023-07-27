<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\HubSearchClient\HubSearchClientFacadeInterface;
use App\HubSearchClient\Model\Strategy\Exception\HubSearchClientStrategyException;
use App\HubSearchRedis\HubSearchRedisFacadeInterface;
use App\Score\ScoreConfig;
use App\Score\Transfer\ScoreTransfer;

final class Score implements ScoreInterface
{
    /**
     * @param \App\HubSearchRedis\HubSearchRedisFacadeInterface $HubSearchRedisFacade
     * @param \App\HubSearchClient\HubSearchClientFacadeInterface $HubSearchClientFacade
     */
    public function __construct(
        private readonly HubSearchRedisFacadeInterface  $HubSearchRedisFacade,
        private readonly HubSearchClientFacadeInterface $HubSearchClientFacade
    ) {}

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    public function hydrateScore(ScoreTransfer $scoreData): ScoreTransfer
    {
        $scoreData = $this->HubSearchRedisFacade->hydrateScore($scoreData);
        if ($scoreData->getScore() !== null) {
            $scoreData->setMessage('Found this in the basement');
            return $scoreData;
        }

        try {
            $clientResponse = $this->HubSearchClientFacade->getResponseData($scoreData);
        } catch (HubSearchClientStrategyException $e) {
            $scoreData->setMessage('Not a good day for ' . $scoreData->getSite() . '. ' . $e->getMessage());
            return $scoreData;
        }

        $scoreData = $this->calculateScore($scoreData, $clientResponse->getTexts());
        $this->HubSearchRedisFacade->setScore($scoreData);

        return $scoreData;
    }

    /**
     * @param \App\Score\Transfer\ScoreTransfer $scoreData
     * @param array                             $texts
     *
     * @return \App\Score\Transfer\ScoreTransfer
     */
    private function calculateScore(ScoreTransfer $scoreData, array $texts): ScoreTransfer
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
