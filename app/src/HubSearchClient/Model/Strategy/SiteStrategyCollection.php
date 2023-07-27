<?php declare(strict_types = 1);

namespace App\HubSearchClient\Model\Strategy;

class SiteStrategyCollection
{
    public function __construct(private readonly SiteStrategyInterface $githubStrategy) {}

    /**
     * @return SiteStrategyInterface[]
     */
    public function getAll(): array
    {
        return [
            $this->githubStrategy,
        ];
    }
}
