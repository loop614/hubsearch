<?php declare(strict_types = 1);

namespace App\HsRedis\Model;

use Predis\Client as PredisClient;

class HsRedis implements HsRedisInterface
{
    /**
     * @var PredisClient
     */
    private PredisClient $predisClient;

    const REDIS_PREFIX = 'kv';
    const GITHUB_PREFIX = 'gh';

    /**
     * @param PredisClient $redisClient
     */
    public function __construct(PredisClient $redisClient)
    {
        $this->predisClient = $redisClient;
    }

    /**
     * @param string $term
     *
     * @return float
     */
    public function getScoreByTerm(string $term): float
    {
        return $this->predisClient->getKey($this->generateKeyForTerm($term));
    }

    /**
     * @param string $term
     * @param float $value
     *
     * @return void
     */
    public function setScoreByTerm(string $term, float $value): void
    {
        $this->predisClient->set($this->generateKeyForTerm($term), $value);
    }

    /**
     * @param string $term
     *
     * @return string
     */
    private function generateKeyForTerm(string $term): string
    {
        return join(
            [
                self::REDIS_PREFIX,
                ':',
                self::GITHUB_PREFIX,
                ':',
                $term
            ]
        );
    }
}
