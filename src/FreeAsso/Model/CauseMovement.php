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
     * Comportement
     */
    use \FreeAsso\Model\Behavior\Cause;
    use \FreeAsso\Model\Behavior\Movement;
    use \FreeSSO\Model\Behavior\Group;

    /**
     * Status
     * @var string
     */
    const STATUS_OK      = 'OK';
    const STATUS_WAIT    = 'WAIT';
    const STATUS_KO      = 'KO';
    const STATUS_ARCHIVE = 'ARCHIVE';

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
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->camv_status = self::STATUS_WAIT;
        return $this;
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
        if ($p_site) {
            $this->from_site         = $p_site;
            $this->camv_site_from_id = $this->from_site->getSiteId();
        } else {
            $this->from_site         = null;
            $this->camv_site_from_id = null;
        }
        return $this;
    }

    /**
     * Get from
     *
     * @return \FreeAsso\Model\Site
     */
    public function getFromSite()
    {
        if ($this->from_site === null) {
            if ($this->getCamvSiteFromId() > 0) {
                $this->from_site = \FreeAsso\Model\Site::findFirst(['site_id' => $this->getCamvSiteFromId()]);
            }
        }
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
        if ($p_site) {
            $this->to_site         = $p_site;
            $this->camv_site_to_id = $p_site->getSiteId();
        } else {
            $this->to_site         = null;
            $this->camv_site_to_id = null;
        }
        return $this;
    }

    /**
     * Get to
     *
     * @return \FreeAsso\Model\Site
     */
    public function getToSite()
    {
        if ($this->to_site === null) {
            if ($this->getCamvSiteToId() > 0) {
                $this->to_site = \FreeAsso\Model\Site::findFirst(['site_id' => $this->getCamvSiteToId()]);
            }
        }
        return $this->to_site;
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
                if ($site->getSiteExtern()) {
                    if (!$this->cause->getCauTo()) {
                        $this->cause
                            ->setCauTo($this->getCamvTo())
                            ->setCauString_3('Mouvement')
                        ;
                    }
                }
                if (!$this->cause->save()) {
                    $this->addErrors($this->cause->getErrors());
                    return false;
                }
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
        if (in_array($this->getCamvStatus(), [self::STATUS_OK, self::STATUS_ARCHIVE])) {
            $mySite = $this->getToSite();
            $myCause = $this->getCause();
            if ($mySite && $myCause) {
                if ($myCause->getSiteId() != $mySite->getSiteId()) {
                    $myCause->setSite($mySite);
                    $myCause->setSiteId($mySite->getSiteId());
                    if ($mySite->getSiteExtern()) {
                        if (!$myCause->getCauTo()) {
                            $myCause
                                ->setCauTo($this->getCamvTo())
                                ->setCauString_3('Mouvement')
                            ;
                        }
                    }
                    if (!$myCause->save()) {
                        $this->addErrors($myCause->getErrors());
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
        if ($this->getCamvStatus() === \FreeAsso\Model\CauseMovement::STATUS_ARCHIVE ||
            $this->getCamvStatus() === \FreeAsso\Model\CauseMovement::STATUS_OK) {
            $this->addError(\FreeAsso\Constants::ERROR_MOVEMENT_ARCHIVED, "Can't remove an archived movement !");
            return false;
        }
        return true;
    }
}
