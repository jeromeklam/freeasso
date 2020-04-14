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
     * Cause
     * @var \FreeAsso\Model\Client
     */
    protected $client = null;

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Payment Type
     * @var \FreeAsso\Model\PaymentType
     */
    protected $payment_type = null;

    /**
     * Sponsorship
     * @var \FreeAsso\Model\Sponsorship
     */
    protected $sponsorship = null;

    /**
     * Origin
     * @var \FreeAsso\Model\DonationOrigin
     */
    protected $origin = null;

    /**
     * Session
     * @var \FreeAsso\Model\Session
     */
    protected $session = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->don_id      = 0;
        $this->brk_id      = 0;
        $this->don_ts      = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_ask_ts  = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_real_ts = \FreeFW\Tools\Date::getCurrentTimestamp();
        $this->don_status  = self::STATUS_WAIT;
        $this->dono_id     = null;
        $this->sess_id     = null;
        $this->spo_id      = null;
        return $this;
    }

    /**
     * Set client
     * 
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Donation
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
     * Set cause
     * 
     * @param \FreeAsso\Model\Cause $p_cause
     * 
     * @return \FreeAsso\Model\Donation
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
     * Set origin
     *
     * @param \FreeAsso\Model\DonationOrigin $p_origin
     *
     * @return \FreeAsso\Model\Donation
     */
    public function setOrigin($p_origin)
    {
        $this->origin = $p_origin;
        return $this;
    }

    /**
     * Get origin
     *
     * @return \FreeAsso\Model\DonationOrigin
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set session
     * 
     * @param \FreeAsso\Model\Session $p_session
     * 
     * @return \FreeAsso\Model\Donation
     */
    public function setSession($p_session)
    {
        $this->session = $p_session;
        return $this;
    }

    /**
     * Get session
     *
     * @return \FreeAsso\Model\Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set sponsorship
     * 
     * @param \FreeAsso\Model\Sponsorship $p_value
     * 
     * @return \FreeAsso\Model\Donation
     */
    public function setSponsorship($p_value)
    {
        $this->sponsorship = $p_value;
        return $this;
    }

    /**
     * Get sponsorship
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function getSponsorship()
    {
        return $this->sponsorship;
    }
}
