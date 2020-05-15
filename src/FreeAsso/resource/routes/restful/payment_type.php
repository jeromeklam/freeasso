<?php
$paymentTypeRoutes = [
    /**
     * ########################################################################
     * Payment Type
     * ########################################################################
     */
    'freeasso.paymenttype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::PaymentType',
        'url'        => '/v1/asso/payment_type',
        'controller' => 'FreeAsso::Controller::PaymentType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::PaymentType'
            ]
        ]
    ],
    'freeasso.paymenttype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::PaymentType',
        'url'        => '/v1/asso/payment_type/:ptyp_id',
        'controller' => 'FreeAsso::Controller::PaymentType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::PaymentType'
            ]
        ]
    ],
    'freeasso.paymenttype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::PaymentType',
        'url'        => '/v1/asso/payment_type',
        'controller' => 'FreeAsso::Controller::PaymentType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::PaymentType'
            ]
        ]
    ],
    'freeasso.paymenttype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::PaymentType',
        'url'        => '/v1/asso/payment_type/:ptyp_id',
        'controller' => 'FreeAsso::Controller::PaymentType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::PaymentType'
            ]
        ]
    ],
    'freeasso.paymenttype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::PaymentType',
        'url'        => '/v1/asso/payment_type/:ptyp_id',
        'controller' => 'FreeAsso::Controller::PaymentType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];
