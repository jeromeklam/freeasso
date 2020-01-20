<?php
$clientCategoryRoutes = [
    /**
     * ########################################################################
     * Catégories de client
     * ########################################################################
     */
    'freeasso.clientcategory.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
