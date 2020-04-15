<?php
$certificateRoutes = [
    /**
     * ########################################################################
     * Certificate
     * ########################################################################
     */
    'freeasso.certificate.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Certificate',
        'url'        => '/v1/asso/certificate',
        'controller' => 'FreeAsso::Controller::Certificate',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Certificate'
            ]
        ]
    ],
    'freeasso.certificate.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Certificate',
        'url'        => '/v1/asso/certificate/:cert_id',
        'controller' => 'FreeAsso::Controller::Certificate',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Certificate'
            ]
        ]
    ],
    'freeasso.certificate.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Certificate',
        'url'        => '/v1/asso/certificate/:cert_id',
        'controller' => 'FreeAsso::Controller::Certificate',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Certificate'
            ]
        ]
    ],
    'freeasso.certificate.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Certificate',
        'url'        => '/v1/asso/certificate',
        'controller' => 'FreeAsso::Controller::Certificate',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => []
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Certificate'
            ]
        ]
    ],
    'freeasso.certificate.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Certificate',
        'url'        => '/v1/asso/certificate/:cert_id',
        'controller' => 'FreeAsso::Controller::Certificate',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
];

