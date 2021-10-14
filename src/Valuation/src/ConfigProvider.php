<?php

declare(strict_types=1);

namespace Valuation;

use Valuation\Model\Table\ValuationTable;
use Valuation\Model\Table\ValuationTableFactory;

/**
 * The configuration provider for the Valuation module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'invokables' => [
            ],
            'factories'  => [
                ValuationTable::class => ValuationTableFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'valuation'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
