<?php
namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Cause extends \FreeFW\Core\Service
{

    /**
     * Send email to membre for cause update
     *
     * @param \FreeAsso\Model\Client $p_cause
     * @param string                 $p_event_name
     * @param \FreeFW\Model\Automate $p_automate
     *
     * @return boolean
     */
    public function notification($p_cause, $p_event_name, \FreeFW\Model\Automate $p_automate)
    {
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
        $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        $query   = $model->getQuery();
        $quifils = [
            'cau_id'     => $p_cause->getCauId(),
            'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
            'don_end_ts' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()]
        ];
        $query
            ->addFromFilters($quifils)
        ;
        $clients = [];
        if ($query->execute()) {
            $results = $query->getResult();
            if ($results) {
                foreach ($results as $row) {
                    $client = $row->getClient();
                    $clients[$client->getCliId()] = $client;
                }
            }
        }
        foreach ($clients as $client) {
            if ($client->getCliEmail() != '') {
                /**
                 *
                 * @var \FreeFW\Model\Message $message
                 */
                $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), [$client, $p_cause]);
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
                            $client
                        );
                        if (isset($datas['filename']) && is_file($datas['filename'])) {
                            $message->addAttachment($datas['filename'], $datas['name']);
                        }
                    }
                    $message->create();
                }
            } else {
                // Add notofication for manual send...
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifObjectName('FreeAsso_Client')
                    ->setNotifObjectId($client->getCliId())
                    ->setNotifSubject('Fin bénéficiaire ' . $p_cause->getCauName())
                    ->setNotifCode('END_CAUSE')
                    ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ;
                $notification->create();
            }
        }
        return true;
    }

    /**
     * For each cause, update mnts
     *
     * @return void
     */
    public function updateAll()
    {
        $query = \FreeAsso\Model\Cause::getQuery();
        //$query->addFromFilters(['cau_id' => 680]);
        $query->execute([], 'updateMnt');
    }

    /**
     * Update cause mnts
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function updateMnt(\FreeAsso\Model\Cause &$p_cause)
    {
        if ($p_cause instanceof \FreeAsso\Model\Cause) {
            $type  = $p_cause->getCauseType();
            $total = 0;
            $left  = 0;
            $to    = $p_cause->getCauTo();
            if ($type && $to == '') {
                /**
                 * Tous les dons ponctuels déjà enregistrés
                 * Les dons réhuliers seront gérés à part.
                 * On ne prend que ceux qui sont "payés"
                 */

                $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                $query   = $model->getQuery();
                $filters = [
                    'cau_id'     => $p_cause->getCauId(),
                    'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
                    'spo_id'     => null
                ];
                if ($type->getCautMntType() == \FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL) {
                    $filters['don_end_ts'] = [\FreeFW\Storage\Storage::COND_GREATER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()];
                }
                $query
                    ->addFromFilters($filters)
                ;
                if ($query->execute()) {
                    $results = $query->getResult();
                    if ($results) {
                        foreach ($results as $row) {
                            $mnt = \FreeFW\Tools\Monetary::convert($row->getDonMnt(), $row->getDonMoney(), $type->getCautMoney());
                            $total = $total + $mnt;
                        }
                    }
                }
                /**
                 * Tous les dons réguliers à venir : parrainages
                 */
                $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
                $query   = $model->getQuery();
                $filters = [
                    'cau_id'   => $p_cause->getCauId()
                ];
                $query->addFromFilters($filters);
                if ($query->execute()) {
                    $results = $query->getResult();
                    if ($results) {
                        foreach ($results as $row) {
                            $mnt  = \FreeFW\Tools\Monetary::convert($row->getSpoMnt(), $row->getSpoMoney(), $type->getCautMoney());
                            $now  = \FreeFW\Tools\Date::getServerDatetime();
                            $from = \FreeFW\Tools\Date::mysqlToDatetime($row->getSpoFrom());
                            $to   = $row->getSpoTo();
                            $y1   = $now->format('Y');
                            $m1   = $now->format('m');
                            $d1   = $now->format('d');
                            // Encore actif ??
                            if ($to != '') {
                                // date déjà passée ??
                                $end = \FreeFW\Tools\Date::mysqlToDatetime($to);
                                if ($end <= $now) {
                                    continue;
                                }
                            }
                            if ($row->getSpoFreq() == \FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH) {
                                // On regarde si la fin n'est pas dans le mois ou à venir
                                if ($to != '') {
                                    // Ok, on peut encore comptabiliser des mois
                                    $mult = 12;
                                    $y2   = $end->format('Y');
                                    $m2   = $end->format('m');
                                    $d2   = $end->format('d');
                                    if (($y2 - $y1) == 0) {
                                        if (($m2 - $m1) == 0) {
                                            if ($row->getSpoFreqWhen() > $d1 ) {
                                                $mult = 1;
                                            } else {
                                                $mult = 0;
                                            }
                                        } else {
                                            $mult = $m2 - $m1;
                                            if ($row->getSpoFreqWhen() <= $d2 ) {
                                                $mult = $mult - 1;
                                            }
                                        }
                                    } else {
                                        if (($y2 - $y1) == 1) {
                                            $mult = (12 - ($m1-1)) + $m2;
                                            if ($row->getSpoFreqWhen() <= $d2 ) {
                                                $mult = $mult - 1;
                                            }
                                        }
                                    }
                                } else {
                                    // Donc 12 mois
                                    $mult = 12;
                                }
                                // Est-ce que le parrainage a démarré ?
                                if ($from > $now) {
                                    // Démarre dans le futur...
                                    if ($from->format('Y') > $y1) {
                                        if (($from->format('Y') - $y1) == 1) {
                                            $mult = $mult - (12 - $m1) - ($from->format('m'));
                                        } else {
                                            $mult = 0;
                                        }
                                    } else {
                                        if ($from->format('m') > $m1) {
                                            $mult = $mult - ($from->format('m') - $m1);
                                        }
                                    }
                                } else {
                                    // Dois-je prendre en compte celui de ce mois ??
                                    if ($from->format('Y') == $y1 && $from->format('m') == $m1) {
                                        if ($from->format('d') <= $row->getSpoFreqWhen() && $row->getSpoFreqWhen() <= $d1) {
                                            // C'est censé être un don, j'ignore.
                                            $mult = $mult - 1;
                                        }
                                    }
                                }
                                if ($mult > 12) {
                                    $mult = 12;
                                }
                                if ($mult <= 0) {
                                    continue;
                                }
                                $total = $total + ($mult * $mnt);
                            } else {
                                //
                                $total = $total + $mnt;
                            }
                        }
                    }
                }
                $left = $type->getCautMaxMnt();
                $left = $left - $total;
                if ($left < 0) {
                    $left = 0;
                }
            }
            $p_cause
                ->setCauMnt($total)
                ->setCauMntLeft($left)
            ;
            return true;
        }
        return false;
    }
}
