<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Family
 *
 * @author jeromeklam
 */
class Family extends \FreeAsso\Model\Base\Family
{

    /**
     * Parent
     * @var \FreeAsso\Model\Family
     */
    protected $parent = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->fam_id = 0;
        $this->brk_id = 0;
        return $this;
    }

    /**
     * Set parent
     * 
     * @param \FreeAsso\Model\Family $p_parent
     * 
     * @return \FreeAsso\Model\Family
     */
    public function setParent($p_parent)
    {
        $this->parent = $p_parent;
        return $this;
    }

    /**
     * Get Parent
     * 
     * @return \FreeAsso\Model\Family
     */
    public function getParent()
    {
        return $this->parent;
    }
}
