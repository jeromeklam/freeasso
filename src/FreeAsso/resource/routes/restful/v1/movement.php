<?php
$movementRoutes = [
    /**
     * ########################################################################
     * Movement
     * ########################################################################
     */
    'freeasso.movement.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Movement',
        'url'        => '/v1/asso/movement',
        'controller' => 'FreeAsso::Controller::Movement',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Movement'
            ]
        ]
    ],
    'freeasso.movement.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Movement',
        'url'        => '/v1/asso/movement/:move_id',
        'controller' => 'FreeAsso::Controller::Movement',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Movement'
            ]
        ]
    ],
    'freeasso.movement.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Movement',
        'url'        => '/v1/asso/movement/:move_id',
        'controller' => 'FreeAsso::Controller::Movement',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Movement'
            ]
        ]
    ],
    'freeasso.movement.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Movement',
        'url'        => '/v1/asso/movement',
        'controller' => 'FreeAsso::Controller::Movement',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Movement'
            ]
        ]
    ],
    'freeasso.movement.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Movement',
        'url'        => '/v1/asso/movement/:move_id',
        'controller' => 'FreeAsso::Controller::Movement',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

