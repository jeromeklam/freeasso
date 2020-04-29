<?php
$donationRoutes = [
    /**
     * ########################################################################
     * Donation
     * ########################################################################
     */
    'freeasso.donation.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Donation',
        'url'        => '/v1/asso/donation',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'cause.cause_type', 'payment_type', 'sponsorship']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Donation'
            ]
        ]
    ],
    'freeasso.donation.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Donation',
        'url'        => '/v1/asso/donation/:don_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'cause.cause_type', 'payment_type', 'sponsorship', 'session']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Donation'
            ]
        ]
    ],
    'freeasso.donation.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Donation',
        'url'        => '/v1/asso/donation/:don_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'cause.cause_type', 'payment_type', 'sponsorship', 'session']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Donation'
            ]
        ]
    ],
    'freeasso.donation.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Donation',
        'url'        => '/v1/asso/donation',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'cause.cause_type', 'payment_type', 'sponsorship', 'session']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Donation'
            ]
        ]
    ],
    'freeasso.donation.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Donation',
        'url'        => '/v1/asso/donation/:don_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

