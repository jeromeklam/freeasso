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
            'dsn'   => 'mysql:host=mysql;dbname=ecopattes;charset=utf8;',
            'user'  => 'super',
            'paswd' => 'YggDrasil'
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
