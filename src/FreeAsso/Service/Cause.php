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
     * For each cause, update mnts
     *
     * @return void
     */
    public function updateAll()
    {
        $query = \FreeAsso\Model\Cause::getQuery();
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
                // Tous les dons déjà enregistrés
                $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                $query   = $model->getQuery();
                $filters = [
                    'cau_id'     => $p_cause->getCauId(),
                    'spo_id'     => null,
                    'don_status' => \FreeAsso\Model\Donation::STATUS_OK
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
                // Tous les dons réguliers à venir : parrainages
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
                            $mnt   = \FreeFW\Tools\Monetary::convert($row->getSpoMnt(), $row->getSpoMoney(), $type->getCautMoney());
                            $day   = date('d');
                            $now   = \FreeFW\Tools\Date::getServerDatetime();
                            $start = \FreeFW\Tools\Date::mysqlToDatetime($row->getSpoFrom());
                            $to    = $row->getSpoTo();
                            if ($row->getSpoFreq() == \FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH) {
                                // On garde si la fin n'est pas dans le mois ou à venir
                                if ($to != '') {
                                    $end = \FreeFW\Tools\Date::mysqlToDatetime($to);
                                    $y2 = $end->format('Y');
                                    $y1 = $now->format('Y');
                                    $m2 = $end->format('m');
                                    $m1 = $now->format('m');
                                    $d2 = $end->format('d');
                                    if ($y2 < $y1 || ($y2 == $y1 && $m2 < $m1) || ($y2 == $y1 && $m2 == $m1 && $d2 < $row->getSpoFreqWhen()) ) {
                                        continue;
                                    }
                                }
                                // Par défaut on a 12 mois à comptabiliser... Mais
                                $mult = 12;
                                // Ce n'est pas le cas si la date de départ est dans le futur
                                if ($start > $now) {
                                    if (($y2 - $y1) == 0) {
                                        // Dans la même année...
                                        if (($m2 - $m1) == 0) {
                                            // Même mois mais jour de prélèvement déjà passé... donc -1
                                            if ($row->getSpoFreqWhen() < $d2 ) {
                                                $mult = 11;
                                            }
                                        } else {
                                            $mult = $mult - ($m2 - $m1);
                                        }
                                    } else {
                                        // Ca commence à être louche de démarrer si tard..
                                        // Warning, peut-être erreur de saisie
                                        if (($y2 - $y1) == 1 ) {
                                            $mult = $mult - (12 - $m1 + $m2);
                                        } else {
                                            continue;
                                        }
                                    }
                                } else {
                                    if ($to != '') {
                                        $end = \FreeFW\Tools\Date::mysqlToDatetime($to);
                                        $y2 = $end->format('Y');
                                        $y1 = $now->format('Y');
                                        $m2 = $end->format('m');
                                        $m1 = $now->format('m');
                                        $d2 = $end->format('d');
                                        if (($y2 - $y1) == 0) {
                                            if (($m2 - $m1) == 0) {
                                                if ($row->getSpoFreqWhen() > $d2 ) {
                                                    $mult = 0;
                                                } else {
                                                    $mult = 1;
                                                }
                                            } else {
                                                $mult = $m2 - $m1;
                                            }
                                        } else {
                                            if (($y2 - $y1) == 1) {
                                                $mult = (12 - $m2) + $m1;
                                            }
                                        }
                                    }
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
