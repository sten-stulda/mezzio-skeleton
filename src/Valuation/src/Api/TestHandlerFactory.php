<?php

declare(strict_types=1);

namespace Valuation\Api;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\ConfidentialityTable;
use Valuation\Model\Table\ValuationTable;

class TestHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TestHandler
    {
        return new TestHandler(
            $container->get(ConfidentialityTable::class),
            $container->get(ValuationTable::class),
            $container->get(TemplateRendererInterface::class));
    }
}
