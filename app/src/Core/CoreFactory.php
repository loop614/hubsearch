<?php declare(strict_types=1);

namespace App\Core;

abstract class CoreFactory implements CoreFactoryInterface
{
    /**
     * @var \App\Core\CoreConfig|null
     */
    protected ?CoreConfig $config = null;

    /**
     * @return \App\Core\CoreConfigInterface
     */
    protected function getConfig(): CoreConfigInterface
    {
        if ($this->config === null) {
            $factoryClassName = get_class($this);
            $factoryNameParts = explode("\\", $factoryClassName);
            $configNameWithNamespace = "\\" . implode("\\", [$factoryNameParts[0], $factoryNameParts[1], $factoryNameParts[1] . 'Config']);
            $this->config = new $configNameWithNamespace();
        }

        return $this->config;
    }
}
