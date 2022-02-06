<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptDonation
 *
 * @author jeromeklam
 */
class ReceiptDonation extends \FreeAsso\Model\Base\ReceiptDonation
{

    /**
     * Behaviour
     */
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeAsso\Model\Behaviour\PaymentType;

    /**
     * Specific fields
     *
     * @return array
     */
    public function getSpecificEditionFields()
    {
        $fields   = [];
        $fields[] = [
            'name'    => 'ptyp_name',
            'type'    => 'string',
            'title'   => 'Type',
            'content' => $this->getPaymentType()->getPtypName()
        ];
        $fields[] = [
            'name'    => 'ptyp_name_en',
            'type'    => 'string',
            'title'   => 'Type',
            'content' => $this->getPaymentType()->getPtypNameEn()
        ];
        return $fields;
    }
}
