<?php
$specificRoutes = [
    /**
     * ########################################################################
     * Routes spécifiques
     * ########################################################################
     */
    'freeasso.specific.404' => [
        'method'     => \FreeFW\Router\Route::METHOD_ALL,
        'url'        => '/v1/asso/404',
        'controller' => 'FreeAsso::Controller::Specific',
        'function'   => 'specific404',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'results' => [
            '404' => [
            ]
        ]
    ],
];
