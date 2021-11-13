<?php

declare(strict_types=1);

namespace eFaktury;

use eFaktury\Model\Table\einvoicesTable;
use eFaktury\Model\Table\einvoicesTableFactory;
use eFaktury\Model\Table\ifisEinvoicesStackTable;
use eFaktury\Model\Table\ifisEinvoicesStackTableFactory;

/**
 * The configuration provider for the eFaktury module
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
                ifisEinvoicesStackTable::class => ifisEinvoicesStackTableFactory::class,
                einvoicesTable::class => einvoicesTableFactory::class 
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
                'e-faktury'    => [__DIR__ . '/../templates/'],
            ],
        ];
    }
}
