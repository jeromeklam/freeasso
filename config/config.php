<?php
/**
 * Config array
 */
$config = [
    'development' => true,
    'basepath'    => '/api',
    'logger'      => [
        'file'  => APP_LOG.'/freeasso.log',
        'level' => \Psr\Log\LogLevel::DEBUG
    ],
    'sso' => [
        'broker' => 'ecopattes'
    ],
    'queue' => [
        'name' => 'freeasso-lesecopattes',
        'host' => 'rabbit',
        'port' => 5672,
        'user' => 'guest',
        'paswd' => 'guest'
    ],
    'storage'     => [
        'default' => [
            'dsn'   => 'mysql:host=mysql;dbname=freeasso;charset=utf8;',
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
// JWT config
$config['jwt'] = [
    'duration' => 360000
];
$config['jwt']['privateKey'] = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAuHhmkr976lyEm0sdGIWrQUyaAtuo25cOaW6GzbL2tmhzotqj
/fDujwyiDgrQtTcjXLMDV59MvKccKnjO/BO4E493qZ/KBSlgpO7j7CVLPstIkzrY
a7KnRwAlGyQkooZq3Mzjc3Ge15ICNgQQSG2L+4ajc7DQh/o/wZxUmBg0GWULXTv6
B3i4wklWmQCw5yrN2FHefLLtN5mWIkSiAhARH3qQrJxTmC71bYefSxz1aFKWowrU
RZueow3FXA1xDHs4oejyAO/yWi323aFY/7c6/9Iz7lvnmNCUIVSHDzNbOKi4dnxJ
SwPx2dpj8ArAYb+ToZMAhOJXDapDF+J+ulc3CQIDAQABAoIBAHA60Cz30qwDHapd
SJZivI49zHVwrorqnBoI5HrBJthTNAcgfiVBL+JYDT/91Hxrz1fWkXH9uPINuVUd
qtAyLwu3fVX1oTMCuYmezYweJGlPxBfO9VyQlLTdobWhh6hZnyo2fSr/NWRxsGas
kjt+amvcvhTkvfn8hk2EjvL5xrireEdizZniiTTY8sXwU+nAq922tqG/OvGngXUh
trXEhv4TUctOryWCoM32JnhyTXRhYvDzG4s+Q9ybZH40nf3mdRfNEKd+K3gZ/RdD
K7BfmFQ6pMEyqcc4xGFAYi8eFSZ+ZiHENE5QVIchNg94LYpJj0oqunxi3ep2tIXh
5u6G6wECgYEA47/f0cdWOdTsnsa1/xL7OfhjifZbX+aBfg043sUDUCdA564bqJBJ
BrHwYZ1DSETSzw7cTIdg19tJO2nB1kWiZSAE0YYG0kbOTj5sHNAC3qQ5S09F+4Jt
4161we9+s0hmqmWtJ9WxybMjjbUHuwOI/Y/IHxRGtzyMDmp/u1UX/BcCgYEAz1o0
/E3L+nZjcwAWwN2BNf20q+SBsSnWBP8KqMoGMy/w04hciw4nOjwPTWfV8LD2y5H8
UYNNlOMZLiXozdEXXmhmib9wMc63QMFP7PWxbbHEgr3A/3CQo3Gjrc7A9MAOMtdr
jC1hjEOLTELu58QtYcGz1up2D+k6xVdcT9Kqud8CgYEAqVxC9X3VehYDi6LbLf6Q
gbBbXPmtQ2hnPTRZ6Rb6er1l/6MygCwjke36gqxunyxG06EKY4J8mqhAEgV4Fn4b
4DVqP+D5656pxfeXb+mjaKsYzA78TKbWTrFcWgZd4rZhWi9YD3pSxloHg1ZulDxx
v5UPTUVHvPUydXnu2IDT4CsCgYB10GZsuPNeIyhMbk9/VBwXhkjCpjo+ZGvzOMpg
rzEoomOufTs/01Hcl8WGEKqRcKs5bYA0/Gr3XrWu7+FAGD6z6JPiToC7/B1JUM1N
8SfYEPp74r8nJFk6VNZQajpelkU7BAVah2p2nOYn9Zvy2heDBOFfCqb8UWOQPxv3
StawdwKBgAENbZqLtbkF+z4RbmzsBhFhwHRS+Heka1MXUvqVjGh0Tfvn4q20qeYf
MeFQKruHo+vVjZCyJtQHQmmwIt71Q1aQzRbduTA+xh3wRTD/b4V4uNx51d0ROYW6
ZXOoTLTGv0mMuS70tY4FlwvIVfgNzDYOSBUNHqdCB/MZ4aqZFIkm
-----END RSA PRIVATE KEY-----
EOD;
$config['jwt']['publicKey'] = <<<EOD
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAuHhmkr976lyEm0sdGIWr
QUyaAtuo25cOaW6GzbL2tmhzotqj/fDujwyiDgrQtTcjXLMDV59MvKccKnjO/BO4
E493qZ/KBSlgpO7j7CVLPstIkzrYa7KnRwAlGyQkooZq3Mzjc3Ge15ICNgQQSG2L
+4ajc7DQh/o/wZxUmBg0GWULXTv6B3i4wklWmQCw5yrN2FHefLLtN5mWIkSiAhAR
H3qQrJxTmC71bYefSxz1aFKWowrURZueow3FXA1xDHs4oejyAO/yWi323aFY/7c6
/9Iz7lvnmNCUIVSHDzNbOKi4dnxJSwPx2dpj8ArAYb+ToZMAhOJXDapDF+J+ulc3
CQIDAQAB
-----END PUBLIC KEY-----
EOD;

return $config;
