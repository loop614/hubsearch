<?php declare(strict_types = 1);

namespace App\HsClient;

class HsClientFacade implements HsClientFacadeInterface
{
    /**
     * @param string $term
     * @return float
     */
    public function getScoreForTerm(string $term): float
    {
        return HsClientFactory::createHsClient()
            ->getScoreForTerm($term);
    }
}
