<?php declare(strict_types=1);

namespace App\Core;

abstract class CoreFacade implements CoreFacadeInterface
{
    /**
     * @var CoreFactoryInterface|null
     */
    protected ?CoreFactoryInterface $factory = null;

    /**
     * @return \App\Core\CoreFactoryInterface
     */
    protected function getFactory(): CoreFactoryInterface
    {
        if ($this->factory === null) {
            $facadeClassName = get_class($this);
            $facadeNameParts = explode("\\", $facadeClassName);
            $factoryNameWithNamespace = "\\" . implode("\\", [$facadeNameParts[0], $facadeNameParts[1], $facadeNameParts[1] . 'Factory']);
            $this->factory = new $factoryNameWithNamespace();
        }

        return $this->factory;
    }
}
