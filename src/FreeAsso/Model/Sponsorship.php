<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Sponsorship
 *
 * @author jeromeklam
 */
class Sponsorship extends \FreeAsso\Model\Base\Sponsorship
{

    /**
     *
     * @var string
     */
    const PAYMENT_TYPE_MONTH = 'MONTH';
    const PAYMENT_TYPE_YEAR  = 'YEAR';
    const PAYMENT_TYPE_OTHER = 'OTHER';

    /**
     * Comportement
     */
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\PaymentType;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Get new donation
     *
     * @return \FreeFW\Interfaces\DependencyInjectorInterface
     */
    public function getNewDonation(\Datetime $p_date = null)
    {
        if ($p_date === null) {
            $p_date = \FreeFW\Tools\Date::getServerDatetime();
        }
        $askTs = clone $p_date;
        $askTs->setDate($p_date->format('Y'), $p_date->format('m'), $this->getSpoFreqWhen());
        /**
         * Generate new donation
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        $donation
            ->setGroup($this->getGroup())
            ->setCauId($this->getCauId())
            ->setCliId($this->getCliId())
            ->setSpoId($this->getSpoId())
            ->setPtypId($this->getPtypId())
            ->setDonDisplaySite($this->getSpoDisplaySite())
            ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
            ->setDonMoney($this->getSpoMoney())
            ->setDonMnt($this->getSpoMnt())
            ->setDonSponsors($this->getSpoSponsors())
            ->setDonTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ->setDonAskTs(\FreeFW\Tools\Date::datetimeToMysql($askTs))
            ->setDonRealTs(\FreeFW\Tools\Date::datetimeToMysql($askTs))
            ->setDonEndTs(\FreeFW\Tools\Date::datetimeToMysql($askTs->add(new \DateInterval('P1Y'))))
            ->setDonMntInput($this->getSpoMntInput())
            ->setDonMoneyInput($this->getSpoMoneyInput())
        ;
        return $donation;
    }
}
