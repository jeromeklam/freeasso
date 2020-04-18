<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * DonationOrigin
 *
 * @author jeromeklam
 */
class DonationOrigin extends \FreeAsso\Model\Base\DonationOrigin
{

    /**
     * Status
     * @var string
     */
    const STATUS_OK      = 'OK';
    const STATUS_PENDING = 'PENDING';
    const STATUS_ERROR   = 'ERROR';

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->dono_id     = 0;
        $this->brk_id      = 0;
        $this->dono_status = self::STATUS_PENDING;
        return $this;
    }
}
