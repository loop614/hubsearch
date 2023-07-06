<?php declare(strict_types = 1);

namespace App\Core\Controller;

use App\Core\CoreFacade;
use App\Core\CoreFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CoreController extends AbstractController implements CoreControllerInterface
{
    /**
     * @var \App\Core\CoreFacade|null
     */
    protected ?CoreFacade $facade = null;

    /**
     * @var \App\Core\CoreFactory|null
     */
    protected ?CoreFactory $factory = null;

    /**
     * @return \App\Core\CoreFacade
     */
    protected function getFacade(): CoreFacade
    {
        if ($this->facade === null) {
            $controllerClassName = get_class($this);
            $controllerNameParts = explode("\\", $controllerClassName);
            $controllerName = end($controllerNameParts);
            $facadeName = str_replace("Controller", "Facade", $controllerName);
            $facadeNameWithNamespace = implode("\\", [$controllerNameParts[0], $controllerNameParts[1], $facadeName]);
            $facadeNameWithNamespace = "\\" . $facadeNameWithNamespace;
            $this->facade = new $facadeNameWithNamespace();
        }

        return $this->facade;
    }

    /**
     * @return \App\Core\CoreFactory
     */
    protected function getFactory(): CoreFactory
    {
        if ($this->factory === null) {
            $controllerClassName = get_class($this);
            $controllerNameParts = explode("\\", $controllerClassName);
            $controllerName = end($controllerNameParts);
            $factoryName = str_replace("Controller", "Factory", $controllerName);
            $factoryNameWithNamespace = implode("\\", [$controllerNameParts[0], $controllerNameParts[1], $factoryName]);
            $factoryNameWithNamespace = "\\" . $factoryNameWithNamespace;
            $this->factory = new $factoryNameWithNamespace();
        }

        return $this->factory;
    }
}
