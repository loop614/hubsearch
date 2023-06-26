<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\HsClient\HsClientFacadeInterface;
use App\HsRedis\HsRedisFacadeInterface;
use App\Score\ScoreConfig;
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
    public function hydrateScore(ScoreData $scoreData): ScoreData
    {
        $scoreData = $this->hsRedisFacade->getScore($scoreData);
        if (!$scoreData->getScore()) {
            $texts = $this->hsClientFacade->getTexts($scoreData);
            $score = $this->calculateScore($texts);
            $scoreData->setScore($score);
            $this->hsRedisFacade->setScore($scoreData);
        }

        return $scoreData;
    }

    /**
     * @param string[] $texts
     *
     * @return float
     */
    private function calculateScore(array $texts): float
    {
        $countPositive = 0;
        $countNegative = 0;
        foreach ($texts as $text) {
            foreach (ScoreConfig::POSITIVE_WORDS as $positive) {
                $countPositive += substr_count($text, $positive);
            }

            foreach (ScoreConfig::NEGATIVE_WORDS as $negative) {
                $countNegative += substr_count($text, $negative);
            }
        }
        $dt = 10 / ($countPositive + $countNegative);

        return $countPositive * $dt;
    }
}
