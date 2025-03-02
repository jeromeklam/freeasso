<?php

namespace FreeAsso\Command;

/**
 * Kalaweit commands
 *
 * @author jeromeklam
 */
class Accounting
{
    /**
     * Import d'un fichier
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function importFile(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de l'import", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $filename = $p_input->read('filename', null);
        if (!is_file($filename)) {
            $p_output->write("Fichier non trouvé : " . $filename, true);
        } else {
            $accountingService = \FreeFW\DI\DI::get('FreeAsso::Service::accounting');
            $accountingService->importFile($filename);
        }
        $p_output->write("Fin de l'import", true);
    }
}
