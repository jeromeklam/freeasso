<?php
$sponsorshipRoutes = [
    /**
     * ########################################################################
     * Sponsorship
     * ########################################################################
     */
    'freeasso.sponsorship.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Sponsorship',
        'url'        => '/v1/asso/sponsorship',
        'controller' => 'FreeAsso::Controller::Sponsorship',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Sponsorship'
            ]
        ]
    ],
    'freeasso.sponsorship.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Sponsorship',
        'url'        => '/v1/asso/sponsorship/:spo_id',
        'controller' => 'FreeAsso::Controller::Sponsorship',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sponsorship'
            ]
        ]
    ],
    'freeasso.sponsorship.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Sponsorship',
        'url'        => '/v1/asso/sponsorship/:spo_id',
        'controller' => 'FreeAsso::Controller::Sponsorship',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sponsorship'
            ]
        ]
    ],
    'freeasso.sponsorship.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Sponsorship',
        'url'        => '/v1/asso/sponsorship',
        'controller' => 'FreeAsso::Controller::Sponsorship',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Sponsorship'
            ]
        ]
    ],
    'freeasso.sponsorship.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Sponsorship',
        'url'        => '/v1/asso/sponsorship/:spo_id',
        'controller' => 'FreeAsso::Controller::Sponsorship',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
