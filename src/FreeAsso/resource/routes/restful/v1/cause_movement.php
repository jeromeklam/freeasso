<?php
$causeMovementRoutes = [
    /**
     * ########################################################################
     * Cause movements
     * ########################################################################
     */
    'freeasso.causemovement.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.causemovement.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'from_site', 'to_site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseMovement'
            ]
        ]
    ],
    'freeasso.causemovement.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement/:camv_id',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'from_site', 'to_site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMovement'
            ]
        ]
    ],
    'freeasso.causemovement.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement/:camv_id',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'from_site', 'to_site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMovement'
            ]
        ]
    ],
    'freeasso.causemovement.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'from_site', 'to_site']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMovement'
            ]
        ]
    ],
    'freeasso.causemovement.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseMovement',
        'url'        => '/v1/asso/cause_movement/:camv_id',
        'controller' => 'FreeAsso::Controller::CauseMovement',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
