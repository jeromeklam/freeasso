<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for Api
 *
 * @author jeromeklam
 */
$apiRoutes = [
    'free_asso.api.siret' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/Api',
        FFCSTRT::ROUTE_COMMENT    => 'SIRET',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_URL        => '/v1/asso/api/siret',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Api',
        FFCSTRT::ROUTE_FUNCTION   => 'siret',
        FFCSTRT::ROUTE_ROLE       => \FreeFW\Router\Route::ROLE_OTHER,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_LIST,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::Data',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'Réponse ok',
            ],
        ]
    ],
];