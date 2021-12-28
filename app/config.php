<?php

/**
 * Config array
 */
$config = [
    'middleware'  => [
        'FreeFW::Middleware::IgnoreMethod',
        'FreeSSO::Middleware::Broker',
        'FreeFW::Middleware::AuthNegociator',
        'FreeFW::Middleware::Scope',
        'FreeFW::Middleware::ApiNegociator',
        'FreeFW::Middleware::RouteHandler'
    ],
    'event' => [
        \FreeAsso\Constants::EVENT_NEW_DONATION,
        \FreeAsso\Constants::EVENT_NEW_SPONSORSHIP,
        \FreeAsso\Constants::EVENT_END_CAUSE,
        \FreeAsso\Constants::EVENT_END_SPONSORSHIP,
        \FreeSSO\Constants::EVENT_USER_VALIDATION,
    ]
];

return $config;
