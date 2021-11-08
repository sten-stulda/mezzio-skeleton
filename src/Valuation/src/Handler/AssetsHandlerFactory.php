<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AssetsHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AssetsHandler
    {
        return new AssetsHandler($container->get(TemplateRendererInterface::class));
    }
}
