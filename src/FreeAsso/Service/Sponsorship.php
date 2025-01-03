<?php
namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Sponsorship extends \FreeFW\Core\Service
{

    /**
     * Generate one certificate
     *
     * @param \FreeAsso\Model\Sponsorship $p_sponsorship
     * @param string                      $p_start
     * @param string                      $p_end
     * 
     * @return boolean
     */
    public function generateOneCertificate($p_sponsorship, $p_start, $p_end, $p_with_transaction = true)
    {
        $to  = $p_sponsorship->getSpoTo();
        $mnt = 0;
        // Ok, create certificate
        $client = $p_sponsorship->getClient();
        $cause = $p_sponsorship->getCause();
        $causeType = $cause->getCauseType();
        if (!$causeType->getCautCertificat()) {
            return false;
        }
        $donations = \FreeAsso\Model\Donation::find(
            [
                'don_real_ts' => [\FreeFW\Storage\Storage::COND_BETWEEN => [ $p_start, $p_end ]],
                'spo_id'      => $p_sponsorship->getSpoId(),
                'don_status'  => \FreeAsso\Model\Donation::STATUS_OK
            ]
        );
        /**
         * @var \FreeAsso\Model\Donation $oneDonation
         */
        foreach ($donations as $oneDonation) {
            $mnt = $mnt + $oneDonation->getDonMntInput();
        }
        if ($mnt <= 0) {
            // Add notification for manual send...
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeAsso_Sponsorship')
                ->setNotifObjectId($p_sponsorship->getSpoId())
                ->setNotifSubject('Certificat à 0 : ' . $client->getFullname() . ' ' . $cause->getCauName())
                ->setNotifCode('SPONSORSHIP_EMPTY_AMOUNT')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ;
            return $notification->create();
        }
        if ($p_with_transaction) {
            $p_sponsorship->startTransaction();
        }
        /**
         * @var \FreeAsso\Model\Certificate $certificate
         */
        $certificate = new \FreeAsso\Model\Certificate();
        $certificate
            ->setClient($client)
            ->setCertFullname($client->getCliFullname())
            ->setCertEmail($client->getCliEmail())
            ->setCertManual(false)
            ->setCertTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ->setCertGents(null)
            ->setCertPrintTs(null)
            ->setCertInputMnt($mnt)
            ->setCertInputMoney($p_sponsorship->getSpoMoneyInput())
            ->setCertOutputMoney($cause->getCauUnitMoney())
            ->setCertUnitBase($cause->getCauUnitBase())
            ->setCertUnitUnit($cause->getCauUnitUnit())
            ->setCertUnitMnt($cause->getCauUnitMnt())
            ->setCertAddress1($client->getCliAddress1())
            ->setCertAddress2($client->getCliAddress2())
            ->setCertAddress3($client->getCliAddress3())
            ->setCertCp($client->getCliCp())
            ->setCertTown($client->getCliTown())
            ->setCntyId($client->getCntyId())
            ->setLangId($client->getLangId())
            ->setCauId($cause->getCauId())
            ->setCertDisplayMnt(true)
        ;
        $certificate->calculateFields();
        if ($certificate->create(false)) {
            /**
             * Update donations
             * @var \FreeAsso\Model\Donation $oneDonation
             */
            foreach ($donations as $oneDonation) {
                $oneDonation->setCertId($certificate->getCertId());
                if (!$oneDonation->save(false)) {
                    if ($p_with_transaction) {
                        $p_sponsorship->rollbackTransaction();
                    }
                    return false;
                }
            }
            if ($p_with_transaction) {
                $p_sponsorship->commitTransaction();
            }
            if (!$certificate->generate()) {
                $certificate->addErrors($certificate->getErrors());
            }
        } else {
            if ($p_with_transaction) {
                $p_sponsorship->rollbackTransaction();
            }
            return false;
        }
        return $certificate;
    }

    /**
     * Generate certificate by Year
     *
     * @param array $p_params
     * 
     * @return void
     */
    public function generateCertificate($p_params = [])
    {
        $this->logger->debug('Sponsorship.generateCertificate.start');
        if (!isset($p_params['year'])) {
            throw new \Exception('Year param not defined !');
        }
        $year   = $p_params['year'];
        $nYear  = $year + 1;
        $dStart = $year . '-01-01 00:00:00';
        $dEnd   = $nYear . '-01-01 00:00:00';
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query  = \FreeAsso\Model\Sponsorship::getQuery();
        $query
            ->addFromFilters(
                [
                    'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => $dEnd],
                    'spo_to' => \FreeFW\Storage\Storage::COND_EMPTY,
                    'cause.cause_type.caut_certificat' => 1
                ]
            )
            ->addRelations(['client', 'cause'])
            ->setSort('client.cli_firstname,client.cli_lastname')
        ;
        $this->logger->debug('Sponsorship.generateCertificate.before.query');
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            $this->logger->debug('Sponsorship.generateCertificate.query.count ' . $results->count());
            if ($results->count() > 0) {
                /**
                 * @var \FreeAsso\Model\Sponsorship $sponsorship
                 */
                foreach ($results as $sponsorship) {
                    $certificate = $this->generateOneCertificate($sponsorship, $dStart, $dEnd);
                    if ($certificate) {
                        // Notification...
                        $sponsorship->setCertificateYear($year);
                        $this->notification($sponsorship, "year", false, $certificate);
                    }
                }
            }
        }
        $this->logger->debug('Sponsorship.generateCertificate.end');
        $p_params['year'] = $nYear;
        return $p_params;
    }

    /**
     * Send notification
     *
     * @param \FreeAsso\Model\Donation    $p_sponsorship
     * @param string                      $p_action
     * @param boolean                     $p_send_identity
     * @param \FreeAsso\Model\Certificate $p_certificate
     *
     * @return boolean
     */
    public function notification($p_sponsorship, $p_action = "create", $p_send_identity = false, $p_certificate = null)
    {
        /**
         * @var \FreeAsso\Model\Cause $cause
         */
        $cause = $p_sponsorship->getCause();
        if ($cause) {
            /**
             * @var \FreeAsso\Model\CauseType $cause_type
             * @var \FreeAsso\Model\Client    $client
             */
            $cause_type = $cause->getCauseType();
            $client = $p_sponsorship->getClient();
            if ($client->getCliEmail() != '') {
                /**
                 * @var \FreeFW\Service\Email $emailService
                 */
                $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
                $emailId = false;
                $ediId = false;
                switch ($p_action) {
                    case 'create':
                        $emailId = $cause_type->getCautSpoAddEmailId();
                        $ediId = $cause_type->getCautIdentEdiId();
                        break;
                    case 'update':
                        $emailId = $cause_type->getCautSpoUpdateEmailId();
                        $ediId = $cause_type->getCautIdentEdiId();
                        break;
                    case 'remove':
                        $emailId = $cause_type->getCautSpoEndEmailId();
                        $ediId = $cause_type->getCautIdentEdiId();
                        break;
                    case 'year':
                        $emailId = $cause_type->getCautCertYearEmailId();
                        $ediId = null;
                        break;
                }
                if ($emailId) {
                    $filters = [
                        'email_id' => $emailId
                    ];
                    /**
                     *
                     * @var \FreeFW\Model\Message $message
                     */
                    $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), $p_sponsorship);
                    if ($message) {
                        $message
                            ->addDest($client->getCliEmail())
                            ->setDestId($client->getCliId())
                            ->setGrpId($p_sponsorship->getGrpId())
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
                        if ($p_certificate && $p_certificate instanceof \FreeAsso\Model\Certificate) {
                            $file = $p_certificate->getFile();
                            if ($file) {
                                $cfg  = $this->getAppConfig();
                                $dir  = $cfg->get('ged:dir');
                                $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
                                $filename = $bDir . '/certificat_' . uniqid(true) . '.pdf';
                                file_put_contents($filename, $file->getFileBlob());
                                $message->addAttachment($filename, 'certificat.pdf');
                                $p_certificate->setCertPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                                $p_certificate->save();
                            }
                        }
                        return $message->create();
                    }
                }
            } else {
                // Add notification for manual send...
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifObjectName('FreeAsso_Sponsorship')
                    ->setNotifObjectId($p_sponsorship->getSpoId())
                    ->setNotifSubject('Paiement régulier : ' . $client->getFullname() . ' ' . $cause->getCauName())
                    ->setNotifCode('SPONSORSHIP_WITHOUT_EMAIL')
                    ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ;
                $notification->create();
                if ($p_certificate && $p_certificate instanceof \FreeAsso\Model\Certificate) {
                    $cause = $p_sponsorship->getCause();
                    $notification = new \FreeFW\Model\Notification();
                    $texte = 'Paiement : ' . $p_certificate->getCertFullname() . ' ' . $cause->getCauName();
                    $notification
                        ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                        ->setNotifObjectName('FreeAsso_Certificate')
                        ->setNotifObjectId($p_certificate->getCertId())
                        ->setNotifSubject($texte)
                        ->setNotifObjectInfo($p_certificate->getCertFullname())
                        ->setNotifCode('CERTIFICATE_WITHOUT_EMAIL')
                        ->setNotifText($texte)
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ;
                    $notification->create();
                }
            }
        }
        return true;
    }

    /**
     * generate debit for one day
     *
     * @param \Datetime $p_date
     *
     * @return boolean
     */
    public function generateOneDebit(\Datetime $p_date)
    {
        $year   = intval($p_date->format('Y'));
        $month  = intval($p_date->format('m'));
        $day    = intval(1);
        $errors = false;
        /**
         * @var \FreeAsso\Model\Sponsorship $sponsorship
         */
        $sponsorship = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $dEnd  = \FreeFW\Tools\Date::addMonths($p_date, 1);
        $query = $sponsorship->getQuery();
        $query
            ->addFromFilters(
                [
                    'spo_to' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::datetimeToMysql($dEnd)],
                    'spo_freq' => \FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH
                ]
            )
            ->addRelations(['client', 'cause'])
            ->setSort('client.cli_firstname,client.cli_lastname')
        ;
        $this->logger->debug('Sponsorship.generateOneDebit.before.query');
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                /**
                 * First create Donation Origin
                 * @var \FreeAsso\Model\DonationOrigin $donOrig
                 */
                $donOrig = \FreeFW\DI\DI::get('FreeAsso::Model::DonationOrigin');
                $donOrig
                    ->setDonoDay($day)
                    ->setDonoMonth($month)
                    ->setDonoYear($year)
                    ->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_PENDING)
                    ->setDonoTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                $report = '<ul>';
                if (!$donOrig->create()) {
                    return false;
                }
                foreach ($results as $sponsorship) {
                    // On ne génère pas pour le futur
                    $testStart = \FreeFW\Tools\Date::mysqlToDatetime($sponsorship->getSpoFrom());
                    if ($testStart >= $dEnd) {
                        continue;
                    }
                    /**
                     * Get first active session, else quit...
                     * @var \FreeAsso\Model\Session $session
                     */
                    $session = \FreeAsso\Model\Session::findFirst(
                        [
                            'sess_status' => \FreeAsso\Model\Session::STATUS_OPEN,
                            'sess_year'   => $year,
                            'sess_month'  => $month,
                            'grp_id'      => $sponsorship->getGrpId()
                        ]
                    );
                    if (!$session) {
                        $session = \FreeAsso\Model\Session::findFirst(
                            [
                                'sess_status' => \FreeAsso\Model\Session::STATUS_OPEN,
                                'sess_year'   => $year,
                                'grp_id'      => $sponsorship->getGrpId()
                            ]
                        );
                    }
                    if (!$session) {
                        $donOrig
                            ->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_ERROR)
                            ->save();
                        /**
                         * Add notification
                         * @var \FreeFW\Model\Notification $notification
                         */
                        $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                        $notification
                            ->setNotifType(\FreeFW\Model\Notification::TYPE_ERROR)
                            ->setNotifObjectName('FreeAsso_DonationOrigin')
                            ->setNotifObjectId($donOrig->getDonoId())
                            ->setNotifSubject('Error generating donations !')
                            ->setNotifCode('DONATION_GENERATION_NO_SESSION')
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $notification->create();
                        continue;
                    }
                    /**
                     * New donation
                     * @var \FreeAsso\Model\Donation $donation
                     */
                    $donation = $sponsorship->getNewDonation($p_date);
                    $donation
                        ->setDonoId($donOrig->getDonoId())
                        ->setSessId($session->getSessId())
                        ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
                    ;
                    // No automates here...
                    $donation->turnAutomateOff();
                    $report .= '<li>';
                    $client = $sponsorship->getClient();
                    $report .= $client->getFullname();
                    if (!$client->isActive($p_date)) {
                        /**
                         * Add notification
                         * @var \FreeFW\Model\Notification $notification
                         */
                        $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                        $notification
                            ->setNotifType(\FreeFW\Model\Notification::TYPE_WARNING)
                            ->setNotifObjectName('FreeAsso_Client')
                            ->setNotifObjectId($client->getCliId())
                            ->setNotifSubject('Active sponsorship on a disabled member !')
                            ->setNotifCode('DONATION_ON_DISABLED_MEMBER')
                            ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                        $notification->create();
                    }
                    $report .= ' ' . $donation->getDonMnt() . ' ' . $donation->getDonMoney();
                    $cause = $sponsorship->getCause();
                    if ($cause) {
                        $report .= ' (' . $cause->getCauName() . ')';
                        if (!$cause->isActive($p_date)) {
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
                    }
                    if (!$donation->create()) {
                        // @todo
                        $report .= ' **ERROR** ';
                        $errors .= print_r($donation->getErrors(), true) . PHP_EOL;
                        $this->logger->error(print_r($donation->getErrors(), true));
                    }
                    $report .= '</li>';
                }
                $report .= '</ul>';
                if ($errors) {
                    $donOrig->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_ERROR);
                } else {
                    $donOrig->setDonoStatus(\FreeAsso\Model\DonationOrigin::STATUS_OK);
                }
                $donOrig
                    ->setDonoComments($report)
                    ->save()
                ;
                if ($errors) {
                    /**
                     * Add notification
                     * @var \FreeFW\Model\Notification $notification
                     */
                    $notification = \FreeFW\DI\DI::get('FreeFW::Model::Notification');
                    $notification
                        ->setNotifType(\FreeFW\Model\Notification::TYPE_ERROR)
                        ->setNotifObjectName('FreeAsso_DonationOrigin')
                        ->setNotifObjectId($donOrig->getDonoId())
                        ->setNotifSubject('Error generating donations !')
                        ->setNotifCode('DONATION_GENERATION_ERROR')
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ->setNotifText($errors);
                    $notification->create();
                    $this->logger->error(print_r($notification->getErrors(), true));
                }
            }
        }
        return true;
    }

    /**
     * For each client, get last donation
     *
     * @param array params
     *
     * @return array
     */
    public function generateDebit($p_params = [])
    {
        $this->logger->debug('Sponsorship.generateDebit.START');
        /**
         * @var \DateTime  $lastOk
         */
        $lastOk = \FreeFW\Tools\Date::getServerDatetime();
        /**
         * @var \DateTime  $now
         */
        $now    = \FreeFW\Tools\Date::getServerDatetime();
        if (array_key_exists('last', $p_params)) {
            $lastOk = \FreeFW\Tools\Date::mysqlToDatetime($p_params['last']);
        }
        $year   = intval($lastOk->format('Y'));
        $month  = intval($lastOk->format('m'));
        $nYear  = intval($now->format('Y'));
        $nMonth = intval($now->format('m'));
        // Force same time...
        while (($month < $nMonth && $year === $nYear) || $year < $nYear) {
            $lastOk->add(new \DateInterval('P1M'));
            $this->logger->debug('Generating ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . '...');
            $this->generateOneDebit(clone $lastOk);
            $year  = intval($lastOk->format('Y'));
            $month = intval($lastOk->format('m'));
        }
        $this->logger->debug('Start from ' . \FreeFW\Tools\Date::datetimeToMysql($lastOk) . ' excluded');
        $p_params['last'] = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->logger->debug('Sponsorship.generateDebit.END');
        return $p_params;
    }
}
