<?php
$localCommands = [
    /**
     * ########################################################################
     * Sirene test
     * ########################################################################
     */
    'freeasso.sirene' => [
        'command'    => 'freeasso::testSirene',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'testSirene'
    ],
    /**
     * ########################################################################
     * Fill PDF
     * ########################################################################
     */
    'freeasso.fillpdf' => [
        'command'    => 'freeasso::fillPDF',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'fillPDF'
    ],
    /**
     * ########################################################################
     * Erreurs ??
     * ########################################################################
     */
    'freeasso.error' => [
        'command'    => 'freeasso::checkErrors',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'checkErrors'
    ],
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
    ],
    /**
     * ########################################################################
     * Mise à jour des messages
     * ########################################################################
     */
    'freeasso.cron.updatemessages' => [
        'command'    => 'client::updatemessages',
        'controller' => 'FreeAsso::Command::Cron',
        'function'   => 'updateMessages'
    ],
    /**
     * ########################################################################
     * Import fichier de compta
     * ########################################################################
     */
    'freeasso.cron.updatemessages' => [
        'command'    => 'accounting::import',
        'controller' => 'FreeAsso::Command::Accounting',
        'function'   => 'importFile'
    ]
];

return $localCommands;