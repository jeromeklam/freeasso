<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

$memberRoutes = [
    /**
     * ########################################################################
     * Member
     * ########################################################################
     */
    'freeasso.member.infos' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/infos',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'infos',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    /**
     * ########################################################################
     * Member
     * ########################################################################
     */
    'freeasso.member.infos.update' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Update.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_PUT,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/infos',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'updateInfos',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    /**
     * ########################################################################
     * Member
     * ########################################################################
     */
    'freeasso.member.infos.email' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Update.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_PUT,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/email',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'updateEmail',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.gibbons' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/gibbons',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'gibbons',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.donations' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/donations',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'donations',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.sponsorships' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/sponsorships',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'sponsorships',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.receipts' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/receipts',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'receipts',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.receipt_download' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/receipts/:rec_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'downloadReceipt',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
            'receipt_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_INTEGER,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Id du reçu'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.certificates' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/certificates',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'certificates',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.certificate_download' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/certificates/:cert_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'downloadCertificate',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
            'rcert_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_INTEGER,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Id du certificat'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
    'freeasso.member.cause_download' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Member',
        FFCSTRT::ROUTE_COMMENT    => 'Autocomplete.',
        FFCSTRT::ROUTE_METHOD     => \FreeFW\Router\Route::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/member/:cli_email/cause/:cau_id',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Member',
        FFCSTRT::ROUTE_FUNCTION   => 'downloadCauseEdition',
        FFCSTRT::ROUTE_AUTH       => \FreeFW\Router\Route::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_PARAMETERS => [
            'email' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_STRING,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Email du membre'
            ],
            'cau_id' => [
                FFCSTRT::ROUTE_PARAMETER_ORIGIN   => FFCSTRT::ROUTE_PARAMETER_ORIGIN_PATH,
                FFCSTRT::ROUTE_PARAMETER_TYPE     => FFCST::TYPE_INTEGER,
                FFCSTRT::ROUTE_PARAMETER_REQUIRED => true,
                FFCSTRT::ROUTE_PARAMETER_COMMENT  => 'Id de la cause'
            ],
        ],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
];
