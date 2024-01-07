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
     * For each donation, verify session
     *
     * @return void
     */
    public function updateSession($p_params = [])
    {
        /**
         * @var \FreeFW\Model\Query $query
         */
        $dNow = new \DateTime('now');
        $year = $dNow->format('Y');
        $query = \FreeAsso\Model\Donation::getQuery();
        $dStart = $year . '-01-01 00:00:00';
        $dEnd = $year . '-12-31 23:59:59';
        $query->addFromFilters(
            [
                'don_real_ts' => [ \FreeFW\Storage\Storage::COND_BETWEEN => [$dStart, $dEnd] ]
            ]
        );
        $query->execute([], 'verifySession');
        return $p_params;
    }

    /**
     * Undocumented function
     *
     * @param array $p_params
     * @return void
     */
    public function verifyDonations($p_params = [])
    {
        /**
         * @var \FreeSSO\Server $sso
         */
        $sso = \FreeFW\DI\DI::getShared('sso');
        $grp = $sso->getUserGroup();
        if (array_key_exists('year', $p_params)) {
            $year = $p_params['year'];
        } else {
            $year = date('Y');
        }
        if (array_key_exists('month', $p_params)) {
            $month = $p_params['month'];
        } else {
            $month = date('m');
        }
        $from = new \DateTime();
        $from->setDate($year, $month, 1);
        $from->setTime(0, 0, 1);
        $to = clone($from);
        $to = \FreeFW\Tools\Date::addMonths($to, 1);
        $check = \FreeAsso\Model\Sponsorship::find(
            [
                'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL_OR_NULL => \FreeFW\Tools\Date::datetimeToMysql($to)],
                'spo_to' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::datetimeToMysql($from)],
                'grp_id' => $grp->getGrpId()
            ]
        );
        foreach ($check as $oneSponsorship) {
            $donations = \FreeAsso\Model\Donation::find(
                [
                    'don_real_ts' => [\FreeFW\Storage\Storage::COND_BETWEEN => [
                        \FreeFW\Tools\Date::datetimeToMysql($from),
                        \FreeFW\Tools\Date::datetimeToMysql($to)
                    ]],
                    'don_mnt' => [\FreeFW\Storage\Storage::COND_GREATER => 0],
                    'spo_id'  => $oneSponsorship->getSpoId()
                ]
            );
            if ($donations->count() != 1) {
                /**
                 * @var \FreeAsso\Model\Client $client
                 */
                $client = $oneSponsorship->getClient();
                $subject = "Don à contrôler " . $month . "/" . $year . " : " . $oneSponsorship->getCause()->getCauName() . '(' . $oneSponsorship->getSpoMnt() . $oneSponsorship->getSpoMoney() . ')';
                $texte   = $subject . "\n" . "Nombre de dons : " . $donations->count();
                $texte  .= "\n" . "Donateur : " . $client->getCliFullname();
                $texte  .= "\n------";
                $this->logger->info($texte);
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                    ->setNotifObjectName('FreeAsso_Client')
                    ->setNotifObjectId($client->getCliId())
                    ->setNotifObjectInfo($client->getCliFullname())
                    ->setNotifSubject($subject)
                    ->setNotifCode('SPONSORSHIP_CONTROL')
                    ->setNotifText($texte)
                    ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                $notification->create();
            }
        }
        return $p_params;
    }

    /**
     * Send notification
     *
     * @param \FreeAsso\Model\Donation $p_donation
     * @param string                   $p_action
     * @param boolean                  $p_send_identity
     *
     * @return boolean
     */
    public function notification($p_donation, $p_action = "create", $p_send_identity = false)
    {
        /**
         * @var \FreeAsso\Model\Client $client
         */
        $client = $p_donation->getClient();
        if ($client->getCliEmail() != '') {
            /**
             * @var \FreeFW\Service\Email $emailService
             */
            $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
            /**
             * @var \FreeAsso\Model\Cause $cause
             * @var \FreeAsso\Model\CauseType $causeType
             */
            $cause = $p_donation->getCause();
            if ($cause) {
                $causeType = $cause->getCauseType();
            }
            $emailId = false;
            $ediId = false;
            if ($causeType) {
                switch ($p_action) {
                    case 'create':
                        $emailId = $causeType->getCautDonAddEmailId();
                        $ediId = $causeType->getCautIdentEdiId();
                        break;
                    case 'update':
                        $emailId = $causeType->getCautDonUpdateEmailId();
                        $ediId = $causeType->getCautIdentEdiId();
                        break;
                    case 'remove':
                        $emailId = $causeType->getCautDonEndEmailId();
                        $ediId = $causeType->getCautIdentEdiId();
                        break;
                }
            }
            if ($emailId) {
                $filters = [
                    'email_id' => $emailId
                ];
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
                    if ($p_send_identity && $ediId) {
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
            }
        } else {
            $certificate = $p_donation->getCertificate();
            if ($certificate) {
                $cause = $p_donation->getCause();
                $notification = new \FreeFW\Model\Notification();
                $texte = 'Paiement : ' . $certificate->getCertFullname() . ' ' . $cause->getCauName();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifObjectName('FreeAsso_Certificate')
                    ->setNotifObjectId($certificate->getCertId())
                    ->setNotifSubject($texte)
                    ->setNotifObjectInfo($certificate->getCertFullname())
                    ->setNotifCode('CERTIFICATE_WITHOUT_EMAIL')
                    ->setNotifText($texte)
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
                    'cause.cau_to'                   => [\FreeFW\Storage\Storage::COND_EMPTY],
                    'don_send_email'                 => 1,
                ]
            )
            ->addRelations(['client', 'cause', 'cause.cause_type'])
            ->setSort('client.cli_firstname,client.cli_lastname')
        ;
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
                    // On ne contrôle plus qu'il y ait un autre don ponctuel sur le même Gibbon en cours.
                    // On reste sur une gestion unitaire
                    $client  = $donation->getClient();
                    $cause   = $donation->getCause();
                    $cauType = $cause->getCauseType();
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
                            ->setNotifObjectInfo($cause->getCauName())
                            ->setNotifSubject('Parrainage pour un animal mort ou relâché !')
                            ->setNotifText('Parrainage pour un animal mort ou relâché !')
                            ->setNotifCode('DONATION_ON_DISABLED_CAUSE')
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ;
                        $notification->create();
                    }
                    $addN = true;
                    $mail = trim($client->getCliEmail());
                    if ($mail !== '') { //\FreeFW\Tools\Email::verify($mail)) {
                        // Send mail to client...
                        if ($emailC == 'END_DONATION_1M') {
                            $filters = [
                                'email_id' => $cauType->getCautDonMonthEmailId()
                            ];
                        } else {
                            $filters = [
                                'email_id' => $cauType->getCautDonEndEmailId()
                            ];
                        }
                        //var_dump($donation->getMergeData());die;
                        $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), $donation);
                        if ($message) {
                            $message
                                ->addDest($client->getCliEmail())
                                ->setDestId($client->getCliId())
                                ->setGrpId($donation->getGrpId())
                            ;
                            $message->create();
                        }
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
            $result = $this->reviveAdoption(clone $lastOk, '1M');
        }
        $this->logger->debug('Start from ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . ' excluded');
        $p_params['last'] = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->logger->debug('Donation.reviveAdoptions.END');
        return $p_params;
    }
}
