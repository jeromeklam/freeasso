<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMedia
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeAsso\Model\Base\CauseMedia
{

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Versions
     * @var [\FreeAsso\Model\CauseMediaLang]
     */
    protected $versions = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->caum_id     = 0;
        $this->brk_id      = 0;
        $this->cau_id      = 0;
        $this->caum_public = true;
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
     * Get versions
     * 
     * @return [\FreeAsso\Model\CauseMediaLang]
     */
    public function getVersions()
    {
        if ($this->versions === null) {
            if ($this->getCaumType() != self::TYPE_PHOTO) {
                $model  = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMediaLang');
                $query  = $model->getQuery();
                $query
                    ->addFromFilters(['caum_id' => $this->getCaumId()])
                    ->addRelations(['lang'])
                ;
                if ($query->execute()) {
                    $this->versions = $query->getResult();
                }
            }
        }
        return $this->versions;
    }
}
