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
    ]
];

return $localCommands;