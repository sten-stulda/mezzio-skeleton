<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ValuationTable;
use Valuation\Model\Table\AvailabilityTable;

class AvailabilityHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AvailabilityHandler
    {
        return new AvailabilityHandler(
            $container->get(ValuationTable::class),
            $container->get(AvailabilityTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
