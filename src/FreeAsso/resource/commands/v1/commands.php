<?php
$localCommands = [
    /**
     * ########################################################################
     * Routes Kalaweit
     * ########################################################################
     */
    'freeasso.kalaweit.import' => [
        'command'    => 'kalaweit::import',
        'controller' => 'FreeAsso::Command::Kalaweit',
        'function'   => 'import'
    ],
    /**
     * ########################################################################
     * Routes Les Eco Pattes
     * ########################################################################
     */
    'freeasso.lesecopattes.import' => [
        'command'    => 'lesecopattes::import',
        'controller' => 'FreeAsso::Command::Lesecopattes',
        'function'   => 'import'
    ]
];

return $localCommands;