<?php
$receiptRoutes = [
    /**
     * ########################################################################
     * Receipt
     * ########################################################################
     */
    'freeasso.receipt.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Receipt',
        'url'        => '/v1/asso/receipt',
        'controller' => 'FreeAsso::Controller::Receipt',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type', 'sponsorship']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Receipt'
            ]
        ]
    ],
    'freeasso.receipt.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Receipt',
        'url'        => '/v1/asso/receipt/:rec_id',
        'controller' => 'FreeAsso::Controller::Receipt',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type', 'sponsorship']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Receipt'
            ]
        ]
    ],
    'freeasso.receipt.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Receipt',
        'url'        => '/v1/asso/receipt/:rec_id',
        'controller' => 'FreeAsso::Controller::Receipt',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type', 'sponsorship']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Receipt'
            ]
        ]
    ],
    'freeasso.receipt.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Receipt',
        'url'        => '/v1/asso/receipt',
        'controller' => 'FreeAsso::Controller::Receipt',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause', 'payment_type', 'sponsorship']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Receipt'
            ]
        ]
    ],
    'freeasso.receipt.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Receipt',
        'url'        => '/v1/asso/receipt/:rec_id',
        'controller' => 'FreeAsso::Controller::Receipt',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

