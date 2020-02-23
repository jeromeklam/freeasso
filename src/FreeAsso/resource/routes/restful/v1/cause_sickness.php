<?php
$causeSicknessRoutes = [
    /**
     * ########################################################################
     * Cause growths
     * ########################################################################
     */
    'freeasso.causesickness.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.causesickness.getpendings' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness/pendings',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'getPendings',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause.site', 'sickness', 'sanitary']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseSickness'
            ]
        ]
    ],
    'freeasso.causesickness.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'sickness', 'sanitary']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseSickness'
            ]
        ]
    ],
    'freeasso.causesickness.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness/:caus_id',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'sickness', 'sanitary']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseSickness'
            ]
        ]
    ],
    'freeasso.causesickness.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness/:caus_id',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'sickness', 'sanitary']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseSickness'
            ]
        ]
    ],
    'freeasso.causesickness.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'sickness', 'sanitary']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseSickness'
            ]
        ]
    ],
    'freeasso.causesickness.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseSickness',
        'url'        => '/v1/asso/cause_sickness/:caus_id',
        'controller' => 'FreeAsso::Controller::CauseSickness',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
