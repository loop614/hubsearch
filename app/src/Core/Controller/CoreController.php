<?php declare(strict_types = 1);

namespace App\Core\Controller;

use App\Core\CoreFacadeInterface;
use App\Core\CoreFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CoreController extends AbstractController implements CoreControllerInterface
{
    /**
     * @var \App\Core\CoreFacadeInterface|null
     */
    protected ?CoreFacadeInterface $facade = null;

    /**
     * @var \App\Core\CoreFactoryInterface|null
     */
    protected ?CoreFactoryInterface $factory = null;

    /**
     * @return \App\Core\CoreFacadeInterface
     */
    protected function getFacade(): CoreFacadeInterface
    {
        if ($this->facade === null) {
            $controllerClassName = get_class($this);
            $controllerNameParts = explode("\\", $controllerClassName);
            $facadeNameWithNamespace = "\\" . implode("\\", [$controllerNameParts[0], $controllerNameParts[1], $controllerNameParts[1] . 'Facade']);
            $this->facade = new $facadeNameWithNamespace();
        }

        return $this->facade;
    }

    /**
     * @return \App\Core\CoreFactoryInterface
     */
    protected function getFactory(): CoreFactoryInterface
    {
        if ($this->factory === null) {
            $controllerClassName = get_class($this);
            $controllerNameParts = explode("\\", $controllerClassName);
            $factoryNameWithNamespace = "\\" .implode("\\", [$controllerNameParts[0], $controllerNameParts[1], $controllerNameParts[1] . 'Factory']);
            $this->factory = new $factoryNameWithNamespace();
        }

        return $this->factory;
    }
}
