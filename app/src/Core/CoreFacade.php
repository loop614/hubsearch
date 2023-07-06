<?php declare(strict_types=1);

namespace App\Core;

abstract class CoreFacade implements CoreFacadeInterface
{
    /**
     * @var CoreFactory|null
     */
    protected ?CoreFactory $factory = null;

    /**
     * @return \App\Core\CoreFactory
     */
    protected function getFactory(): CoreFactory
    {
        if ($this->factory === null) {
            $facadeClassName = get_class($this);
            $facadeNameParts = explode("\\", $facadeClassName);
            $facadeName = end($facadeNameParts);
            array_pop($facadeNameParts);
            $factoryName = str_replace("Facade", "Factory", $facadeName);
            $factoryNameWithNamespace = implode("\\", [...$facadeNameParts, $factoryName]);
            $factoryNameWithNamespace = "\\" . $factoryNameWithNamespace;
            $this->factory = new $factoryNameWithNamespace();
        }

        return $this->factory;
    }
}
