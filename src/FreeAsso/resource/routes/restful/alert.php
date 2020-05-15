<?php
$alertRoutes = [
    /**
     * ########################################################################
     * Alertes
     * ########################################################################
     */
    'freeasso.alert.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Alert',
        'url'        => '/v1/asso/alert',
        'controller' => 'FreeAsso::Controller::Alert',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'site', 'client']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Alert'
            ]
        ]
    ],
    'freeasso.alert.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Alert',
        'url'        => '/v1/asso/alert/:alert_id',
        'controller' => 'FreeAsso::Controller::Alert',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'site', 'client']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Alert'
            ]
        ]
    ],
    'freeasso.alert.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Alert',
        'url'        => '/v1/asso/alert',
        'controller' => 'FreeAsso::Controller::Alert',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'site', 'client']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Alert'
            ]
        ]
    ],
    'freeasso.alert.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Alert',
        'url'        => '/v1/asso/alert/:alert_id',
        'controller' => 'FreeAsso::Controller::Alert',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'site', 'client']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Alert'
            ]
        ]
    ],
    'freeasso.alert.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Alert',
        'url'        => '/v1/asso/alert/:alert_id',
        'controller' => 'FreeAsso::Controller::Alert',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
