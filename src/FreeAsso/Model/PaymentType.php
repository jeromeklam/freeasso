<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * PaymentType
 *
 * @author jeromeklam
 */
class PaymentType extends \FreeAsso\Model\Base\PaymentType
{

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->ptyp_id      = 0;
        $this->brk_id       = 0;
        $this->ptyp_receipt = true;
        return $this;
    }
}
