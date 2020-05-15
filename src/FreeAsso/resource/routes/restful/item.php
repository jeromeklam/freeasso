<?php
$itemRoutes = [
    /**
     * ########################################################################
     * Item
     * ########################################################################
     */
    'freeasso.item.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Item',
        'url'        => '/v1/asso/item',
        'controller' => 'FreeAsso::Controller::Item',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['default_provider', 'stock_unit', 'content_unit']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Item'
            ]
        ]
    ],
    'freeasso.item.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Item',
        'url'        => '/v1/asso/item/:item_id',
        'controller' => 'FreeAsso::Controller::Item',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['default_provider', 'stock_unit', 'content_unit']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Item'
            ]
        ]
    ],
    'freeasso.item.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Item',
        'url'        => '/v1/asso/item/:item_id',
        'controller' => 'FreeAsso::Controller::Item',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['default_provider', 'stock_unit', 'content_unit']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Item'
            ]
        ]
    ],
    'freeasso.item.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Item',
        'url'        => '/v1/asso/item',
        'controller' => 'FreeAsso::Controller::Item',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['default_provider', 'stock_unit', 'content_unit']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Item'
            ]
        ]
    ],
    'freeasso.item.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Item',
        'url'        => '/v1/asso/item/:item_id',
        'controller' => 'FreeAsso::Controller::Item',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

