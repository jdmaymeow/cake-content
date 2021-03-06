<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'CakeContent',
    ['path' => '/cake-content'],
    function (RouteBuilder $routes) {
        $routes->fallbacks(DashedRoute::class);
        $routes->prefix('admin', function ($routes) {
            $routes->fallbacks(DashedRoute::class);
        });
        $routes->prefix('api', function ($routes) {
            $routes->extensions(['json', 'xml']);
            $routes->fallbacks(DashedRoute::class);
        });
    }
);

Router::scope(
    '/',
    ['controller' => 'Nodes', 'plugin' => 'CakeContent'],
    function ($routes) {
        $routes->connect('/nodes/tagged/*', ['action' => 'tags']);
    }
);
