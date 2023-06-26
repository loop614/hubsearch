<?php declare(strict_types = 1);

namespace App\HsRedis;

use App\HsClient\HsClientFacade;
use App\HsClient\HsClientFacadeInterface;
use App\Score\Model\Score;
use App\Score\Model\ScoreInterface;

class ScoreFactory
{
    /**
     * @return ScoreInterface
     */
    public function createScore(): ScoreInterface
    {
        return new Score($this->createHsRedisFacade(), $this->createHsClientFacade());
    }

    /**
     * @return HsRedisFacadeInterface
     */
    private function createHsRedisFacade(): HsRedisFacadeInterface
    {
        return new HsRedisFacade();
    }

    /**
     * @return HsClientFacadeInterface
     */
    private function createHsClientFacade(): HsClientFacadeInterface
    {
        return new HsClientFacade();
    }
}
