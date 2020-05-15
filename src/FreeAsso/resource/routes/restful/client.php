<?php
$clientRoutes = [
    /**
     * ########################################################################
     * Client
     * ########################################################################
     */
    'freeasso.client.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.client.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['lang', 'last_donation', 'client_category', 'client_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang', 'last_donation']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang', 'last_donation']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang', 'last_donation']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
