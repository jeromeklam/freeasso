<?php
$causeMediaRoutes = [
    /**
     * ########################################################################
     * Cause Media
     * ########################################################################
     */
    'freeasso.causemedia.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    'freeasso.causemediablob.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMediaBlob',
        'url'        => '/v1/asso/cause_media_blob',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'createOneBlob',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemediablob.downloadone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMediaBlob',
        'url'        => '/v1/asso/cause_media_blob/download/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
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
