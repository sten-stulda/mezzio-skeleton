<?php

declare(strict_types=1);

namespace eFaktury;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class MainHandlerFactory
{
    public function __invoke(ContainerInterface $container) : MainHandler
    {
        return new MainHandler($container->get(TemplateRendererInterface::class));
    }
}
