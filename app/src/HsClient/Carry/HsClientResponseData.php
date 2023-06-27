<?php declare(strict_types = 1);

namespace App\HsClient\Carry;

class HsClientResponseData
{
    /**
     * @var array
     */
    private array $texts;

    /**
     * @return array
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    /**
     * @param array $texts
     */
    public function setTexts(array $texts): void
    {
        $this->texts = $texts;
    }
}
