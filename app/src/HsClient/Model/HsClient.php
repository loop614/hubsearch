<?php declare(strict_types = 1);

namespace App\HsClient\Model;

use App\HsClient\Adapter\SiteAdapterInterface;
use App\HsClient\Exception\AdapterNotFoundException;
use App\Score\ScoreData;

class HsClient implements HsClientInterface
{
    private array $adapters;

    /**
     * @param SiteAdapterInterface[]
     */
    public function __construct(array $adapters)
    {
        $this->adapters = $adapters;
    }

    /**
     * @param ScoreData $scoreData
     *
     * @return array|string[]
     *
     * @throws AdapterNotFoundException
     */
    public function getTexts(ScoreData $scoreData): array
    {
        foreach ($this->adapters as $adapter) {
            if ($adapter->isApplicable($scoreData)) {
                return $adapter->fetchTexts();
            }
        }

        throw new AdapterNotFoundException();
    }
}
