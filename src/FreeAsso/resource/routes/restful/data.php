<?php
$dataRoutes = [
    /**
     * ########################################################################
     * Datas
     * ########################################################################
     */
    'freeasso.data.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
