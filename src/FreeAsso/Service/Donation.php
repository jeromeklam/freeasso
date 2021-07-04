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
                        $certificate->setCertPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        return $certificate->save();
                    }
                }
                if (!$message->create()) {
                    return false;
                }
            }
        } else {
            $certificate = $p_donation->getCertificate();
            if ($certificate) {
                $cause = $p_donation->getCause();
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifObjectName('FreeAsso_Certificate')
                    ->setNotifObjectId($certificate->getCertId())
                    ->setNotifSubject('Nouveau certificat sans email : ' . $certificate->getCertFullname() . ' ' . $cause->getCauName())
                    ->setNotifCode('CERTIFICATE_WITHOUT_EMAIL')
                    ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ;
                return $notification->create();
            }
        }
        return true;
    }
}
