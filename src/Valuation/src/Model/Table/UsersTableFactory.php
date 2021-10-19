<?php

declare(strict_types=1);

namespace User\Model\Table;

use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Factory\FactoryInterface;

class UsersTableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new UsersTable(
            $container->get(Adapter::class)
        );
    }
}
