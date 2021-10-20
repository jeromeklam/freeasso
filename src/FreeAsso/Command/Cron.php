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
        $clientService->updateAll();
        $p_output->write("Fin de la mise à jour", true);
    }

    /**
     * Mise à jour des données des causes
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     * 
     * @return void
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

    /**
     * Undocumented function
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     * 
     * @return void
     */
    public function updateCauseMedia(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de la mise à jour", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $causeService->updateAllMedia();
        $p_output->write("Fin de la mise à jour", true);
    }

    /**
     * Update messages
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     * 
     * @return void
     */
    public function updateMessages(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de la mise à jour", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $datas = \FreeFW\Model\Message::find(['dest_id' => null]);
        /**
         * @var \FreeFW\Model\Message $oneMessage
         */
        foreach ($datas as $oneMessage) {
            switch ($oneMessage->getMsgObjectName()) {
                case 'FreeAsso_Certificate':
                    /**
                     * @var \FreeAsso\Model\Certificate $certificate
                     */
                    $certificate = \FreeAsso\Model\Certificate::findFirst(['cert_id' => $oneMessage->getMsgObjectId()]);
                    if ($certificate) {
                        $oneMessage
                            ->setDestId($certificate->getCliId())
                            ->setGrpId($certificate->getGrpId())
                        ;
                    }
                    break;
                case 'FreeAsso_Donation':
                    /**
                     * @var \FreeAsso\Model\Donation $donation
                     */
                    $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $oneMessage->getMsgObjectId()]);
                    if ($donation) {
                        $oneMessage
                            ->setDestId($donation->getCliId())
                            ->setGrpId($donation->getGrpId())
                        ;
                    }
                    break;
                case 'FreeAsso_Sponsorship':
                    /**
                     * @var \FreeAsso\Model\Sponsorship $sponsorship
                     */
                    $sponsorship = \FreeAsso\Model\Sponsorship::findFirst(['spo_id' => $oneMessage->getMsgObjectId()]);
                    if ($sponsorship) {
                        $oneMessage
                            ->setDestId($sponsorship->getCliId())
                            ->setGrpId($sponsorship->getGrpId())
                        ;
                    }
                    break;
                default:
                    break;
            }
            $oneMessage->save(false, true);
        }
        $p_output->write("Fin de la mise à jour", true);
    }
}
