<?php
use \FreeFW\Constants as FFCST;
use \FreeFW\Router\Route as FFCSTRT;

/**
 * Routes for LLM
 *
 * @author jeromeklam
 */
$llmRoutes = [
    'free_asso.llm.query' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/LLM',
        FFCSTRT::ROUTE_COMMENT    => 'Natural language query',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_POST,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::LlmQuery',
        FFCSTRT::ROUTE_URL        => '/v1/asso/llm/query',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Llm',
        FFCSTRT::ROUTE_FUNCTION   => 'naturalQuery',
        FFCSTRT::ROUTE_ROLE       => FFCSTRT::ROLE_CREATE_ONE,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::LlmQuery',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'MongoDB-style query result',
            ],
        ]
    ],
    'free_asso.llm.models' => [
        FFCSTRT::ROUTE_COLLECTION => 'FreeAsso/Asso/LLM',
        FFCSTRT::ROUTE_COMMENT    => 'List available LLM models',
        FFCSTRT::ROUTE_METHOD     => FFCSTRT::METHOD_GET,
        FFCSTRT::ROUTE_MODEL      => 'FreeAsso::Model::LlmQuery',
        FFCSTRT::ROUTE_URL        => '/v1/asso/llm/models',
        FFCSTRT::ROUTE_CONTROLLER => 'FreeAsso::Controller::Llm',
        FFCSTRT::ROUTE_FUNCTION   => 'getModels',
        FFCSTRT::ROUTE_ROLE       => FFCSTRT::ROLE_GET_OTHER,
        FFCSTRT::ROUTE_AUTH       => FFCSTRT::AUTH_IN,
        FFCSTRT::ROUTE_MIDDLEWARE => [],
        FFCSTRT::ROUTE_INCLUDE    => [],
        FFCSTRT::ROUTE_SCOPE      => [],
        FFCSTRT::ROUTE_RESULTS    => [
            '200' => [
                FFCSTRT::ROUTE_RESULTS_TYPE    => FFCSTRT::RESULT_OBJECT,
                FFCSTRT::ROUTE_RESULTS_MODEL   => 'FreeAsso::Model::LlmQuery',
                FFCSTRT::ROUTE_RESULTS_COMMENT => 'List of available models',
            ],
        ]
    ],
];
