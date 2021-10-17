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
    ],
    /**
     * ########################################################################
     * Mise à jour des données des clients
     * ########################################################################
     */
    'freeasso.cron.updateclient' => [
        'command'    => 'client::update',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'updateClient'
    ],
    /**
     * ########################################################################
     * Mise à jour des données des causes
     * ########################################################################
     */
    'freeasso.cron.updatecause' => [
        'command'    => 'cause::update',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'updateCause'
    ],
    /**
     * ########################################################################
     * Mise à jour des médias des causes
     * ########################################################################
     */
    'freeasso.cron.updatecausemedia' => [
        'command'    => 'cause::updatemedia',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'updateCauseMedia'
    ]
];

return $localCommands;