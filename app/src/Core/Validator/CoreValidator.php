<?php declare(strict_types = 1);

namespace App\Core\Validator;

use App\Core\CoreConfig;
use App\Core\CoreConfigInterface;

class CoreValidator implements CoreValidatorInterface
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
            $validatorClassName = get_class($this);
            $validatorNameParts = explode("\\", $validatorClassName);
            $configNameWithNamespace = "\\" . implode("\\", [$validatorNameParts[0], $validatorNameParts[1], $validatorNameParts[1] . 'Config']);
            $this->config = new $configNameWithNamespace();
        }

        return $this->config;
    }
}
