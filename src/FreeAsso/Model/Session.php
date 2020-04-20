<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Session
 *
 * @author jeromeklam
 */
class Session extends \FreeAsso\Model\Base\Session
{

    /**
     * Status
     * @var string
     */
    const STATUS_OPEN       = 'OPEN';
    const STATUS_CLOSED     = 'CLOSED';
    const STATUS_VALIDATION = 'VALIDATION';

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sess_id     = 0;
        $this->brk_id      = 0;
        $this->sess_status = self::STATUS_OPEN;
        return $this;
    }
}
