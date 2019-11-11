<?php
$localRoutes = [
    /**
     * ########################################################################
     * Types de cause
     * ########################################################################
     */
    'freeasso.causetype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/causetype',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
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
        'url'        => '/v1/asso/causetype/:caut_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Sites
     * ########################################################################
     */
    'freeasso.site.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Causes
     * ########################################################################
     */
    'freeasso.cause.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'include'    => [
            'default' => ['CauseType', 'Site']
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
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'include'    => [
            'default' => ['CauseType', 'Site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ]
];
return $localRoutes;
