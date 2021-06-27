<?php

/**
 * Config array
 */
$config = [
    'middleware'  => [
        'FreeFW::Middleware::IgnoreMethod',
        'FreeSSO::Middleware::Broker',
        'FreeFW::Middleware::AuthNegociator',
        'FreeFW::Middleware::ApiNegociator',
        'FreeFW::Middleware::RouteHandler'
    ],
    'event' => [
        \FreeAsso\Constants::EVENT_END_CAUSE,
        \FreeAsso\Constants::EVENT_END_SPONSORSHIP
    ]
];

return $config;
