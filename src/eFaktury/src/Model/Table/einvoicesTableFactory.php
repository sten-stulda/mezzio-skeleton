<?php

declare(strict_types=1);

namespace eFaktury\Model\Table;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;

class einvoicesTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new einvoicesTable(
            $container->get(Adapter::class)
        );
    }
}
