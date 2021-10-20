<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Movement
 *
 * @author jeromeklam
 */
class Movement extends \FreeAsso\Model\Base\Movement
{

    /**
     * Types
     * @var string
     */
    const TYPE_INPUT    = 'INPUT';
    const TYPE_OUTPUT   = 'OUTPUT';
    const TYPE_SIMPLE   = 'SIMPLE';
    const TYPE_TRANSFER = 'TRANSFER';

    /**
     * Status
     * @var string
     */
    const STATUS_OK      = 'OK';
    const STATUS_WAIT    = 'WAIT';
    const STATUS_KO      = 'KO';
    const STATUS_ARCHIVE = 'ARCHIVE';

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * From site
     * @var \FreeAsso\Model\Site
     */
    protected $from_site = null;

    /**
     * To site
     * @var \FreeAsso\Model\Site
     */
    protected $to_site = null;

    /**
     * From client
     * @var \FreeAsso\Model\Client
     */
    protected $from_client = null;

    /**
     * To client
     * @var \FreeAsso\Model\Client
     */
    protected $to_client = null;

    /**
     * Movements
     * @var [\FreeAsso\Model\CauseMovement]
     */
    protected $movements = null;

    /**
     * Causes
     * @var [\FreeAsso\Model\Cause]
     */
    protected $causes = null;

    /**
     * Old movement
     * @var \FreeAsso\Model\Movement
     */
    protected $old_movement = null;

    /**
     * Set movements
     *
     * @param [\FreeAsso\Model\Cause $p_movements]
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setMovements($p_movements)
    {
        $this->movements = $p_movements;
        return $this;
    }

    /**
     * Get movements
     *
     * @return [\FreeAsso\Model\CauseMovement]
     */
    public function getMovements()
    {
        if ($this->movements === null) {
            $this->movements = [];
            /**
             * @var \FreeFW\Model\Query $query
             */
            $model   = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMovement');
            $query   = $model->getQuery();
            $filters = [
                'move_id' => $this->getMoveId(),
            ];
            $query
                ->addFromFilters($filters)
                ->addRelations(['cause'])
            ;
            if ($query->execute()) {
                $this->movements = $query->getResult();
            }
        }
        return $this->movements;
    }

    /**
     * Set causes
     *
     * @param array $p_causes
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setCauses($p_causes)
    {
        $this->causes = $p_causes;
        return $this;
    }

    /**
     * Get causes
     *
     * @return [\FreeAsso\Model\Cause]
     */
    public function getCauses()
    {
        if ($this->causes === null) {
            $this->causes = [];
            /**
             * @var \FreeFW\Model\Query $query
             */
            $model   = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
            $query   = $model->getQuery();
            $filters = [
                'movements.move_id' => $this->getMoveId(),
            ];
            $query
                ->addFromFilters($filters)
                ->addRelations(['movements'])
            ;
            if ($query->execute()) {
                $this->causes = $query->getResult();
            }
        }
        return $this->causes;
    }

    /**
     * Set from
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setFromSite($p_site)
    {
        $this->from_site = $p_site;
        return $this;
    }

    /**
     * Get from
     *
     * @return \FreeAsso\Model\Site
     */
    public function getFromSite()
    {
        return $this->from_site;
    }

    /**
     * Set to
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setToSite($p_site)
    {
        $this->to_site = $p_site;
        return $this;
    }

    /**
     * Get to
     *
     * @return \FreeAsso\Model\Site
     */
    public function getToSite()
    {
        return $this->to_site;
    }

    /**
     * Set from client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setFromClient($p_client)
    {
        $this->from_client = $p_client;
        return $this;
    }

    /**
     * Get from client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getFromClient()
    {
        return $this->from_client;
    }

    /**
     * Set to client
     *
     * @param \FreeAsso\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Movement
     */
    public function setToClient($p_client)
    {
        $this->to_client = $p_client;
        return $this;
    }

