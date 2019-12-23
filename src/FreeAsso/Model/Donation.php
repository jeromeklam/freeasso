<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Donation
 *
 * @author jeromeklam
 */
class Donation extends \FreeAsso\Model\Base\Donation
{

    /**
     * STATUS
     * @var string
     */
    const STATUS_OK   = 'OK';
    const STATUS_WAIT = 'WAIT';
    const STATUS_NEXT = 'NEXT';
    const STATUS_NOK  = 'NOK';

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->don_id = 0;
        $this->brk_id = 0;
        return $this;
    }
}
