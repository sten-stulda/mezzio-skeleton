<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ValuationTable;
use Valuation\Model\Table\ConfidentialityTable;

class ConfidentialityHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ConfidentialityHandler
    {
        return new ConfidentialityHandler(
            $container->get(ValuationTable::class),
            $container->get(ConfidentialityTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
