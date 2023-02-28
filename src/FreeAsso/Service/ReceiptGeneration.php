<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class ReceiptGeneration extends \FreeFW\Core\Service
{

    /**
     * Send emails
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function send($p_params = [])
    {
        $this->logger->debug('ReceiptGeneration.send.START');
        // Vérifications
        if (!isset($p_params['recg_id'])) {
            throw new \Exception('L\’identifiant de génération est obligatoire');
        }
        $recgId = $p_params['recg_id'];
        $generation = \FreeAsso\Model\ReceiptGeneration::findFirst(['recg_id' => $recgId]);
        if (!$generation instanceof \FreeAsso\Model\ReceiptGeneration) {
            throw new \Exception('Impossible de trouver la génération');
        }
        $emailId = $generation->getEmailId();
        $grpId   = $generation->getGrpId();
        $filters = ['receipts.recg_id' => $recgId];
        if ($generation->getClicId() > 0) {
            $filters = ['clic_id' => $generation->getClicId()];
        }
        //
        $query = \FreeAsso\Model\Client::getQuery();
        $query
            ->addFromFilters($filters)
        ;
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                $this->logger->debug('ReceiptGeneration.send.count ' . $results->count());
                /**
                 * @var \FreeAsso\Service\Client $clientService
                 */
                $clientService = \FreeFW\DI\DI::get('FreeAsso::Service::Client');
                $clientService->setLogger($this->logger);
                /**
                 * @var \FreeAsso\Model\Client $oneClient
                 */
                foreach ($results as $oneClient) {
                    $clientService->sendReceipt($oneClient, $recgId, $emailId, $grpId);
                }
                $generation->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_DONE);
                if (!$generation->save(false, true)) {
                    throw new \Exception('Erreur de mise à jour de la génération');
                }
            }
        }
        $this->logger->debug('ReceiptGeneration.send.END');
        return $p_params;
    }

    /**
     * Suppression d'une génération
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function undo($p_params = [])
    {
        $this->logger->debug('ReceiptGeneration.undo.START');
        // Vérifications
        if (!isset($p_params['recg_id'])) {
            throw new \Exception('L\’identifiant de génération est obligatoire');
        }
        $recgId = $p_params['recg_id'];
        $generation = \FreeAsso\Model\ReceiptGeneration::findFirst(['recg_id' => $recgId]);
        if (!$generation instanceof \FreeAsso\Model\ReceiptGeneration) {
            throw new \Exception('Impossible de trouver la génération');
        }
        $year  = $generation->getRecgYear();
        $grpId = $generation->getGrpId();
        $types = \FreeAsso\Model\ReceiptType::find([
            'grp_id' => $grpId
        ]);
        if ($generation->getRecgStatus() == \FreeAsso\Model\ReceiptGeneration::STATUS_WAITING) {
            // Sauvegarde des numéros et bascule en PENDING
            $svgTypes = [];
            foreach ($types as $oneType) {
                $svgTypes[] = $oneType->__toArray();
            }
            $generation
                ->setRecgSave(json_encode($svgTypes))
                ->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_PENDING);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
        } else {
            throw new \Exception('La génération n\'est pas en attente');
        }
        try {
            $saved = json_decode($generation->getRecgSave(), true);
            foreach ($saved as $oneSave) {
                $id = $oneSave['rett_id'];
                $nb = $oneSave['rett_last_number'];
                /**
                 * @var \FreeAsso\Model\ReceiptType $type
                 */
                $type = \FreeAsso\Model\ReceiptType::findFirst(['rett_id' => $id]);
                if ($type) {
                    $type->setRettLastNumber($nb);
                    if (!$type->save(false, true)) {
                        throw new \Exception('Type introuvable !');
                    }
                }
            }
            $filters = [
                'rec_year' => $year,
                'rec_manual' => 0,
                'grp_id' => $grpId
            ];
            if ($generation->getClicId() > 0) {
                $filters = ['client.clic_id' => $generation->getClicId()];
            }
            if ($generation->getPtypId() > 0) {
                $filters = ['donations.ptyp_id' => $generation->getPtypId()];
            }
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query  = \FreeAsso\Model\Receipt::getQuery();
            $query->addFromFilters($filters);
            if ($query->execute()) {
                /**
                 * @var \FreeFW\Model\ResultSet $results
                 */
                $results = $query->getResult();
                if ($results->count() > 0) {
                    foreach ($results as $oneReceipt) {
                        if (!$oneReceipt->remove(false)) {
                            throw new \Exception('Receipt remove error');
                        }
                    }
                }
            }
            // End
            $generation
                ->setRecgSave(null)
                ->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_NONE);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
        } catch (\Exception $ex) {
            $generation->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_ERROR);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
            throw $ex;
        }
        $this->logger->debug('ReceiptGeneration.undo.END');
        return $p_params;
    }

    /**
     * Génération des reçus d'une année
     *
     * @param array $p_params
     * 
     * @return array
     */
    public function generate($p_params = [])
    {
        $this->logger->debug('ReceiptGeneration.generate.START');
        // Vérifications
        if (!isset($p_params['recg_id'])) {
            throw new \Exception('L\’identifiant de génération est obligatoire');
        }
        $recgId = $p_params['recg_id'];
        $generation = \FreeAsso\Model\ReceiptGeneration::findFirst(['recg_id' => $recgId]);
        if (!$generation instanceof \FreeAsso\Model\ReceiptGeneration) {
            throw new \Exception('Impossible de trouver la génération');
        }
        $year  = $generation->getRecgYear();
        $grpId = $generation->getGrpId();
        $types = \FreeAsso\Model\ReceiptType::find([
            'grp_id' => $grpId
        ]);
        if ($generation->getRecgStatus() == \FreeAsso\Model\ReceiptGeneration::STATUS_WAITING) {
            // Sauvegarde des numéros et bascule en PENDING
            $svgTypes = [];
            foreach ($types as $oneType) {
                $svgTypes[] = $oneType->__toArray();
            }
            $generation
                ->setRecgSave(json_encode($svgTypes))
                ->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_PENDING);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
        } else {
            throw new \Exception('La génération n\'est pas en attente');
        }
        try {
            $group = \FreeSSO\Model\Group::findFirst(['grp_id' => $grpId]);
            $filters = [
                'donations.session.sess_year' => $year,
                'donations.don_mnt_input' => [\FreeFW\Storage\Storage::COND_GREATER => 0],
                'donations.don_status' => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => \FreeAsso\Model\Donation::STATUS_NOK],
                'donations.grp_id' => $grpId,
                'donations.rec_id' => \FreeFW\Storage\Storage::COND_EMPTY
            ];
            if ($generation->getClicId() > 0) {
                $filters = ['clic_id' => $generation->getClicId()];
            }
            if ($generation->getPtypId() > 0) {
                $filters = ['donations.ptyp_id' => $generation->getPtypId()];
            }
            /**
             * @var \FreeFW\Model\Query $query
             */
            $query  = \FreeAsso\Model\Client::getQuery();
            $query
                ->addFromFilters($filters)
                ->setSort('cli_firstname,cli_lastname');
            if ($query->execute()) {
                /**
                 * @var \FreeFW\Model\ResultSet $results
                 */
                $results = $query->getResult();
                $stats   = [];
                if ($results->count() > 0) {
                    /**
                     * @var \FreeAsso\Service\Client $clientService
                     */
                    $clientService = \FreeFW\DI\DI::get('FreeAsso::Service::Client');
                    $clientService->setLogger($this->logger);
                    /**
                     * @var \FreeAsso\Model\Client $oneClient
                     */
                    foreach ($results as $oneClient) {
                        $clientService->generateReceiptByYear($oneClient, $year, $types, $stats, $grpId, $generation->getEdiId(), $generation->getRecgId(), $generation->getPtypId());
                    }
                }
                // Sauvegarde des numéros
                foreach ($types as $oneType) {
                    $oneType->save(false, true);
                }
            }
            $generation->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_DONE);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
            // On bascule toutes les sessions en clôturées...
            $sessions = \FreeAsso\Model\Session::find(['sess_year' => $year]);
            /**
             * @var \FreeAsso\Model\Session $oneSession
             */
            foreach ($sessions as $oneSession) {
                $oneSession->setSessStatus(\FreeAsso\Model\Session::STATUS_CLOSED);
                $oneSession->save(false, true);
            }
        } catch (\Exception $ex) {
            $generation->setRecgStatus(\FreeAsso\Model\ReceiptGeneration::STATUS_ERROR);
            if (!$generation->save(false, true)) {
                throw new \Exception('Erreur de mise à jour de la génération');
            }
            throw $ex;
        }
        $this->logger->debug('ReceiptGeneration.generate.END');
        return $p_params;
    }

    /**
     * Generate Excel for download
     *
     * @param array  $p_params
     * @param int    $p_user_id
     * 
     * @return array
     */
    public function excelDownload($p_params = [], $p_user_id)
    {
        $this->logger->debug('Receipt.excelDownload.start');
        // Vérifications
        if (!isset($p_params['year'])) {
            throw new \Exception('L\'année est obligatoire');
        }
        if (!isset($p_params['grp_id'])) {
            throw new \Exception('Le groupe est obligatoire');
        }
        $year  = $p_params['year'];
        $grpId = $p_params['grp_id'];
        //
        $query  = \FreeAsso\Model\Receipt::getQuery();
        $query
            ->addFromFilters(
                [
                    'rec_year' => $year,
                    'grp_id'   => $grpId,
                ]
            )
            ->addRelations(['client', 'receipt_type'])
            ->setSort('client.cli_firstname,client.cli_lastname');
        $object = 'FreeAsso_receipt';
        $parts  = explode('_', $object);
        $date   = \str_replace('-', '', \FreeFW\Tools\Date::getCurrentDate());
        $name   = array_pop($parts) . '_' . $date;
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            $stats   = [];
            if ($results->count() > 0) {
                $tmpFile = '/tmp/export_' . uniqid() . '.xlsx';
                $sheet = new \FreeOffice\Model\SpreadSheet($tmpFile);
                try {
                    foreach ($results as $oneReceipt) {
                        $client = $oneReceipt->getClient();
                        $type   = $oneReceipt->getReceiptType();
                        $datas  = new \FreeFW\Model\MergeModel();
                        $datas->addBlock('receipt');
                        $datas->addField('rec_number', 'Numéro', '', 'receipt');
                        $datas->addField('rec_year', 'Année', '', 'receipt');
                        $datas->addField('cli_lastname', 'Nom', '', 'receipt');
                        $datas->addField('cli_firstname', 'Prénom', '', 'receipt');
                        $datas->addField('rett_name', 'Type', '', 'receipt');
                        $datas->addField('rec_mnt', 'Montant', '', 'receipt');
                        $datas->addData(
                            [
                                'rec_number'    => $oneReceipt->getRecNumber(),
                                'rec_year'      => $oneReceipt->getRecYear(),
                                'cli_lastname'  => $client->getCliLastname(),
                                'cli_firstname' => $client->getCliFirstname(),
                                'rett_name'     => $type->getRettName(),
                                'rec_mnt'       => $oneReceipt->getRecMnt()
                            ],
                            'receipt',
                            true
                        );
                        $sheet->addLine($datas);
                    }
                } catch (\Exception $ex) {
                    $myEx = \FreeFW\Tools\Exception::format($ex);
                    $this->logger->error($myEx);
                    $sheet->close();
                    @unlink($tmpFile);
                    return false;
                }
                $sheet->close();
                // Add notification and inbox
                $inbox = new \FreeFW\Model\Inbox();
                $inbox
                    ->setInboxFilename($name . '.xlsx')
                    ->setInboxObjectName($object)
                    ->setInboxParams(json_encode($p_params))
                    ->setInboxContent(file_get_contents($tmpFile))
                    ->setUserId($p_user_id);
                if (!$inbox->create()) {
                    $result = false;
                }
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifCode('EXPORT')
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifSubject('Export terminé')
                    ->setNotifObjectName($object)
                    ->setUserId($p_user_id);
                if (!$notification->create()) {
                    $result = false;
                }
            }
        } else {
            $notification = new \FreeFW\Model\Notification();
            $notification
                ->setNotifCode('EXPORT')
                ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                ->setNotifSubject('Export vide')
                ->setNotifObjectName($object)
                ->setUserId($p_user_id);
            if (!$notification->create()) {
                $result = false;
            }
        }
        //
        $this->logger->debug('Receipt.excelDownload.end');
        return $p_params;
    }

    /**
     * Download receipts
     *
     * @param array $p_params
     * @param int   $p_user_id
     * 
     * @return array
     */
    public function deferredDownload($p_params = [], $p_user_id)
    {
        $this->logger->debug('Receipt.download.start');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = \FreeAsso\Model\Receipt::getQuery();
        /**
         *
         * @var \FreeFW\Model\Conditions $conditions
         */
        $filters = [
            'rec_year' => $p_params['year'],
            'grp_id'   => $p_params['grp_id'],
        ];
        if (isset($p_params['email'])) {
            if ($p_params['email'] == 'without') {
                $filters['rec_email'] = \FreeFW\Storage\Storage::COND_EMPTY;
            }
            if ($p_params['email'] == 'with') {
                $filters['rec_email'] = \FreeFW\Storage\Storage::COND_NOT_EMPTY;
            }
        }
        $sort = 'client.cli_lastname,client.cli_firstname';
        if (isset($p_params['sort'])) {
            $sort = $p_params['sort'];
        }
        $query
            ->addFromFilters($filters)
            ->addRelations(['client'])
            ->setSort($sort);
        $tmpPrefix  = '/tmp/export_' . uniqid() . '_';
        $outputFile = '/tmp/export_' . uniqid() . '.pdf';
        $merger     = new \FreeOffice\Tools\PdfMerger();
        $peer       = false;
        if (isset($p_params['peer'])) {
            $peer = $p_params['peer'];
        }
        if ($query->execute()) {
            $files    = [];
            $receipts = $query->getResult();
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
                }
            }
            $merger->merge('file', $outputFile, $peer);
            foreach ($files as $oneFile) {
                @unlink($oneFile);
            }
        }
        // Add notification and inbox
        $object = 'FreeAsso_Receipt';
        $date   = \str_replace('-', '', \FreeFW\Tools\Date::getCurrentDate());
        $name   = $p_params['name'] . $date;
        $inbox  = new \FreeFW\Model\Inbox();
        $inbox
            ->setInboxFilename($name . '.pdf')
            ->setInboxObjectName($object)
            ->setInboxParams(json_encode($p_params))
            ->setInboxContent(file_get_contents($outputFile))
            ->setUserId($p_user_id);
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
            ->setUserId($p_user_id);
        if (!$notification->create()) {
            $result = false;
        }
        // data can be empty, but it's a 2*
        $this->logger->debug('Receipt.download.end');
        return $p_params;
    }
}
