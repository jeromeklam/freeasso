<?php
$donationOriginRoutes = [
    /**
     * ########################################################################
     * DonationOrigin
     * ########################################################################
     */
    'freeasso.donationorigin.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::DonationOrigin',
        'url'        => '/v1/asso/donation_origin',
        'controller' => 'FreeAsso::Controller::DonationOrigin',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::DonationOrigin'
            ]
        ]
    ],
    'freeasso.donationorigin.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::DonationOrigin',
        'url'        => '/v1/asso/donation_origin/:dono_id',
        'controller' => 'FreeAsso::Controller::DonationOrigin',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::DonationOrigin'
            ]
        ]
    ],
    'freeasso.donationorigin.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::DonationOrigin',
        'url'        => '/v1/asso/donation_origin/:dono_id',
        'controller' => 'FreeAsso::Controller::DonationOrigin',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::DonationOrigin'
            ]
        ]
    ],
    'freeasso.donationorigin.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::DonationOrigin',
        'url'        => '/v1/asso/donation_origin',
        'controller' => 'FreeAsso::Controller::DonationOrigin',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::DonationOrigin'
            ]
        ]
    ],
    'freeasso.donationorigin.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::DonationOrigin',
        'url'        => '/v1/asso/donation_origin/:dono_id',
        'controller' => 'FreeAsso::Controller::DonationOrigin',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

