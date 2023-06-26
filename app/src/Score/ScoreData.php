<?php declare(strict_types = 1);

namespace App\Score;

class ScoreData
{
    /**
     * @var float|null
     */
    private ?float $score;

    /**
     * @var string
     */
    private string $site;

    /**
     * @var string
     */
    private string $term;

    /**
     * @param string $site
     * @param string $term
     * @param float|null $score
     */
    public function __construct(string $site, string $term, ?float $score = null)
    {
        $this->site = $site;
        $this->term = $term;
        $this->score = $score;
    }

    /**
     * @return float|null
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore(float $score): void
    {
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getSite(): string
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite(string $site): void
    {
        $this->site = $site;
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm(string $term): void
    {
        $this->term = $term;
    }
}
