<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsRedis\HsRedisFacade;

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
     * @param string $term
     *
     * @return float
     */
    public function getScoreForTerm(string $term): float
    {
        $this->hsRedisFacade->setKeyByTerm($term);
        return 11.11;
    }
}
