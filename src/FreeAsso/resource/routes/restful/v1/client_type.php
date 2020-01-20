<?php
$clientTypeRoutes = [
    /**
     * ########################################################################
     * Types de client
     * ########################################################################
     */
    'freeasso.clienttype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
