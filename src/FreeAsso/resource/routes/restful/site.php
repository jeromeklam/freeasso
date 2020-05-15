<?php
$siteRoutes = [
    /**
     * ########################################################################
     * Sites
     * ########################################################################
     */
    'freeasso.site.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.site.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type', 'parent_site']
        ],
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
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type', 'owner', 'sanitary', 'parent_site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type', 'owner', 'sanitary', 'parent_site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type', 'owner', 'sanitary', 'parent_site']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
