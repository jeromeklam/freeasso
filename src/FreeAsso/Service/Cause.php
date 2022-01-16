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
     * @param \FreeAsso\Model\Cause $p_cause
     * @param string                $p_action
     * @param boolean               $p_send_identity
     *
     * @return boolean
     */
    public function notification($p_cause, $p_action = "create", $p_send_identity = false)
    {
        /**
         * @var \FreeFW\Service\Email $emailService
         */
        $emailService = \FreeFW\DI\DI::get('FreeFW::Service::Email');
        /**
         * @var \FreeAsso\Model\CauseType $causeType
         */
        $causeType = $p_cause->getCauseType();
        switch ($p_action) {
            case 'create':
                $emailId = $causeType->getCautAddEmailId();
                break;
            case 'update':
                $emailId = $causeType->getCautUpdateEmailId();
                break;
            case 'remove':
                $emailId = $causeType->getCautEndEmailId();
                break;
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
        /**
         * @var \FreeAsso\Model\Donation $model
         */
        $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        $query   = $model->getQuery();
        $quifils = [
            'cau_id'     => $p_cause->getCauId(),
            'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
            'don_end_ts' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::getCurrentTimestamp()]
        ];
        $query
            ->addFromFilters($quifils)
        ;
        $clients = [];
        $groups  = [];
        if ($query->execute()) {
            $results = $query->getResult();
            if ($results) {
                foreach ($results as $row) {
                    $client = $row->getClient();
                    $clients[$client->getCliId()] = $client;
                    $groups[$client->getCliId()]  = $row->getGrpId();
                }
            }
        }
        /**
         * @var \FreeAsso\Model\Client $client
         */
        foreach ($clients as $client) {
            if ($client->getCliEmail() != '') {
                /**
                 *
                 * @var \FreeFW\Model\Message $message
                 */
                $filters['grp_id'] = $groups[$client->getCliId()];
                $message = $emailService->getEmailAsMessage($filters, $client->getLangId(), [$client, $p_cause]);
                if ($message) {
                    $message
                        ->addDest($client->getCliEmail())
                        ->setDestId($client->getCliId())
                    ;
                    $message->create();
                } else {
                    // Add notofication for manual send...
                    $notification = new \FreeFW\Model\Notification();
                    $notification
                        ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                        ->setNotifObjectName('FreeAsso_Client')
                        ->setNotifObjectInfo($client->getCliFullname())
                        ->setNotifObjectId($client->getCliId())
                        ->setNotifSubject('Cause : ' . $p_cause->getCauName())
                        ->setNotifText('Cause : ' . $p_cause->getCauName())
                        ->setNotifCode('END_CAUSE')
                        ->setNotifTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ;
                    $notification->create();
                }
            } else {
                // Add notofication for manual send...
                $notification = new \FreeFW\Model\Notification();
                $notification
                    ->setNotifType(\FreeFW\Model\Notification::TYPE_INFORMATION)
                    ->setNotifObjectName('FreeAsso_Client')
                    ->setNotifObjectInfo($client->getCliFullname())
                    ->setNotifObjectId($client->getCliId())
                    ->setNotifSubject('Cause : ' . $p_cause->getCauName())
                    ->setNotifText('Cause : ' . $p_cause->getCauName())
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
     * Update media
     *
     * @return void
     */
    public function updateAllMedia()
    {
        $query = \FreeAsso\Model\Cause::getQuery();
        if ($query->execute()) {
            $results = $query->getResult();
            /**
             * @var \FreeAsso\Model\Cause $oneCause
             */
            foreach ($results as $oneCause) {
                $queryMedia = \FreeAsso\Model\CauseMedia::getQuery();
                $queryMedia->addFromFilters(
                    [
                        'cau_id' => $oneCause->getCauId(),
                        'caum_code' => 'NEWS'
                    ]
                );
                if ($queryMedia->execute()) {
                    $medias = $queryMedia->getResult();
                    $saved  = null;
                    $tab    = [];
                    /**
                     * @var \FreeAsso\Model\CauseMedia $oneMedia
                     */
                    foreach ($medias as $oneMedia) {
                        if (strtoupper($oneMedia->getCaumTitle()) == 'PRESENTATION') {
                            $saved = $oneMedia;
                        } else {
                            $parts = explode('-', $oneMedia->getCaumTitle());
                            $year  = intval($parts[0]);
                            $month = 0;
                            $num   = $year * 100;
                            if (count($parts) > 1) {
                                $month = intval($parts[1]);
                            }
                            $month++;
                            $num += $month;
                            $tab[$num] = [
                                'caum_id'    => $oneMedia->getCaumId(),
                                'caum_order' => $oneMedia->getCaumOrder(),
                                'caum_title' => $oneMedia->getCaumTitle(),
                                'caum_date'  => $year . '-' . $month . '-01',
                            ];
                        }
                    }
                    if ($saved) {
                        $tab[0] = [
                            'caum_id'    => $saved->getCaumId(),
                            'caum_order' => $saved->getCaumOrder(),
                            'caum_title' => $saved->getCaumTitle(),
                            'caum_date'  => null,
                        ];
                    }
                    ksort($tab);
                    $num = 0;
                    $date = null;
                    foreach ($tab as $key => $value) {
                        echo $key . PHP_EOL;
                        $num++;
                        /**
                         * @var \FreeAsso\Model\CauseMedia $oneMedia
                         */
                        $oneCauseMedia = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $value['caum_id']]);
                        $oneCauseMedia->setCaumOrder($num);
                        $oneCauseMedia->save(false, true);
                        if ($value['caum_date']) {
                            $date = $value['caum_date'];
                        }
                    }
                    $oneCause->setCauLastNews($date);
                    $oneCause->save(false, true);
                }
            }
        }
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
            if ($type) {
                /**
                 * Tous les dons ponctuels déjà enregistrés
                 * Les dons réguliers seront gérés à part.
                 * On ne prend que ceux qui sont "payés"
                 * @var \FreeAsso\Model\Donation $model
                 */
                $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                /**
                 * @var \FreeFW\Model\Query $query
                 */
                $query   = $model->getQuery();
                $filters = [
                    'cau_id'     => $p_cause->getCauId(),
                    'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
                    'spo_id'     => null
                ];
                if ($type->getCautMntType() == \FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL) {
                    $filters['don_real_ts'] = [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()];
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
                 * @var \FreeAsso\Model\Sponsorship $model
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
                            /**
                             * @var \Datetime $now
                             */
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
                                            if ($row->getSpoFreqWhen() > $d1) {
                                                $mult = 1;
                                            } else {
                                                $mult = 0;
                                            }
                                        } else {
                                            $mult = $m2 - $m1;
                                            if ($row->getSpoFreqWhen() <= $d2) {
                                                $mult = $mult - 1;
                                            }
                                        }
                                    } else {
                                        if (($y2 - $y1) == 1) {
                                            $mult = (12 - ($m1 - 1)) + $m2;
                                            if ($row->getSpoFreqWhen() <= $d2) {
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
            if ($p_cause->getCauMnt() != $total || $p_cause->getCauMntLeft() != $left) {
                $p_cause
                    ->setCauMnt($total)
                    ->setCauMntLeft($left);
                return true;
            }
        }
        return false;
    }

    /**
     * Get sponsors
     * 
     * @return \FreeFW\Model\ResultSet
     */
    public function getSponsors($p_id)
    {
        $data = new \FreeFW\Model\ResultSet();
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = \FreeAsso\Model\Donation::getQuery();
        $query
            ->addFromFilters(
                [
                    'cau_id'      => $p_id,
                    'don_real_ts' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()],
                    'don_end_ts'  => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::getCurrentTimestamp()],
                    'spo_id'      => \FreeFW\Storage\Storage::COND_EMPTY
                ]
            )
            ->addRelations(['client']);
        if ($query->execute()) {
            $results = $query->getResult();
            foreach ($results as $donation) {
                /**
                 * @var \FreeAsso\Model\Sponsor $sponsor
                 */
                $sponsor = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                $sponsor
                    ->setSponId($donation->getCliId())
                    ->setSponName($donation->getClient()->getFullName())
                    ->setSponEmail($donation->getClient()->getCliEmail())
                    ->setSponSite($donation->getDonDisplaySite())
                    ->setSponNews($donation->getDonNews())
                    ->setCliId($donation->getCliId())
                    ->setSponDonator(true)
                ;
                $data->add($sponsor);
                $sponsors = json_decode($donation->getDonSponsors(), true);
                if (is_array($sponsors)) {
                    $i = 0;
                    foreach ($sponsors as $oneSponsor) {
                        $i++;
                        $site = true;
                        if (isset($oneSponsor['site'])) {
                            $site = (bool)$oneSponsor['site'];
                        }
                        $news = false;
                        if (trim($oneSponsor['email']) != '') {
                            $news = true;
                        }
                        if (isset($oneSponsor['news'])) {
                            $news = (bool)$oneSponsor['news'];
                        }
                        /**
                         * @var \FreeAsso\Model\Sponsor $sponsor2
                         */
                        $sponsor2 = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                        $sponsor2
                            ->setSponId($donation->getCliId() . '_' . $i)
                            ->setSponName($oneSponsor['name'])
                            ->setSponEmail($oneSponsor['email'])
                            ->setSponSite($site)
                            ->setSponNews($news)
                            ->setCliId($donation->getCliId())
                            ->setSponDonator(false)
                        ;
                        $data->add($sponsor2);
                    }
                }
            }
        }
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = \FreeAsso\Model\Sponsorship::getQuery();
        $query
            ->addFromFilters(
                [
                    'cau_id'   => $p_id,
                    'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()],
                    'spo_to'   => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::getCurrentTimestamp()]
                ]
            )
            ->addRelations(['client']);
        if ($query->execute()) {
            $results = $query->getResult();
            foreach ($results as $sponsorship) {
                /**
                 * @var \FreeAsso\Model\Sponsor $sponsor
                 */
                $sponsor = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                $sponsor
                    ->setSponId($sponsorship->getCliId())
                    ->setSponName($sponsorship->getClient()->getFullName())
                    ->setSponEmail($sponsorship->getClient()->getCliEmail())
                    ->setSponSite($sponsorship->getSpoDisplaySite())
                    ->setSponNews($sponsorship->getSpoSendNews())
                    ->setCliId($sponsorship->getCliId())
                    ->setSponDonator(true)
                ;
                $data->add($sponsor);
                $sponsors = json_decode($sponsorship->getSpoSponsors(), true);
                if (is_array($sponsors)) {
                    $i = 0;
                    foreach ($sponsors as $oneSponsor) {
                        $i++;
                        $site = $sponsorship->getSpoDisplaySite();
                        if (array_key_exists('site', $oneSponsor)) {
                            $site = (bool)$oneSponsor['site'];
                        }
                        $news = $sponsorship->getSpoSendNews();
                        if (array_key_exists('news', $oneSponsor)) {
                            $news = (bool)$oneSponsor['news'];
                        }
                        /**
                         * @var \FreeAsso\Model\Sponsor $sponsor2
                         */
                        $sponsor2 = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                        $sponsor2
                            ->setSponId($sponsorship->getCliId() . '_' . $i)
                            ->setSponName($oneSponsor['name'])
                            ->setSponEmail($oneSponsor['email'])
                            ->setSponSite($site)
                            ->setSponNews($news)
                            ->setCliId($sponsorship->getCliId())
                            ->setSponDonator(false);
                        $data->add($sponsor2);
                    }
                }
            }
        }
        return $data;
    }
}
