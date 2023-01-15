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
     * Test Sirene API
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function testSirene(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Sirene test START", true);
        $config  = \FreeFW\Di\Di::getShared('config');
        $api_cfg = $config->get('api:insee');
        $api     = \FreeAPI\INSEE\Sirene\Siret::getInstance($api_cfg);
        $result  = $api->find(['nom' => '*zoo*', 'ville' => 'amneville']);
        //var_dump($result);
        $p_output->write("Sirene test END", true);
    }

    /**
     * Fill PDF
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function fillPDF(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Fill PDF START", true);
        $file = APP_ROOT . '/data/2041-mec-sd_4032-lala.pdf';
        $pdf = new \mikehaertl\pdftk\Pdf($file);
        $result = $pdf->fillForm([
                'a1'=>'123456789',
                'a2' => 'Association KALAWEIT',
                'a4' => '449 804 053',
                'a6' => '69',
                'a7' => 'MOUFFETARD',
                'a8' => '75005',
                'a9' => 'PARIS',
                'a10' => 'FRANCE',
                'a11' => 'Désignation don',
                'a12' => '',
                'a13' => '',
                'a14' => '',
                'a15' => '',
                'a16' => '',
                'a17' => '',
                'a18' => '',
                'a19' => '11',
                'a20' => 'RUE DE LA MARNE',
                'a21' => '57050',
                'a22' => 'LE BAN ST MARTIN',
                'a23' => '',
                'a24' => '',
                'a25' => '',
                'a26' => '',
                'a27' => '123,00',
                'a28' => 'Cent vingt trois euros',
                'a29' => '',
                'a30' => '123,00',
                'a33' => 'Cent vingt trois euros',
                'a35' => '29/12/2022',
                'a50' => 'KLAM Jérôme',
                'a51' => 'SCI',
                'a52' => '1234567890',
                'CAC1' => 1,
                'CAC0' => 1,
                'CAC11' => 1,
                //'CAC40' => 'A',
                //'CAC41' => 'A',
                'CAC40' => 'C',
                //'CAC43' => 'A',
            ])
            ->flatten()
            ->saveAs(APP_ROOT . '/data/filled.pdf')
        ;
        // Always check for errors
        if ($result === false) {
            $error = $pdf->getError();
            $p_output->write($error, true);
        }
        $p_output->write("Fill PDF END", true);
    }

    /**
     * Send errors
     *
     * @param \FreeFW\Console\Input\AbstractInput $p_input
     * @param \FreeFW\Console\Output\AbstractOutput $p_output
     */
    public function checkErrors(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Des erreurs ??", true);
        $file = ini_get('error_log');
        if (is_file($file)) {
            $content = file_get_contents($file);
            if ($content != '') {
                $p_output->write("Sending errors...", true);
                /**
                 * @var \FreeFW\Service\Message $msgService
                 */
                $msgService = \FreeFW\DI\DI::get('FreeFW::Service::Message');
                $msgService->sendAdminMessage('Errors on ' . gethostname(), $content);
                @unlink($file);
            }
        }
        $p_output->write("Fin de la vérification des erreurs", true);
    }

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
