<?php

declare(strict_types=1);

namespace eFaktury;

use Psr\Container\ContainerInterface;

class HomeHandlerFactory
{
    public function __invoke(ContainerInterface $container) : HomeHandler
    {
        return new HomeHandler();
    }
}
