<?php
$unitRoutes = [
    /**
     * ########################################################################
     * Unit
     * ########################################################################
     */
    'freeasso.unit.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Unit',
        'url'        => '/v1/asso/unit',
        'controller' => 'FreeAsso::Controller::Unit',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Unit'
            ]
        ]
    ],
    'freeasso.unit.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Unit',
        'url'        => '/v1/asso/unit/:unit_id',
        'controller' => 'FreeAsso::Controller::Unit',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Unit'
            ]
        ]
    ],
    'freeasso.unit.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Unit',
        'url'        => '/v1/asso/unit/:unit_id',
        'controller' => 'FreeAsso::Controller::Unit',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Unit'
            ]
        ]
    ],
    'freeasso.unit.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Unit',
        'url'        => '/v1/asso/unit',
        'controller' => 'FreeAsso::Controller::Unit',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Unit'
            ]
        ]
    ],
    'freeasso.unit.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Unit',
        'url'        => '/v1/asso/unit/:unit_id',
        'controller' => 'FreeAsso::Controller::Unit',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

