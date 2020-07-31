<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Cause
 *
 * @author jeromeklam
 */
class Cause extends \FreeAsso\Model\Base\Cause implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\CauseType;
    use \FreeAsso\Model\Behaviour\Site;
    use \FreeAsso\Model\Behaviour\Subspecies;

    /**
     * Constantes
     * @var string
     */
    const FAMILY_NONE          = 'NONE';
    const FAMILY_ANIMAL        = 'ANIMAL';
    const FAMILY_OTHER         = 'OTHER';
    const FAMILY_NATURE        = 'NATURE';
    const FAMILY_ADMINISTRATIV = 'ADMINISTRATIV';

    /**
     * Raiser
     * @var \FreeAsso\Model\Client
     */
    protected $raiser = null;

    /**
     * Parent 1
     * @var \FreeAsso\Model\Cause
     */
    protected $parent1 = null;

    /**
     * Parent 2
     * @var \FreeAsso\Model\Cause
     */
    protected $parent2 = null;

    /**
     * Default text
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_text = null;

    /**
     * Default blob
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_blob = null;

    /**
     * Come from
     * @var \FreeAsso\Model\Client
     */
    protected $origin = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cau_id        = 0;
        $this->brk_id        = 0;
        $this->caut_id       = 0;
        $this->cau_name      = '';
        $this->cau_code      = '';
        $this->cau_public    = 1;
        $this->cau_available = 1;
        $this->cau_mnt       = 0;
        $this->cau_mnt_left  = 0;
        $this->cau_money     = 'EUR';
        $this->cau_family    = self::FAMILY_ANIMAL;
        $this->cau_year      = intval(date('Y'));
        return $this;
    }

    /**
     * Set parent1
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent1($p_cause)
    {
        $this->parent1 = $p_cause;
        return $this;
    }

    /**
     * Get parent1
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent1()
    {
        return $this->parent1;
    }

    /**
     * Set parent2
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent2($p_cause)
    {
        $this->parent2 = $p_cause;
        return $this;
    }

    /**
     * Get parent2
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent2()
    {
        return $this->parent2;
    }

    /**
     * Set raiser
     *
     * @param \FreeAsso\Model\Client $p_raiser
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setRaiser($p_raiser)
    {
        $this->raiser = $p_raiser;
        return $this;
    }

    /**
     * Get raiser
     *
     * @return \FreeAsso\Model\Client
     */
    public function getRaiser()
    {
        return $this->raiser;
    }

    /**
     * Set proprietary
     *
     * @param \FreeFW\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setOrigin($p_client)
    {
        $this->origin =$p_client;
        return $this;
    }

    /**
     * Get proprietary
     *
     * @return \FreeAsso\Model\Client
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set default text
     *
     * @param \FreeAsso\Model\CauseMedia $p_media
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultText($p_media)
    {
        $this->default_text = $p_media;
        return $this;
    }

    /**
     * get default text
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultText()
    {
        return $this->default_text;
    }

    /**
     * Set default blob
     *
     * @param \FreeAsso\Model\CauseMedia $p_media
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultBlob($p_media)
    {
        $this->default_blob = $p_media;
        return $this;
    }

    /**
     * get default blob
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultBlob()
    {
        return $this->default_blob;
    }

    /**
     * Update mnt and mnt_left
     *
     * @return boolean
     */
    public function updateMnt()
    {
        $type  = $this->getCauseType();
        $total = 0;
        $left  = 0;
        $to    = $this->getCauTo();
        if ($type && $to == '') {
            // Tous les dons déjà enregistrés
            $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
            $query   = $model->getQuery();
            $filters = [
                'cau_id'     => $this->getCauId(),
                'spo_id'     => null,
                'don_status' => \FreeAsso\Model\Donation::STATUS_OK,
                'don_end_ts' => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()]
            ];
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
                'cau_id'   => $this->getCauId()
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
        $this
            ->setCauMnt($total)
            ->setCauMntLeft($left)
        ;
        return $this->save();
    }

    /**
     * Handle donation CRUD
     * Update Mnt, reaised, left, ...
     *
     * @param \FreeAsso\Model\Donation $p_added_donation
     * @param \FreeAsso\Model\Donation $p_removed_donation
     *
     * @return boolean
     */
    public function handleDonation($p_added_donation = null, $p_removed_donation = null)
    {
        $this->updateMnt();
        return true;
    }

    /**
     * Cause is active ?
     *
     * @param \DateTime $p_date
     *
     * @return string
     */
    public function isActive(\DateTime $p_date = null)
    {
        if ($p_date === null) {
            $p_date = \FreeFW\Tools\Date::getServerDatetime();
        }
        $from = $this->getCauFrom();
        $to   = $this->getCauTo();
        if (($from && $from > $p_date) || ($to && $to < $p_date)) {
            return false;
        }
        return true;
    }
}
