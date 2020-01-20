<?php
$siteMediaRoutes = [
    /**
     * ########################################################################
     * Site Media
     * ########################################################################
     */
    'freeasso.sitemedia.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteMedia',
        'url'        => '/v1/asso/site_media',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::SiteMedia'
            ]
        ]
    ],
    'freeasso.sitemedia.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteMedia',
        'url'        => '/v1/asso/site_media/:sitm_id',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteMedia'
            ]
        ]
    ],
    'freeasso.sitemedia.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::SiteMedia',
        'url'        => '/v1/asso/site_media/:sitm_id',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteMedia'
            ]
        ]
    ],
    'freeasso.sitemedia.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::SiteMedia',
        'url'        => '/v1/asso/site_media',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteMedia'
            ]
        ]
    ],
    'freeasso.sitemedia.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::SiteMedia',
        'url'        => '/v1/asso/site_media/:sitm_id',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    'freeasso.sitemediablob.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::SiteMediaBlob',
        'url'        => '/v1/asso/site_media_blob',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'createOneBlob',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteMedia'
            ]
        ]
    ],
    'freeasso.sitemediablob.downloadone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteMediaBlob',
        'url'        => '/v1/asso/site_media_blob/download/:sitm_id',
        'controller' => 'FreeAsso::Controller::SiteMedia',
        'function'   => 'downloadOneBlob',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_DATA,
            ]
        ]
    ],
];
