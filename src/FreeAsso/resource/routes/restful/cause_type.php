<?php
$causeTypeRoutes = [
    /**
     * ########################################################################
     * Types de cause
     * ########################################################################
     */
    'freeasso.causetype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_main_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_main_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_main_type']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_main_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
