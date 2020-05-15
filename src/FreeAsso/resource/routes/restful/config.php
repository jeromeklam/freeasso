<?php
$configRoutes = [
    /**
     * ########################################################################
     * Configs
     * ########################################################################
     */
    'freeasso.config.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Config',
        'url'        => '/v1/asso/config',
        'controller' => 'FreeAsso::Controller::Config',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Config'
            ]
        ]
    ],
];
