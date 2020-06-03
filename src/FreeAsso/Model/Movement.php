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
     * Causes
     * @var [\FreeAsso\Model\Cause]
     */
    protected $causes = null;

    /**
     * Set causes
     *
     * @param [\FreeAsso\Model\Cause $p_cause]
     *
     * @return \FreeAsso\Model\CauseMedia
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
                'movement.move_id' => $this->getMoveId(),
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
                    ->setSiteId($this->getModeFromSiteId())
                    ->setCauPublic(true)
                    ->setCauAvailable(true)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
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
                ->setCamvStatus(\FreeAsso\Model\CauseMovement::STATUS_OK)
                ->setMoveId($this->getMoveId())
            ;
            if (!$causeMovement->create()) {
                $this->addErrors($causeMovement->getErrors());
                return false;
            } else {
                switch ($this->getMoveType()) {
                    case self::TYPE_INPUT:
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
                        $cause
                            ->setSiteId($this->getMoveToSiteId())
                        ;
                        if (!$cause->save()) {
                            $this->addErrors($cause->getErrors());
                            return false;
                        }
                        break;
                }
            }
        }
        return true;
    }
}
