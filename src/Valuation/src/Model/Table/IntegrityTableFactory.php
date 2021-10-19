<?php

declare(strict_types=1);

namespace Valuation\Model\Table;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IntegrityTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new IntegrityTable(
            $container->get(Adapter::class)
        );
    }
}
