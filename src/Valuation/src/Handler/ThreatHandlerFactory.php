<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ThreatTable;
use Valuation\Model\Table\ValuationTable;

class ThreatHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ThreatHandler
    {
        return new ThreatHandler(
            $container->get(ValuationTable::class),
            $container->get(ThreatTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
