<?php declare(strict_types = 1);

namespace App\HsClient\Transfer;

use App\Core\Transfer\CoreTransfer;

final class HsClientResponseTransfer extends CoreTransfer
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

        /**
         * @return array
         */
    public function toArray(): array
    {
        $transferArray = [];
        $class_vars = get_class_vars(self::class);
        foreach ($class_vars as $name) {
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
        foreach ($class_vars as $name) {
            if (!isset($seed[$name])) {
                continue;
            }

            $getName = 'set' . ucfirst($name);
            $this->$getName($seed[$name]);
        }
    }
}
