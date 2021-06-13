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
            $emailId = $p_automate->getEmailId();
            if (!$emailId) {
                $emailId = $p_automate->getAutoParam('email_id', 0);
            }
            if ($emailId) {
                $filters = [
                    'email_id' => $emailId
                ];
            } else {
                $filters = [
                    'email_code' => 'DONATION'
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
                $edi1Id = $p_automate->getAutoParam('edi1_id', 0);
                if ($edi1Id) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $datas = $editionService->printEdition(
                        $edi1Id,
                        $client->getLangId(),
                        $p_donation
                    );
                    if (isset($datas['filename']) && is_file($datas['filename'])) {
                        $message->addAttachment($datas['filename'], $datas['name']);
                    }
                }
                $sendIdentity = $p_automate->getAutoParam('send_identity', false);
                if ($sendIdentity) {
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
