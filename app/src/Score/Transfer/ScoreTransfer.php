<?php declare(strict_types = 1);

namespace App\Score\Transfer;

final class ScoreTransfer
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
     * @var string
     */
    private string $message = '';

    /**
     * @param string     $site
     * @param string     $term
     * @param float|null $score
     */
    public function __construct(string $site, string $term, ?float $score = null)
    {
        $this->site = $site;
        $this->term = $term;
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
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

    /**
     * @return array
     */
    public function toArray(): array
    {
        $transferArray = [];
        $class_vars = get_class_vars(self::class);
        foreach (array_keys($class_vars) as $name) {
            $getName = 'get' . ucfirst($name);
            $transferArray[$name] = $this->$getName();
        }

        return $transferArray;
    }

    /**
     * @param array $seed
     *
     * @return void
     */
    public function fromArray(array $seed): void
    {
        $class_vars = get_class_vars(self::class);
        foreach (array_keys($class_vars) as $name) {
            if (!isset($seed[$name])) {
                continue;
            }

            $getName = 'set' . ucfirst($name);
            $this->$getName($seed[$name]);
        }
    }
}
