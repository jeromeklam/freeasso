<?php
$localRoutes = [
    /**
     * ########################################################################
     * Routes spécifiques
     * ########################################################################
     */
    'freeasso.specific.404' => [
        'method'     => \FreeFW\Router\Route::METHOD_ALL,
        'url'        => '/v1/asso/404',
        'controller' => 'FreeAsso::Controller::Specific',
        'function'   => 'specific404',
        'auth'       => \FreeFW\Router\Route::AUTH_NONE,
        'middleware' => [],
        'results' => [
            '200' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Configs
     * ########################################################################
     */
    'freeasso.config.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Config',
        'url'        => '/v1/asso/config',
        'controller' => 'FreeAsso::Controller::Config',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Config'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Datas
     * ########################################################################
     */
    'freeasso.data.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    'freeasso.data.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Data'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Types de site
     * ########################################################################
     */
    'freeasso.sitetype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type_datas']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    'freeasso.sitetype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::SiteType'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Types de cause
     * ########################################################################
     */
    'freeasso.causetype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Sites
     * ########################################################################
     */
    'freeasso.site.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    /**
     * ########################################################################
     * Causes
     * ########################################################################
     */
    'freeasso.cause.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'site']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
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
    ]
];
return $localRoutes;
