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
        //$query->addFromFilters(['cau_id' => 707]);
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
                            $mnt  = \FreeFW\Tools\Monetary::convert($row->getSpoMnt(), $row->getSpoMoney(), $type->getCautMoney());
                            $now  = \FreeFW\Tools\Date::getServerDatetime();
                            $from = \FreeFW\Tools\Date::mysqlToDatetime($row->getSpoFrom());
                            $to   = $row->getSpoTo();
                            $y1   = $now->format('Y');
                            $m1   = $now->format('m');
                            $d1   = $now->format('d');
                            // Encore actyif ??
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
