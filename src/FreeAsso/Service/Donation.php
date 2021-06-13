<?php
namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Donation extends \FreeFW\Core\Service
{

    /**
     * Send notification
     *
     * @param \FreeAsso\Model\Donation $p_donation
     * @param string                   $p_event_name
     * @param \FreeFW\Model\Automate   $p_automate
     *
     * @return boolean
     */
    public function notification($p_donation, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
        $client = $p_donation->getClient();
        if ($client->getCliEmail() != '') {
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            $filters = [
                'email_code' => 'DONATION'
            ];
            if (is_array($p_params) && isset($p_params['email_id'])) {
                $filters = [
                    'email_id' => $p_params['email_id']
                ];
            }
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), $p_donation);
            if ($message) {
                $message
                    ->addDest($client->getCliEmail())
                ;
                if (is_array($p_params) && isset($p_params['edi1_id'])) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $datas = $editionService->printEdition(
                        $p_params['edi1_id'],
                        $client->getLangId(),
                        $p_donation
                    );
                    if (isset($datas['filename']) && is_file($datas['filename'])) {
                        $message->addAttachment($datas['filename'], $datas['name']);
                    }
                }
                if (is_array($p_params) && isset($p_params['send_identity']) && $p_params['send_identity'] == true) {
                    $cause = $p_donation->getCause();
                    if ($cause) {
                        $causeType = $cause->getCauseType();
                        $ediId = $causeType->getCautIdentEdiId();
                        if ($ediId > 0) {
                            $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                            $datas = $editionService->printEdition(
                                $ediId,
                                $client->getLangId(),
                                $cause
                            );
                            if (isset($datas['filename']) && is_file($datas['filename'])) {
                                $message->addAttachment($datas['filename'], $cause->getCauName() . '.pdf');
                            }
                        }
                    }
                }
                $certificate = $p_donation->getCertificate();
                if ($certificate) {
                    $file = $certificate->getFile();
                    if ($file) {
                        $cfg  = $this->getAppConfig();
                        $dir  = $cfg->get('ged:dir');
                        if (!is_dir($dir)) {
                            $dir = '/tmp/';
                        }
                        $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
                        $filename = $bDir . '/certificat_' . uniqid(true) . '.pdf';
                        file_put_contents($filename, $file->getFileBlob());
                        $message->addAttachment($filename, 'certificat.pdf');
                    }
                }
                if (!$message->create()) {
                    return false;
                }
                $certificate->setCertPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                return $certificate->save();
            }
        } else {
            $certificate = $p_donation->getCertificate();
            if ($certificate) {
                $cause = $p_donation->getCause();
                $alert = new \FreeFW\Model\Alert();
                $alert
                    ->setAlertObjectName('FreeAsso_Certificate')
                    ->setAlertObjectId($certificate->getCertId())
                    ->setAlertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setAlertFrom(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setAlertTitle('Certificat ' . $certificate->getCertFullname() . ' ' . $cause->getCauName())
                    ->setTodoAlert()
                    ->setAlertDoneAction(\FreeAsso\Constants::ACTION_CERTIFICATE_PRINT)
                ;
                if (!$alert->create()) {
                    $this->addErrors($alert->getErrors());
                    return false;
                }
            }
        }
        return true;
    }
}
