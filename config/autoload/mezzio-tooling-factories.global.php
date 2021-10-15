<?php

/**
 * This file generated by Mezzio\Tooling\Factory\ConfigInjector.
 *
 * Modifications should be kept at a minimum, and restricted to adding or
 * removing factory definitions; other dependency types may be overwritten
 * when regenerating this file via mezzio-tooling commands.
 */
 
declare(strict_types=1);

return [
    'dependencies' => [
        'factories' => [
            //User\Handler\RegisterHandler::class => User\Handler\RegisterHandlerFactory::class,
            //Valuation\Handler\AssetHandler::class => Valuation\Handler\AssetHandlerFactory::class,
            //Valuation\Handler\AssetsHandler::class => Valuation\Handler\AssetsHandlerFactory::class,
            //Valuation\Handler\HomePageHandler::class => Valuation\Handler\HomePageHandlerFactory::class,
            Valuation\Handler\ValuationHandler::class => Valuation\Handler\ValuationHandlerFactory::class,
        ],
    ],
];
