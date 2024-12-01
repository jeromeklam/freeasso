<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for Group
 *
 * @author jeromeklam
 */
$routes_sso = [
    'free_s_s_o.user.colleagues' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Retourne les collègues de l\'utilisateur',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::User',
        FFCSTRT::ROUTE_URL        => '/v1/sso/colleagues',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'colleagues',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => []
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Liste des collègues',
            ]
        ]
    ],
    'free_s_s_o.user.register' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Demande de connexion de l\'utilisateur',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::Signin',
        FFCSTRT::ROUTE_URL        => '/v1/sso/register',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'register',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_OUT,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms', 'default_group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Connexion créée',
            ]
        ]
    ],
    'free_s_s_o.user.signin' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Demande de connexion de l\'utilisateur',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::Signin',
        FFCSTRT::ROUTE_URL        => '/v1/sso/signin',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'signIn',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_OUT,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms', 'default_group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Connexion créée',
            ]
        ]
    ],
    'free_s_s_o.user.signout' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Demande de déconnexion de l\'utilisateur',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_URL        => '/v1/sso/signout',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'signOut',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '204' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Connexion supprimée',
            ]
        ]
    ],
    'free_s_s_o.user.save' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Mise à jour des données de l\'utilisateur connecté',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_PUT,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::User',
        FFCSTRT::ROUTE_URL        => '/v1/sso/save',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'save',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms', 'default_group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Utilisateur modifié',
            ]
        ]
    ],
    'free_s_s_o.user.switch' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Demande de changement de group courant',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_PUT,
        FFCSTRT::ROUTE_URL        => '/v1/sso/switch_group/:grp_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'switchGroup',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms', 'default_group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'grp_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Identifiant du groupe'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Utilisateur en cours',
            ]
        ]
    ],
    'free_s_s_o.user.check' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Existe-t-il une connexion en cours ?',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_URL        => '/v1/sso/check',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'check',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms', 'default_group']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Utilisateur en cours',
            ]
        ]
    ],
    'free_s_s_o.user.askpassword' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Demande de mot de passe oublié',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::Signin',
        FFCSTRT::ROUTE_URL        => '/v1/sso/ask-password',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'askPassword',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_NONE,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '201' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::PasswordToken',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Demande enregistrée et email envoyé',
            ]
        ]
    ],
    'free_s_s_o.user.updatepassword' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Changement de mot de passe avec token',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::Signin',
        FFCSTRT::ROUTE_URL        => '/v1/sso/update-password',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'changePassword',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '204' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Mot de passe modifié',
            ]
        ]
    ],
    'free_s_s_o.user.changepassword' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Changement de mot de passe connecté avec confirmation',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::Signin',
        FFCSTRT::ROUTE_URL        => '/v1/sso/change-password',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'changePassword',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_NONE,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '204' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Mot de passe modifié',
            ]
        ]
    ],
    'free_s_s_o.user.updateconfig' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeSSO/Sso/User',
        FFCSTRT::ROUTE_COMMENT    => 'Mise à jour de la configuration de l\'utilisateur connecté',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeSSO::Model::User',
        FFCSTRT::ROUTE_URL        => '/v1/sso/update-config',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeSSO::Controller::Sso',
        FFCSTRT::ROUTE_FUNCTION   => 'updateConfig',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_BOTH,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [
            FFCSTRT::ROUTE_INCLUDE_DEFAULT => ['lang', 'config', 'realms']
        ],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeSSO::Model::User',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Utilisateur modifié',
            ]
        ]
    ],
];
