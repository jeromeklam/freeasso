<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Client extends \FreeFW\Core\Service
{

    /**
     * For each client, get last donation
     *
     * @return void
     */
    public function updateAll()
    {
        /**
         * @var \FreeAsso\Model\Client $model
         */
        $model = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
        $query = $model->getQuery();
        $query->execute([], 'updateLastDonation');
    }

    /**
     * Update last donation
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return boolean
     */
    public function updateLastDonation(\FreeAsso\Model\Client &$p_client)
    {
        $query = \FreeAsso\Model\Donation::getQuery();
        $filters = [
            'cli_id' => $p_client->getCliId(),
            'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
            'don_ts' => [
                \FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()
            ]
        ];
        $query
            ->addFromFilters($filters)
            ->setSort('-don_ts')
            ->setLimit(0, 1);
        if ($query->execute()) {
            $results = $query->getResult();
            if ($results) {
                foreach ($results as $row) {
                    if ($p_client->getLastDonId() != $row->getDonId()) {
                        $p_client->setLastDonId($row->getDonId());
                        return true;
                    }
                    break;
                }
            }
        }
        return false;
    }

    /**
     * Send email to new member
     *
     * @param \FreeAsso\Model\Client $p_client
     * @param string                 $p_event_name
     * @param \FreeFW\Model\Automate $p_automate
     *
     * @return boolean
     */
    public function notification($p_client, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
        if ($p_client->getCliEmail() != '') {
            /**
             * @var \FreeFW\Service\Email
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
                    'email_code' => 'CLIENT'
                ];
            }
            if ($p_automate->getGrpId()) {
                $filters = [
                    'grp_id' => $p_automate->getGrpId()
                ];
            }
            /**
             *
             * @var \FreeFW\Model\Message $message
             */
            $message = $emailService->getEmailAsMessage($filters, $p_client->getLangId(), $p_client);
            if ($message) {
                $message
                    ->addDest($p_client->getCliEmail())
                    ->setDestId($p_client->getCliId());
                return $message->create();
            }
        } else {
            // Add notofication for manual send...
            /*
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifObjectName('FreeAsso_Client')
                ->setNotifObjectId($p_client->getCliId())
                ->setNotifSubject($p_automate->getAutoName() . ' : ' . $p_client->getFullname())
                ->setNotifCode('CLIENT_WITHOUT_EMAIL')
                ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ;
            return $notification->create();*/
        }
        return true;
    }

    /**
     * Generate Receipt for one year
     *
     * @param \FreeAsso\Model\Client $p_client
     * @param int                    $p_year
     * @param array                  $p_types
     * @param array                  $p_stats
     * @param int                    $p_grp_id
     * @param int                    $p_edi_id
     * @param int                    $p_recg_id
     * 
     * @return void
     */
    public function generateReceiptByYear($p_client, $p_year, &$p_types, &$p_stats, $p_grp_id, $p_edi_id, $p_recg_id)
    {
        $this->logger->info('Receipt for ' . $p_client->getFullname() . ' START');
        $query2 = \FreeAsso\Model\Donation::getQuery();
        $query2
            ->addFromFilters(
                [
                    'session.sess_year' => $p_year,
                    'cli_id' => $p_client->getCliId(),
                    'grp_id' => $p_grp_id,
                    'don_mnt_input' => [\FreeFW\Storage\Storage::COND_GREATER => 0],
                    'don_status' => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => \FreeAsso\Model\Donation::STATUS_NOK],
                    'payment_type.ptyp_receipt' => [\FreeFW\Storage\Storage::COND_EQUAL => 1],
                ]
            )
            ->addRelations(['sponsorship', 'cause', 'cause.cause_type', 'session', 'payment_type'])
            ->setSort('don_real_ts');
        if ($query2->execute()) {
            /**
             * @var \FreeFW\Model\Lang $lang
             */
            $lang     = $p_client->getLang();
            $results2 = $query2->getResult();
            if ($results2->count() > 0) {
                $receipts = [];
                /**
                 * @var \FreeAsso\Model\Donation $oneDonation
                 */
                foreach ($results2 as $oneDonation) {
                    $rettId = $oneDonation->detectReceiptType($p_types);
                    if ($rettId > 0) {
                        if (!isset($receipts[$rettId])) {
                            $number = '';
                            foreach ($p_types as $idx => $oneType) {
                                if ($rettId == $oneType->getRettId()) {
                                    $newnum = \FreeAsso\Model\Year::getNextNumber($p_year, $p_grp_id);
                                    $number = $oneType->getNewNumber(['year' => $p_year, 'number' => $newnum]);
                                    break;
                                }
                            }
                            $receipt = new \FreeAsso\Model\Receipt();
                            $receipt
                                ->setCliId($p_client->getCliId())
                                ->setRettId($rettId)
                                ->setRecMode(\FreeAsso\Model\Receipt::MODE_AUTO)
                                ->setRecTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->setRecGenTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->setRecYear($p_year)
                                ->setRecFullname($p_client->getCliFullname())
                                ->setRecAddress1($p_client->getCliAddress1())
                                ->setRecAddress2($p_client->getCliAddress2())
                                ->setRecCp($p_client->getCliCp())
                                ->setRecTown($p_client->getCliTown())
                                ->setCntyId($p_client->getCntyId())
                                ->setLangId($p_client->getLangId())
                                ->setRecEmail(null)
                                ->setRecSendMethod(\FreeAsso\Model\Receipt::SEND_METHOD_MANUAL)
                                ->setRecMnt(0)
                                ->setRecMoney($oneDonation->getDonMoneyInput())
                                ->setRecNumber($number)
                                ->setRecgId($p_recg_id)
                                ->setRecStreetName($p_client->getCliStreetName())
                                ->setRecStreetNum($p_client->getCliStreetNum())
                                ->setRecSiren($p_client->getCliSiren())
                                ->setRecSocialReason($p_client->getCliSocialReason());
                            if ($p_client->getCliEmail() != '') {
                                $receipt
                                    ->setRecEmail($p_client->getCliEmail())
                                    ->setRecSendMethod(\FreeAsso\Model\Receipt::SEND_METHOD_EMAIL);
                            }
                            $receipts[$rettId] = $receipt;
                        }
                        $receipts[$rettId]
                            ->addMnt($oneDonation->getDonMntInput(), $oneDonation->getDonMoneyInput())
                            ->addDonation($oneDonation);
                        $ptyp = $oneDonation->getPaymentType();
                        switch ($ptyp->getPtypType()) {
                            case \FreeAsso\Model\PaymentType::TYPE_BANK:
                                $receipts[$rettId]->setRecBank(true);
                                break;
                            case \FreeAsso\Model\PaymentType::TYPE_CASH:
                                $receipts[$rettId]->setRecCash(true);
                                break;
                            case \FreeAsso\Model\PaymentType::TYPE_CHECK:
                                $receipts[$rettId]->setRecCheck(true);
                                break;
                            case \FreeAsso\Model\PaymentType::TYPE_NATURE:
                                $receipts[$rettId]->setRecNature(true);
                                break;
                            default:
                                $receipts[$rettId]->setRecOther(true);
                                break;
                        }
                    } else {
                        // @todo: error
                        var_dump($p_types, $oneDonation->getDonId());
                        throw new \Exception('Erreur de recherche de type de reçu');
                    }
                    // Statistics
                    $realTs = \FreeFW\Tools\Date::mysqlToDatetime($oneDonation->getDonRealTs());
                    $year   = $realTs->format('Y');
                    $month  = $realTs->format('m');
                    // Paiement Type
                    $key = $year . '_' . $month . '_ptyp@' . $oneDonation->getPtypId();
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb']++;
                    $p_stats[$key]['mnt'] += $oneDonation->getDonMntInput();
                    // Cause Type
                    $cause = $oneDonation->getCause();
                    if ($cause) {
                        $spoId = $oneDonation->getSpoId();
                        if ($spoId > 0) {
                            $key = $year . '_' . $month . '_cautreg@' . $cause->getCautId();
                            if (!isset($p_stats[$key])) {
                                $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                            }
                            $p_stats[$key]['nb']++;
                            $p_stats[$key]['mnt'] += $oneDonation->getDonMntInput();
                        } else {
                            $key = $year . '_' . $month . '_cautponc@' . $cause->getCautId();
                            if (!isset($p_stats[$key])) {
                                $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                            }
                            $p_stats[$key]['nb']++;
                            $p_stats[$key]['mnt'] += $oneDonation->getDonMntInput();
                        }
                    }
                    // Total
                    $key = $year . '_' . $month . '_total';
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb']++;
                    $p_stats[$key]['mnt'] += $oneDonation->getDonMntInput();
                }
                // End and save...
                $nbR = 0;
                $nbP = 0;
                /**
                 * @var \FreeAsso\Model\Receipt $oneReceipt
                 */
                foreach ($receipts as $oneReceipt) {
                    $nbR    += 1;
                    $bErr    = false;
                    $isoCode = $lang->getLangIsoNumberWords();
                    if ($isoCode == '') {
                        $isoCode = 'EN_GB';
                    }
                    $oneReceipt->setRecMntLetter(
                        \FreeFW\Tools\Number::toWords(
                            $oneReceipt->getRecMnt(),
                            $isoCode,
                            $oneReceipt->getRecMoney(),
                            '.'
                        )
                    );
                    if ($oneReceipt->getRecMnt() > 0) {
                        $oneReceipt->startTransaction();
                        if (!$oneReceipt->create(false)) {
                            $bErr = true;
                            // @todo: error
                            throw new \Exception('Erreur d\'enregistrement du reçu');
                        } else {
                            /**
                             * @var \FreeAsso\Model\Donation $oneDonation
                             */
                            foreach ($oneReceipt->getDonations() as $oneDonation) {
                                $receiptDonation = new \FreeAsso\Model\ReceiptDonation();
                                $receiptDonation
                                    ->setDonId($oneDonation->getDonId())
                                    ->setRecId($oneReceipt->getRecId())
                                    ->setRdoMoney($oneDonation->getDonMoneyInput())
                                    ->setRdoMnt($oneDonation->getDonMntInput())
                                    ->setRdoTs($oneDonation->getDonRealTs())
                                    ->setPtypId($oneDonation->getPtypId());
                                if (!$receiptDonation->create(false)) {
                                    $bErr = true;
                                    break;
                                }
                                $oneDonation->setRecId($oneReceipt->getRecId());
                                $oneDonation->setCheckSession(false); // Hook
                                if (!$oneDonation->save(false, true)) {
                                    $bErr = true;
                                    break;
                                }
                            }
                        }
                        if ($bErr) {
                            throw new \Exception('Erreur d\'enregistrement des lignes du reçu');
                            $oneReceipt->rollbackTransaction();
                        } else {
                            $this->logger->debug('    * ' . $oneReceipt->getRecNumber() . ' : ' . $oneReceipt->getRecMntLetter());
                            $oneReceipt->commitTransaction();
                        }
                        /**
                         * Génération du PDF et enregistrement
                         * @var \FreeAsso\Model\Receipt $printReceipt
                         */
                        $printReceipt = \FreeAsso\Model\Receipt::findFirst(['rec_id' => $oneReceipt->getRecId()]);
                        if ($printReceipt) {
                            $nbP += $printReceipt->generatePDF($p_edi_id);
                        }
                    }
                }
                if ($p_client->getCliEmail() != '') {
                    $key = $year . '_' . $month . '_receipt_with_email_total';
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb'] += $nbR;
                    $key = $year . '_' . $month . '_pages_with_email_total';
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb'] += $nbP;
                } else {
                    $key = $year . '_' . $month . '_receipt_with_email_total';
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb'] += $nbR;
                    $key = $year . '_' . $month . '_pages_without_email_total';
                    if (!isset($p_stats[$key])) {
                        $p_stats[$key] = ['nb' => 0, 'mnt' => 0];
                    }
                    $p_stats[$key]['nb'] += $nbP;
                }
            }
        } else {
            // @todo : error
            throw new \Exception('Erreur de requête');
        }
        $this->logger->info('Receipt for ' . $p_client->getFullname() . ' END');
        return true;
    }

    /**
     * Send receipt
     *
     * @param \FreeAsso\Model\Client $p_client
     * @param integer                $p_recg_id
     * @param integer                $p_email_id
     * @param integer                $p_grp_id
     * 
     * @return boolean
     */
    public function sendReceipt($p_client, $p_recg_id, $p_email_id, $p_grp_id)
    {
        /**
         * @var \FreeFW\Service\Email $emailService
         */
        $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
        $cfg  = $this->getAppConfig();
        $dir  = $cfg->get('ged:dir');
        $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
        if ($p_client->getCliEmail() != '' && $p_client->getCliReceipt() == 1) {
            $receipts = \FreeAsso\Model\Receipt::find(
                [
                    'recg_id' => $p_recg_id,
                    'cli_id'  => $p_client->getCliId()
                ]
            );
            $filters = [
                'email_id' => $p_email_id
            ];
            $message = $emailService->getEmailAsMessage($filters, $p_client->getlangId(), $p_client, true, $p_grp_id);
            if ($message) {
                $message
                    ->addDest($p_client->getCliEmail())
                    ->setDestId($p_client->getCliId());
                /**
                 * @var \FreeAsso\Model\Receipt $oneReceipt
                 */
                foreach ($receipts as $oneReceipt) {
                    $file = $oneReceipt->getFile();
                    if ($file) {
                        $dest = $bDir . '/' . 'receipt_' . uniqid(true) . '.pdf';
                        @file_put_contents($dest, $file->getFileBlob());
                        $message->addAttachment($dest, $oneReceipt->getRecNumber() . '.pdf');
                    }
                }
                if ($message->create()) {
                    /**
                     * @var \FreeAsso\Model\Receipt $oneReceipt
                     */
                    foreach ($receipts as $oneReceipt) {
                        $oneReceipt
                            ->setRecPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                            ->save(false, true);
                    }
                    return true;
                }
                return false;
            }
        }
        return true;
    }

    /**
     * Print receipt
     *
     * @param \FreeAsso\Model\Client $p_client
     * @param integer                $p_recg_id
     * @param integer                $p_email_id
     * @param integer                $p_grp_id
     * 
     * @return boolean
     */
    public function printReceipt($p_client, $p_recg_id, $p_email_id, $p_grp_id)
    {
        $sso  = \FreeFW\DI\DI::getShared('sso');
        $user = $sso->getUser();
        /**
         * @var \FreeFW\Service\Email $emailService
         */
        $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
        $cfg  = $this->getAppConfig();
        $dir  = $cfg->get('ged:dir');
        $bDir = rtrim(\FreeFW\Tools\Dir::mkStdFolder($dir), '/');
        $tmpPrefix  = '/tmp/export_' . uniqid() . '_';
        $outputFile = '/tmp/export_' . uniqid() . '.pdf';
        $merger     = new \FreeOffice\Tools\PdfMerger();
        $files      = [];
        if ($p_client->getCliEmail() == '' && $p_client->getCliReceipt() == 1) {
            $receipts = \FreeAsso\Model\Receipt::find(
                [
                    'recg_id' => $p_recg_id,
                    'cli_id'  => $p_client->getCliId()
                ]
            );
            /**
             * @var \FreeAsso\Model\Receipt $oneReceipt
             */
            foreach ($receipts as $oneReceipt) {
                $file = $oneReceipt->getFile();
                if ($file) {
                    $filename = $tmpPrefix . $file->getFileId() . '.pdf';
                    $files[]  = $filename;
                    file_put_contents($filename, $file->getFileBlob());
                    $merger->addFile($filename);
                    $oneReceipt
                        ->setRecPrintTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ->save(false, true);
                }
            }
        }
        $merger->merge('file', $outputFile);
        foreach ($files as $oneFile) {
            @unlink($oneFile);
        }
        // Add notification and inbox
        $object = 'FreeAsso_Receipt';
        $parts  = explode('_', $object);
        $date   = \str_replace('-', '', \FreeFW\Tools\Date::getCurrentDate());
        $name   = array_pop($parts) . '_' . $date;
        $inbox  = new \FreeFW\Model\Inbox();
        $inbox
            ->setInboxFilename($name . '.pdf')
            ->setInboxObjectName($object)
            ->setInboxContent(file_get_contents($outputFile))
            ->setUserId($user->getUserId());
        if (!$inbox->create()) {
            $result = false;
        }
        @unlink($outputFile);
        $notification = new \FreeFW\Model\Notification();
        $notification
            ->setNotifCode('EXPORT')
            ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
            ->setNotifSubject('Export terminé')
            ->setNotifObjectName($object)
            ->setUserId($user->getUserId());
        if (!$notification->create()) {
            $result = false;
        }
        return true;
    }
}
