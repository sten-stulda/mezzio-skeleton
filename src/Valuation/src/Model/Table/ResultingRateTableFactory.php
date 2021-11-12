<?php

declare(strict_types=1);

namespace Valuation\Model\Table;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ResultingRateTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new ResultingRateTable(
            $container->get(Adapter::class)
        );
    }
}
