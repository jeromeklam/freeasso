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
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Client
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     * Payment Type
     * @var \FreeAsso\Model\PaymentType
     */
    protected $payment_type = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->spo_id           = 0;
        $this->brk_id           = 0;
        $this->spo_send_news    = true;
        $this->spo_display_site = true;
        $this->spo_freq         = self::PAYMENT_TYPE_MONTH;
        $this->spo_freq_when    = 10;
        $this->spo_money        = 'EUR';
        return $this;
    }

    /**
     * Set cause
     * 
     * @param \FreeAsso\Model\Cause $p_cause
     * 
     * @return \FreeAsso\Model\Sponsorship
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
     * Set client
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setClient($p_client)
    {
        $this->client = $p_client;
        return $this;
    }

    /**
     * Get client
     *
     * @return \FreeAsso\Model\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set payment type
     * 
     * @param \FreeAsso\Model\PaymentType $p_payment_type
     * 
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setPaymentType($p_payment_type)
    {
        $this->payment_type = $p_payment_type;
        return $this;
    }

    /**
     * Get payment type
     * 
     * @return \FreeAsso\Model\PaymentType
     */
    public function getPaymentType()
    {
        return $this->payment_type;
    }
    
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
        $askTs = $p_date;
        $askTs->setDate($p_date->format('Y'), $p_date->format('m'), $this->getSpoFreqWhen());
        /**
         * Generate new donation
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        $donation
            ->setCauId($this->getCauId())
            ->setCliId($this->getCliId())
            ->setSpoId($this->getSpoId())
            ->setPtypId($this->getPtypId())
            ->setDonDisplaySite($this->getSpoDisplaySite())
            ->setDonStatus(\FreeAsso\Model\Donation::STATUS_WAIT)
            ->setDonMoney($this->getSpoMoney())
            ->setDonMnt($this->getSpoMnt())
            ->setDonSponsors($this->getSpoSponsors())
            ->setDonTs(\FreeFW\Tools\Date::getCurrentTimestamp())
            ->setDonAskTs(\FreeFW\Tools\Date::datetimeToMysql($askTs))
            ->setDonRealTs(\FreeFW\Tools\Date::datetimeToMysql($askTs))
            ->setDonEndTs(\FreeFW\Tools\Date::datetimeToMysql($askTs->add(new \DateInterval('P1Y'))))
        ;
        return $donation;
    }
}
