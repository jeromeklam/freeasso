<?php
$causeAlertRoutes = [
    /**
     * ########################################################################
     * Alertes sur cause
     * ########################################################################
     */
    'freeasso.causealert.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseAlert',
        'url'        => '/v1/asso/cause_alert',
        'controller' => 'FreeAsso::Controller::CauseAlert',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseAlert'
            ]
        ]
    ],
    'freeasso.causealert.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseAlert',
        'url'        => '/v1/asso/cause_alert/:caua_id',
        'controller' => 'FreeAsso::Controller::CauseAlert',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseAlert'
            ]
        ]
    ],
    'freeasso.causealert.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseAlert',
        'url'        => '/v1/asso/cause_alert',
        'controller' => 'FreeAsso::Controller::CauseAlert',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseAlert'
            ]
        ]
    ],
    'freeasso.causealert.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseAlert',
        'url'        => '/v1/asso/cause_alert/:caua_id',
        'controller' => 'FreeAsso::Controller::CauseAlert',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseAlert'
            ]
        ]
    ],
    'freeasso.causealert.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseAlert',
        'url'        => '/v1/asso/cause_alert/:caua_id',
        'controller' => 'FreeAsso::Controller::CauseAlert',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
