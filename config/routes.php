<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * laminas-router route configuration
 *
 * @see https://docs.laminas.dev/laminas-router/
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    
    /** homepage */
    $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/register', User\Handler\RegisterHandler::class, 'register');
    
    /** MODULE Valuation */
    $app->get('/valuation', Valuation\Handler\ValuationHandler::class, 'valuation.home');
    $app->get('/valuation/assets', Valuation\Handler\AssetsHandler::class, 'valuation.assets');
    $app->get('/valuation/asset[/:id]', Valuation\Handler\AssetHandler::class, 'valuation.asset');
    
    /** API */
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');
};