    /**
     * Get To client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getToClient()
    {
        return $this->to_client;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        foreach ($this->getCauses() as $oneCause) {
            /**
             * @var \FreeAsso\Model\Cause $cause
             */
            $cause = \FreeAsso\Model\Cause::findFirst(['cau_id' => $oneCause->getCauId()]);
            if (!$cause) {
                // @todo
                $cause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                $cause
                    ->setCauFrom(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setSiteId($this->getMoveToSiteId())
                    ->setCauPublic(true)
                    ->setCauAvailable(true)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
                    ->setCauName($oneCause->getCauName())
                    ->setCauCode($oneCause->getCauCode())
                    ->setCautId($oneCause->getCautId())
                    ->setCauSex($oneCause->getCauSex())
                ;
                if (!$cause->create()) {
                    $this->addErrors($cause->getErrors());
                    return false;
                }
            }
            /**
             * @var \FreeAsso\Model\CauseMovement $causeMovement
             */
            $causeMovement = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMovement');
            $causeMovement
                ->setCamvSiteFromId($this->getMoveFromSiteId())
                ->setCamvSiteToId($this->getMoveToSiteId())
                ->setCauId($cause->getCauId())
                ->setCamvTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                ->setCamvStart($this->getMoveFrom())
                ->setCamvTo($this->getMoveTo())
                ->setCamvStatus($this->getMoveStatus())
                ->setMoveId($this->getMoveId())
            ;
            if (!$causeMovement->create()) {
                $this->addErrors($causeMovement->getErrors());
                return false;
            } else {
                switch ($this->getMoveType()) {
                    case self::TYPE_INPUT:
                        // L'animal a été créé, on n'a rien besoin de faire...
                        break;
                    case self::TYPE_OUTPUT:
                        $cause
                            ->setCauTo(\FreeFW\Tools\Date::getCurrentTimestamp())
                        ;
                        if (!$cause->save()) {
                            $this->addErrors($cause->getErrors());
                            return false;
                        }
                    default:
                        if ($this->getMoveStatus() === \FreeAsso\Model\CauseMovement::STATUS_OK || $this->getMoveStatus() === \FreeAsso\Model\CauseMovement::STATUS_ARCHIVE) {
                            $cause
                                ->setSiteId($this->getMoveToSiteId())
                            ;
                            if (!$cause->save()) {
                                $this->addErrors($cause->getErrors());
                                return false;
                            }
                        }
                        break;
                }
            }
        }
        return true;
    }

    /**
     * Avant la modificartion
     *
     * @return boolean
     */
    public function beforeSave()
    {
        $this->old_movement = \FreeAsso\Model\Movement::findFirst(['move_id' => $this->getMoveId()]);
        if (!$this->old_movement) {
            $this->addError(412, 'Movement not found');
            return false;
        }
        if ($this->old_movement->getMoveStatus() != self::STATUS_WAIT) {
            if ($this->getMoveStatus() != $this->old_movement->getMoveStatus()) {
                $this->addError(412, 'Can\'t modify status', \FreeAsso\Constants::ERROR_MOVEMENT_STATUS, 'move_status');
                return false;
            }
        }
        return true;
    }

    /**
     * Après l'enregistrement
     *
     * @return boolean
     */
    public function afterSave()
    {
        if ($this->getMoveStatus() != $this->old_movement->getMoveStatus()) {
            $causeMovements = $this->getMovements();
            /**
             * @var \FreeAsso\Model\CauseMovement $oneCauseMovement
             */
            foreach ($causeMovements as $oneCauseMovement) {
                if ($oneCauseMovement->getCamvStatus() == \FreeAsso\Model\CauseMovement::STATUS_WAIT) {
                    $oneCauseMovement->setCamvStatus($this->getMoveStatus());
                    if (!$oneCauseMovement->save()) {
                        $this->addErrors($oneCauseMovement->getErrors());
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * Before remove
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        if ($this->getMoveStatus() === \FreeAsso\Model\CauseMovement::STATUS_ARCHIVE ||
            $this->getMoveStatus() === \FreeAsso\Model\CauseMovement::STATUS_OK) {
            $this->addError(\FreeAsso\Constants::ERROR_MOVEMENT_ARCHIVED, "Can't remove an archived movement !");
            return false;
        }
        return true;
    }

    /**
     * Can validate ??
     *
     * @return boolean
     */
    public function canValidate()
    {
        $valid = true;
        if (!$this->getMoveFromSiteId()) {
            $this->addError(\FreeAsso\Constants::ERROR_MOVEMENT_FROM_MISSING, 'Le site de départ est manquant');
            $valid = false;
        }
        if (!$this->getMoveToSiteId()) {
            $this->addError(\FreeAsso\Constants::ERROR_MOVEMENT_TO_MISSING, 'Le site d\'arrivée est manquant');
            $valid = false;
        }
        return $valid;
    }
}
