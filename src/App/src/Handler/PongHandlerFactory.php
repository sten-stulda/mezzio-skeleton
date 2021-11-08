<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class PongHandlerFactory
{
    public function __invoke(ContainerInterface $container) : PongHandler
    {
        return new PongHandler($container->get(TemplateRendererInterface::class));
    }
}
