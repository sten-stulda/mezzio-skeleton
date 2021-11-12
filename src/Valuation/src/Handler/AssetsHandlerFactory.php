<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ValuationTable;

class AssetsHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AssetsHandler
    {
        return new AssetsHandler(
            $container->get(ValuationTable::class),
            $container->get(TemplateRendererInterface::class));
    }
}
