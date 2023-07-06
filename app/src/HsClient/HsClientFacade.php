<?php declare(strict_types = 1);

namespace App\HsClient;

use App\Core\CoreFacade;
use App\HsClient\Transfer\HsClientResponseTransfer;
use App\HsClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\Score\Transfer\ScoreTransfer;

/**
 * @method \App\HsClient\HsClientFactory getFactory()
 */
final class HsClientFacade extends CoreFacade implements HsClientFacadeInterface
{
    /**
     * @param ScoreTransfer $scoreData
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws StrategyNotFoundException
     *
     * @return HsClientResponseTransfer
     */
    public function getResponseData(ScoreTransfer $scoreData): HsClientResponseTransfer
    {
        return $this->getFactory()
            ->createHsClient()
            ->getResponseData($scoreData);
    }
}
