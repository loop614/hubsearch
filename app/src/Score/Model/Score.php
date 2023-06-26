<?php declare(strict_types = 1);

namespace App\Score\Model;

use App\HsClient\HsClientFacadeInterface;
use App\HsRedis\HsRedisFacadeInterface;

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
     * @param string $term
     *
     * @return float
     */
    public function getKeyByTerm(string $term): float
    {
        $score = $this->hsRedisFacade->getScoreByTerm($term);

        if (!$score) {
            $score = $this->hsClientFacade->getScoreForTerm($term);
        }

        return $score;
    }
}
