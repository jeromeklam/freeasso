<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for CauseMedia
 *
 * @author jeromeklam
 */
$causeMediaRoutes = [
    'free_asso.cause_media.updateonedesc' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Modifie la description',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_PUT,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMediaBlob',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media/description/:caum_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'updateOneDesc',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_UPDATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['cause', 'versions', 'versions.lang']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'caum_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet modifié',
            ],
        ]
    ],
    'free_asso.cause_media.autocomplete' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media/autocomplete/:search',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'autocomplete',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_AUTOCOMPLETE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'search' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Chaine de recherche'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_asso.cause_media.getall' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne une liste filtrée, triée et paginée.',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'getAll',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_FILTERED,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['cause', 'versions', 'versions.lang']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_asso.cause_media.getone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne un objet selon son identifiant',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media/:caum_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'getOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_GET_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['cause', 'versions', 'versions.lang']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'caum_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'free_asso.cause_media.createone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Créé un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'createOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_CREATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['cause', 'versions', 'versions.lang']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet créé',
            ],
        ]
    ],
    'free_asso.cause_media.updateone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Modifie un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_PUT,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media/:caum_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'updateOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_UPDATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['cause', 'versions', 'versions.lang']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'caum_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::CauseMedia',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet modifié',
            ],
        ]
    ],
    'free_asso.cause_media.removeone' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/CauseMedia',
        FFCSTRT::ROUTE_COMMENT    => 'Supprime un objet',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_DELETE,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::CauseMedia',
        FFCSTRT::ROUTE_URL        => '/v1/asso/cause_media/:caum_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::CauseMedia',
        FFCSTRT::ROUTE_FUNCTION   => 'removeOne',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_DELETE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'caum_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_BIGINT,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant de l\'objet'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '204' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Objet supprimé',
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
            'default' => ['cause', 'versions', 'versions.lang']
        ],
        'results' => [
            '201' => [
                'type'  => \FreeFW\Router\Route::RESULT_OBJECT,
                'model' => 'FreeSso::Model::CauseMedia'
            ]
        ]
    ],
    'freeasso.causemediablob.downloadone' => [
        'method'     => \FreeFW\Router\Route::METHOD_GET,
        'model'      => 'FreeAsso::Model::CauseMediaBlob',
        'url'        => '/v1/asso/cause_media_blob/download/:caum_id',
        'controller' => 'FreeAsso::Controller::CauseMedia',
        'function'   => 'downloadOneBlob',
        'auth'       => \FreeFW\Router\Route::AUTH_IN,
        'middleware' => [],
        'include'    => [],
        'results' => [
            '200' => [
                'type'  => \FreeFW\Router\Route::RESULT_DATA,
            ]
        ]
    ],
];
