<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMovement
 *
 * @author jeromeklam
 */
class CauseMovement extends \FreeAsso\Model\Base\CauseMovement
{

    /**
     * Status
     * @var string
     */
    const STATUS_OK      = 'OK';
    const STATUS_WAIT    = 'WAIT';
    const STATUS_KO      = 'KO';
    const STATUS_ARCHIVE = 'ARCHIVE';

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * From
     * @var \FreeAsso\Model\Site
     */
    protected $from_site = null;

    /**
     * Sto
     * @var \FreeAsso\Model\Site
     */
    protected $to_site = null;

    /**
     * Movement
     * @var \FreeAsso\Model\Movement
     */
    protected $movement = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->camv_id           = 0;
        $this->brk_id            = 0;
        $this->camv_site_from_id = null;
        $this->camv_site_to_id   = null;
        $this->camv_status       = self::STATUS_WAIT;
        $this->move_id           = null;
        return $this;
    }

    /**
     * Set cause
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCause($p_cause)
    {
        $this->cause = $p_cause;
        return $this;
    }

    /**
     * Get cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getCause()
    {
        return $this->cause;
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
     * Set movement
     *
     * @param \FreeAsso\Model\Movement $p_movement
     *
     * @return \FreeAsso\Model\CauseMovement
     */
    public function setMovement($p_movement)
    {
        $this->movement = $p_movement;
        return $this;
    }

    /**
     * Get movement
     *
     * @return \FreeAsso\Model\Movement
     */
    public function getMovement()
    {
        return $this->movement;
    }

    /**
     * Before create
     */
    public function beforeCreate()
    {
        if ($this->cause) {
            $this->cause = \FreeAsso\Model\Cause::findFirst(
                [
                    'cau_id' => $this->cause->getCauId()
                ]
            );
            if (!$this->from_site) {
                $this->from_site = $this->cause->getSite();
                $this->setCamvSiteFromId($this->cause->getSiteId());
            }
            $this->setCamvTs(\FreeFW\Tools\Date::getCurrentTimestamp());
        }
        return true;
    }

    /**
     * After create
     */
    public function afterCreate()
    {
        if ($this->cause) {
            $this->cause = \FreeAsso\Model\Cause::findFirst(
                [
                    'cau_id' => $this->cause->getCauId()
                ]
            );
            if ($this->getCamvStatus() !== self::STATUS_WAIT) {
                $site = \FreeAsso\Model\Site::findFirst(
                    [
                        'site_id' => $this->getToSite()->getSiteId()
                    ]
                );
                $this->cause->setSite($site);
                $this->cause->setSiteId($site->getSiteId());
                if (!$this->cause->save()) {
                    $this->addErrors($this->cause->getErrors());
                    return false;
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
        if ($this->getCamvStatus() === \FreeAsso\Model\CauseMovement::STATUS_ARCHIVE ||
            $this->getCamvStatus() === \FreeAsso\Model\CauseMovement::STATUS_OK) {
            $this->addError(\FreeAsso\Constants::ERROR_MOVEMENT_ARCHIVED, "Can't remove an archived movement !");
            return false;
        }
        return true;
    }
}
