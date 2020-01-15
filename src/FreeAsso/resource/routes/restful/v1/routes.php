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
            '404' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Dashboard
     * ########################################################################
     */
    'freeasso.dashboard.stats' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'url'        => '/v1/asso/dashboard/stats',
        'controller' => 'FreeAsso::Controller::Dashboard',
        'function'   => 'statistics',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
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
    'freeasso.data.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Data',
        'url'        => '/v1/asso/data/:data_id',
        'controller' => 'FreeAsso::Controller::Data',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Catégories de client
     * ########################################################################
     */
    'freeasso.clientcategory.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientCategory'
            ]
        ]
    ],
    'freeasso.clientcategory.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::ClientCategory',
        'url'        => '/v1/asso/client_category/:clic_id',
        'controller' => 'FreeAsso::Controller::ClientCategory',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Types de client
     * ########################################################################
     */
    'freeasso.clienttype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::ClientType'
            ]
        ]
    ],
    'freeasso.clienttype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::ClientType',
        'url'        => '/v1/asso/client_type/:clit_id',
        'controller' => 'FreeAsso::Controller::ClientType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
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
    'freeasso.sitetype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::SiteType',
        'url'        => '/v1/asso/site_type/:sitt_id',
        'controller' => 'FreeAsso::Controller::SiteType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Types de cause principal
     * ########################################################################
     */
    'freeasso.causemaintype.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMainType'
            ]
        ]
    ],
    'freeasso.causemaintype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseMainType',
        'url'        => '/v1/asso/cause_main_type/:camt_id',
        'controller' => 'FreeAsso::Controller::CauseMainType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
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
        'include'    => [
            'default' => ['cause_main_type']
        ],
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
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_main_type']
        ],
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
        'include'    => [
            'default' => ['cause_main_type']
        ],
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
        'include'    => [
            'default' => ['cause_main_type']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseType'
            ]
        ]
    ],
    'freeasso.causetype.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseType',
        'url'        => '/v1/asso/cause_type/:caut_id',
        'controller' => 'FreeAsso::Controller::CauseType',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Sites
     * ########################################################################
     */
    'freeasso.site.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.site.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['site_type']
        ],
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
            'default' => ['site_type', 'owner', 'sanitary']
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
        'include'    => [
            'default' => ['site_type', 'owner', 'sanitary']
        ],
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
        'include'    => [
            'default' => ['site_type', 'owner', 'sanitary']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Site'
            ]
        ]
    ],
    'freeasso.site.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Site',
        'url'        => '/v1/asso/site/:site_id',
        'controller' => 'FreeAsso::Controller::Site',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Causes
     * ########################################################################
     */
    'freeasso.cause.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.cause.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'default_blob']
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
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'proprietary', 'default_blob']
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
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'proprietary']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause_type', 'cause_type.cause_main_type', 'site', 'parent1', 'parent2', 'proprietary']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Cause'
            ]
        ]
    ],
    'freeasso.cause.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Cause',
        'url'        => '/v1/asso/cause/:cau_id',
        'controller' => 'FreeAsso::Controller::Cause',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    /**
     * ########################################################################
     * Client
     * ########################################################################
     */
    'freeasso.client.autocomplete' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/autocomplete/:search',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'autocomplete',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT
            ]
        ]
    ],
    'freeasso.client.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client_category', 'client_type', 'country', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::Client'
            ]
        ]
    ],
    'freeasso.client.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::Client',
        'url'        => '/v1/asso/client/:cli_id',
        'controller' => 'FreeAsso::Controller::Client',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
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
    ],
    /**
     * ########################################################################
     * Cause Media
     * ########################################################################
     */
    'freeasso.causemedia.getall' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'getAll',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_LIST,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.getone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.updateone' => [
        'method'     => \FreeFW\Router\Route::METHOD_PUT,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'createOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemedia.deleteone' => [
        'method'     => \FreeFW\Router\Route::METHOD_DELETE,
        'model'      => 'FreeAsso::Model::CauseMedia',
        'url'        => '/v1/asso/cause_media/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
    'freeasso.causemediablob.createone' => [
        'method'     => \FreeFW\Router\Route::METHOD_POST,
        'model'      => 'FreeAsso::Model::CauseMediaBlob',
        'url'        => '/v1/asso/cause_media_blob',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'createOneBlob',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['cause', 'lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
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
            'default' => ['client', 'cause']
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
        'url'        => '/v1/asso/donation/:caum_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'getOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause']
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
        'url'        => '/v1/asso/donation/:caum_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'updateOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [
            'default' => ['client', 'cause']
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
            'default' => ['client', 'cause']
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
        'url'        => '/v1/asso/donation/:caum_id',
        'controller' => 'FreeAsso::Controller::Donation',
        'function'   => 'removeOne',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'results' => [
            '204' => [
            ]
        ]
    ],
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
            'default' => ['client', 'cause']
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
            'default' => ['client', 'cause']
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
            'default' => ['client', 'cause']
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
            'default' => ['client', 'cause']
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
return $localRoutes;
