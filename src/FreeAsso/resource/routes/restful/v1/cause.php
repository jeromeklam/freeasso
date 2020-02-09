<?php
$causeRoutes = [
    /**
     * ########################################################################
     * Causes
     * ########################################################################
     */
    'freeasso.cause.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.cause.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'default_blob']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'origin', 'raiser', 'default_blob']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'origin', 'raiser', ]
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'origin', 'raiser']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
