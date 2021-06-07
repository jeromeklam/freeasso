<?php
namespace FreeAsso\Command;

/**
 * Kalaweit commands
 *
 * @author jeromeklam
 */
class Cron
{
    /**
     * Mise à jour des données des clients
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function updateClient(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de la mise à jour", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $clientService = \FreeFW\DI\DI::get('FreeAsso::Service::Client');
        $clientService->updateLastDonations();
        $p_output->write("Fin de la mise à jour", true);
    }

    /**
     * Mise à jour des données des causes
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function updateCause(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
        ) {
        $p_output->write("Début de la mise à jour", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $causeService->updateAll();
        $p_output->write("Fin de la mise à jour", true);
    }
}
