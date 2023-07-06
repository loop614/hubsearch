<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsClient\Transfer\HsClientResponseTransfer;
use App\HsClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\HsClient\Model\Strategy\SiteStrategyInterface;
use App\Score\Transfer\ScoreTransfer;

class HsClient implements HsClientInterface
{
    /**
     * @var array
     */
    private array $strategys;

    /**
     * @param SiteStrategyInterface[] $strategys
     */
    public function __construct(array $strategys)
    {
        $this->strategys = $strategys;
    }

    /**
     * @param ScoreTransfer $scoreData
     *
     * @throws StrategyNotFoundException
     *
     * @return HsClientResponseTransfer
     */
    public function getResponseData(ScoreTransfer $scoreData): HsClientResponseTransfer
    {
        foreach ($this->strategys as $strategy) {
            if ($strategy->isApplicable($scoreData)) {
                $token = $strategy->authenticate();
                return $strategy->fetchData($scoreData, $token);
            }
        }

        throw new StrategyNotFoundException();
    }
}
