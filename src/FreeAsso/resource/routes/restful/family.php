<?php
$familyRoutes = [
    /**
     * ########################################################################
     * Family
     * ########################################################################
     */
    'freeasso.family.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Family'
            ]
        ]
    ],
    'freeasso.family.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family/:fam_id',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Family'
            ]
        ]
    ],
    'freeasso.family.getchildren' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family/children/:fam_id',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'getChildren',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Family'
            ]
        ]
    ],
    'freeasso.family.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family/:fam_id',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Family'
            ]
        ]
    ],
    'freeasso.family.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Family'
            ]
        ]
    ],
    'freeasso.family.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Family',
        'url'        => '/v1/asso/family/:fam_id',
        'controller' => 'FreeAsso::Controller::Family',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

