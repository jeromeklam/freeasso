<?php
$causeLinkRoutes = [
    /**
     * ########################################################################
     * Cause Link
     * ########################################################################
     */
    'freeasso.causelink.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseLink',
        'url'        => '/v1/asso/cause_link',
        'controller' => 'FreeAsso::Controller::CauseLink',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type_link_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseLink'
            ]
        ]
    ],
];
