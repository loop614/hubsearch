<?php declare(strict_types=1);

namespace App\Core\Transfer;

interface CoreTransferInterface
{
    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @param array $seed
     *
     * @return void
     */
    public function fromArray(array $seed): void;
}
