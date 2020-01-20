<?php
$dashboardRoutes = [
    /**
     * ########################################################################
     * Dashboard
     * ########################################################################
     */
    'freeasso.dashboard.stats' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'url'        => '/v1/asso/dashboard/stats',
        'controller' => 'FreeAsso::Controller::Dashboard',
        'function'   => 'statistics',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
            ]
        ]
    ],
];
