<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Sponsor
 *
 * @author jeromeklam
 */
class Sponsor extends \FreeAsso\Model\Base\Sponsor
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->spon_id      = '';
        $this->spon_name    = '';
        $this->spon_email   = '';
        $this->spon_site    = true;
        $this->spon_news    = true;
        $this->cli_id       = null;
        $this->spon_donator = true;
        return $this;
    }
}
