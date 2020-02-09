<?php
$causeGrowthRoutes = [
    /**
     * ########################################################################
     * Cause growths
     * ########################################################################
     */
    'freeasso.causegrowth.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.causegrowth.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseGrowth'
            ]
        ]
    ],
    'freeasso.causegrowth.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth/:grow_id',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseGrowth'
            ]
        ]
    ],
    'freeasso.causegrowth.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth/:grow_id',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseGrowth'
            ]
        ]
    ],
    'freeasso.causegrowth.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseGrowth'
            ]
        ]
    ],
    'freeasso.causegrowth.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseGrowth',
        'url'        => '/v1/asso/cause_growth/:grow_id',
        'controller' => 'FreeAsso::Controller::CauseGrowth',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
