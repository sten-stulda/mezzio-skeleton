<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ImpactTable;
use Valuation\Model\Table\ValuationTable;

class ImpactHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ImpactHandler
    {
        return new ImpactHandler(
            $container->get(ValuationTable::class),
            $container->get(ImpactTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
