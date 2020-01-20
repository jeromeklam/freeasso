<?php
$siteTypeRoutes = [
    /**
     * ########################################################################
     * Types de site
     * ########################################################################
     */
    'freeasso.sitetype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type_datas']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
