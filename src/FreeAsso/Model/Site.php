<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Site
 *
 * @author jeromeklam
 */
class Site extends \FreeAsso\Model\Base\Site implements
    \FreeFW\Interfaces\ApiResponseInterface
{
    
    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->site_id   = 0;
        $this->brk_id    = 0;
        $this->site_name = '';
        return $this;
    }
}
