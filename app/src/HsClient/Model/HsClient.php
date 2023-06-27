<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsClient\Carry\HsClientResponseData;
use App\HsClient\Model\Strategy\Exception\StrategyNotFoundException;
use App\HsClient\Model\Strategy\SiteStrategyInterface;
use App\Score\Carry\ScoreData;

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
     * @param ScoreData $scoreData
     *
     * @throws StrategyNotFoundException
     *
     * @return HsClientResponseData
     */
    public function getResponseData(ScoreData $scoreData): HsClientResponseData
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
