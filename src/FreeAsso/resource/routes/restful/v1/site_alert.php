<?php
$siteAlertRoutes = [
    /**
     * ########################################################################
     * Alertes sur site
     * ########################################################################
     */
    'freeasso.sitealert.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteAlert',
        'url'        => '/v1/asso/site_alert',
        'controller' => 'FreeAsso::Controller::SiteAlert',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::SiteAlert'
            ]
        ]
    ],
    'freeasso.sitealert.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteAlert',
        'url'        => '/v1/asso/site_alert/:sita_id',
        'controller' => 'FreeAsso::Controller::SiteAlert',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteAlert'
            ]
        ]
    ],
    'freeasso.sitealert.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::SiteAlert',
        'url'        => '/v1/asso/site_alert',
        'controller' => 'FreeAsso::Controller::SiteAlert',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteAlert'
            ]
        ]
    ],
    'freeasso.sitealert.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::SiteAlert',
        'url'        => '/v1/asso/site_alert/:sita_id',
        'controller' => 'FreeAsso::Controller::SiteAlert',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteAlert'
            ]
        ]
    ],
    'freeasso.sitealert.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::SiteAlert',
        'url'        => '/v1/asso/site_alert/:sita_id',
        'controller' => 'FreeAsso::Controller::SiteAlert',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
