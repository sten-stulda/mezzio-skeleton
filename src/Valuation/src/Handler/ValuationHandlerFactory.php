<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ResultingRateTable;
use Valuation\Model\Table\ValuationTable;

class ValuationHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ValuationHandler
    {
        return new ValuationHandler(
            $container->get(ValuationTable::class),
            $container->get(ResultingRateTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
