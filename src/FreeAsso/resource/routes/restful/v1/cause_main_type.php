<?php
$causeMainTypeRoutes = [
    /**
     * ########################################################################
     * Types de cause principal
     * ########################################################################
     */
    'freeasso.causemaintype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
