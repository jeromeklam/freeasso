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
            /**
             * @var \FreeFW\Service\Email $emailService
             */
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
                    ->setDestId($client->getCliId())
                    ->setGrpId($p_donation->getGrpId())
                ;
                $edi1Id = $p_automate->getAutoParam('edi1_id', 0);
                if ($edi1Id) {
                    /**
                     * @var \FreeFW\Service\Edition $editionService
                     */
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
                            /**
                             * @var \FreeFW\Service\Edition $editionService
                             */
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
                        $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
                        $filename = $bDir . '/certificat_' . uniqid(true) . '.pdf';
                        file_put_contents($filename, $file->getFileBlob());
                        $message->addAttachment($filename, 'certificat.pdf');
                        $certificate->setCertPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $certificate->save();
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
                    ->setNotifSubject($p_automate->getAutoName() . ' : ' . $certificate->getCertFullname() . ' ' . $cause->getCauName())
                    ->setNotifCode('CERTIFICATE_WITHOUT_EMAIL')
                    ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                return $notification->create();
            }
        }
        return true;
    }

    /**
     * generate debit for one day
     *
     * @param \Datetime $p_start
     * @param boolean   $p_mode
     *
     * @return boolean
     */
    public function reviveAdoption(\Datetime $p_start, $p_mode = '1M')
    {
        $errors = false;
        $report = '';
        /**
         * @var \FreeFW\Model\Query $query
         */
        $dStart = clone ($p_start);
        switch ($p_mode) {
            case '1M':
                $dStart->add(new \DateInterval('P1M'));
                $dStart->setTime(0, 0, 0, 0);
                $dEnd = clone ($dStart);
                $dEnd->add(new \DateInterval('P1D'));
                $emailC = 'END_DONATION_1M';
                break;
            case '1D':
                $emailC = 'END_DONATION_1D';
                $dStart->setTime(0, 0, 0, 0);
                $dEnd = clone ($dStart);
                $dEnd->add(new \DateInterval('P1D'));
                break;
            case 'END':
                $emailC = 'END_DONATION';
                $dStart->setTime(0, 0, 0, 0);
                $dEnd = clone ($dStart);
                $dEnd->add(new \DateInterval('P1D'));
                break;
            default: // ??
                return "Unknown code : " . $p_mode;
                break;
        }
        $dStart->setTime(0, 0, 0, 0);
        $dEnd = clone ($dStart);
        $dEnd->add(new \DateInterval('P1D'));
        $query = \FreeAsso\Model\Donation::getQuery();
        $query
            ->addFromFilters(
                [
                    'don_end_ts' => [\FreeFW\Storage\Storage::COND_BETWEEN => [
                        \FreeFW\Tools\Date::datetimeToMysql($dStart),
                        \FreeFW\Tools\Date::datetimeToMysql($dEnd)
                    ]],
                    'cau_id'                         => [\FreeFW\Storage\Storage::COND_NOT_EMPTY],
                    'spo_id'                         => [\FreeFW\Storage\Storage::COND_EMPTY],
                    'cause.cause_type.caut_mnt_type' => \FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL,
                ]
            )
            ->addRelations(['client', 'cause', 'cause.cause_type'])
            ->setSort('client.cli_firstname,client.cli_lastname');
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                /**
                 * @var \FreeFW\Service\Email $emailService
                 */
                $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
                $report = '<ul>';
                /**
                 * @var \FreeAsso\Model\Donation $donation
                 */
                foreach ($results as $donation) {
                    $client = $donation->getClient();
                    $cause  = $donation->getCause();
                    if (!$cause->isActive($dEnd)) {
                        /**
                         * Add notification
                         * @var \FreeFW\Model\Notification $notification
                         */
                        $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                        $notification
                            ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                            ->setNotifObjectName('FreeAsso_Cause')
                            ->setNotifObjectId($cause->getCauId())
                            ->setNotifSubject('Active sponsorship on a disabled cause !')
                            ->setNotifCode('DONATION_ON_DISABLED_CAUSE')
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $notification->create();
                    }
                    $addN = true;
                    $mail = trim($client->getCliEmail());
                    if ($mail !== '') { //\FreeFW\Tools\Email::verify($mail)) {
                        // Send mail to client...
                        $filters = [
                            'email_code' => $emailC
                        ];
                        //var_dump($donation->getMergeData());die;
                        $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), $donation);
                        if ($message) {
                            $message
                                ->addDest($client->getCliEmail())
                                ->setDestId($client->getCliId())
                                ->setGrpId($donation->getGrpId())
                            ;
                            if ($message->create()) {
                                $addN = false;
                            } else {
                                var_dump($message->getErrors());die;
                            }
                        }
                    }
                    if ($addN) {
                        /**
                         * Add notification
                         * @var \FreeFW\Model\Notification $notification
                         */
                        $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                        $notification
                            ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                            ->setNotifObjectName('FreeAsso_Donation')
                            ->setNotifObjectId($donation->getDonId())
                            ->setNotifSubject('Donation ending !')
                            ->setNotifCode($emailC)
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $notification->create();
                    }
                }
                $report .= '</ul>';
            }
        } else {
            return false;
        }
        return $report;
    }

    /**
     * Verify ending donations
     *
     * @param array params
     *
     * @return array
     */
    public function reviveDonations($p_params = [])
    {
        $this->logger->debug('Donation.reviveAdoptions.START');
        /**
         *
         * @var \DateTime $lastOk
         */
        $lastOk = \FreeFW\Tools\Date::getServerDatetime();
        /**
         * @var \DateTime $now
         */
        $now    = \FreeFW\Tools\Date::getServerDatetime();
        if (array_key_exists('last', $p_params)) {
            $lastOk = \FreeFW\Tools\Date::mysqlToDatetime($p_params['last']);
        }
        $lastOk->setTime(0, 0, 0, 0);
        $now->setTime(0, 0, 0, 0);
        // Force same time...
        while ($lastOk < $now) {
            $result = $this->reviveAdoption(clone $lastOk, 'END');
            $lastOk->add(new \DateInterval('P1D'));
            $this->logger->debug('Generating ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . '...');
            $result = $this->reviveAdoption(clone $lastOk, '1D');
            $result = $this->reviveAdoption(clone $lastOk, '1M');
        }
        $this->logger->debug('Start from ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . ' excluded');
        $p_params['last'] = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->logger->debug('Donation.reviveAdoptions.END');
        return $p_params;
    }
}
