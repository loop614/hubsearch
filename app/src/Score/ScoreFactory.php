<?php declare(strict_types = 1);

namespace App\Score;

use App\Core\CoreFactory;
use App\HsClient\HsClientFacade;
use App\HsClient\HsClientFacadeInterface;
use App\HsRedis\HsRedisFacade;
use App\HsRedis\HsRedisFacadeInterface;
use App\Score\Model\Score;
use App\Score\Model\ScoreInterface;
use App\Score\Validator\ScoreTermValidator;
use App\Score\Validator\ScoreTermValidatorInterface;

class ScoreFactory extends CoreFactory
{
    /**
     * @return \App\Score\Model\ScoreInterface
     */
    public function createScore(): ScoreInterface
    {
        return new Score($this->createHsRedisFacade(), $this->createHsClientFacade());
    }

    /**
     * @return \App\Score\Validator\ScoreTermValidatorInterface
     */
    public function createScoreTermValidator(): ScoreTermValidatorInterface
    {
        return new ScoreTermValidator();
    }

    /**
     * @return \App\HsRedis\HsRedisFacadeInterface
     */
    private function createHsRedisFacade(): HsRedisFacadeInterface
    {
        return new HsRedisFacade();
    }

    /**
     * @return \App\HsClient\HsClientFacadeInterface
     */
    private function createHsClientFacade(): HsClientFacadeInterface
    {
        return new HsClientFacade();
    }
}
