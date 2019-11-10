<?php
/**
 * Config array
 */
$config = [
    'development' => true,
    'basepath'    => '/api',
    'logger'      => array(
        'file'  => APP_LOG.'/freeasso.log',
        'level' => \Psr\Log\LogLevel::DEBUG
    ),
    'sso' => array(
        'broker' => 'freeasso'
    ),
    'storage'     => [
        'default' => [
            'dsn'   => 'mysql:host=192.168.0.40;dbname=ecopattes;charset=utf8;',
            'user'  => 'root',
            'paswd' => 'm0n1c4po'
        ]
    ],
    'middleware'  => [
        'FreeFW::Middleware::IgnoreMethod',
        'FreeFW::Middleware::ApiNegociator',
        'FreeSSO::Middleware::Broker',
        'FreeFW::Middleware::AuthNegociator'
    ]
];
return $config;
