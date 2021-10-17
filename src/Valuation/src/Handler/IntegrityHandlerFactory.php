<?php

declare(strict_types=1);

namespace Valuation\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Valuation\Model\Table\IntegrityTable;
use Valuation\Model\Table\ValuationTable;

class IntegrityHandlerFactory
{
    public function __invoke(ContainerInterface $container) : IntegrityHandler
    {
        return new IntegrityHandler(
            $container->get(ValuationTable::class),
            $container->get(IntegrityTable::class),
            $container->get(TemplateRendererInterface::class)
        );
    }
}
