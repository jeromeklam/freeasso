<?php
$sicknessRoutes = [
    /**
     * ########################################################################
     * Sickness
     * ########################################################################
     */
    'freeasso.sickness.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Sickness',
        'url'        => '/v1/asso/sickness',
        'controller' => 'FreeAsso::Controller::Sickness',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Sickness'
            ]
        ]
    ],
    'freeasso.sickness.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Sickness',
        'url'        => '/v1/asso/sickness/:sick_id',
        'controller' => 'FreeAsso::Controller::Sickness',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sickness'
            ]
        ]
    ],
    'freeasso.sickness.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Sickness',
        'url'        => '/v1/asso/sickness/:sick_id',
        'controller' => 'FreeAsso::Controller::Sickness',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sickness'
            ]
        ]
    ],
    'freeasso.sickness.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Sickness',
        'url'        => '/v1/asso/sickness',
        'controller' => 'FreeAsso::Controller::Sickness',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sickness'
            ]
        ]
    ],
    'freeasso.sickness.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Sickness',
        'url'        => '/v1/asso/sickness/:sick_id',
        'controller' => 'FreeAsso::Controller::Sickness',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

