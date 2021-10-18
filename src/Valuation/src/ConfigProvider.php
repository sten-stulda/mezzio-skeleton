<?php

declare(strict_types=1);

namespace Valuation;

use Valuation\Controller\Factory\ValuationControllerFactory;
use Valuation\Controller\ValuationController;
use Valuation\Model\Table\AvailabilityTable;
use Valuation\Model\Table\AvailabilityTableFactory;
use Valuation\Model\Table\ConfidentialityTable;
use Valuation\Model\Table\ConfidentialityTableFactory;
use Valuation\Model\Table\ImpactTable;
use Valuation\Model\Table\ImpactTableFactory;
use Valuation\Model\Table\IntegrityTable;
use Valuation\Model\Table\IntegrityTableFactory;
use Valuation\Model\Table\ResultingRateTable;
use Valuation\Model\Table\ResultingRateTableFactory;
use Valuation\Model\Table\ThreatTable;
use Valuation\Model\Table\ThreatTableFactory;
use Valuation\Model\Table\ValuationTable;
use Valuation\Model\Table\ValuationTableFactory;
use Valuation\Model\Table\VulnerabilityTable;
use Valuation\Model\Table\VulnerabilityTableFactory;

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
                ValuationTable::class => ValuationTableFactory::class,
                ConfidentialityTable::class => ConfidentialityTableFactory::class,
                IntegrityTable::class => IntegrityTableFactory::class,
                AvailabilityTable::class => AvailabilityTableFactory::class,
                VulnerabilityTable::class => VulnerabilityTableFactory::class,
                ImpactTable::class => ImpactTableFactory::class,
                ThreatTable::class => ThreatTableFactory::class,
                ResultingRateTable::class => ResultingRateTableFactory::class,

                ValuationController::class => ValuationControllerFactory::class
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
