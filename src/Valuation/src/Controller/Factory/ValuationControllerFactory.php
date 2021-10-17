<?php

declare(strict_types=1);

namespace Valuation\Controller\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Valuation\Controller\ValuationController;
use Valuation\Model\Table\ValuationTable;

class ValuationControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param null|array $options
     * @return WriteController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        //$formManager = $container->get('FormElementManager');
        return new ValuationController(
            $container->get(ValuationTable::class)
        );
    }
}
