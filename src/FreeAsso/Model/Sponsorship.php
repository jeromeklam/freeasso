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
    use \FreeFW\Behaviour\EventManagerAwareTrait;
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\PaymentType;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Previous to
     * @var string
     */
    protected $previous_to = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->spo_freq_when = date('d');
        return $this;
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

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::validate()
     */
    protected function validate()
    {
        if (in_array($this->getSpoFreq(), [self::PAYMENT_TYPE_MONTH, self::PAYMENT_TYPE_YEAR])) {
            if (intval($this->getSpoFreqWhen()) <= 0) {
                $this->addError(
                    FFCST::ERROR_REQUIRED,
                    sprintf('%s field is required !', 'spo_freq_when'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'spo_freq_when'
                );
            }
        }
        if (in_array($this->getSpoFreq(), [self::PAYMENT_TYPE_YEAR])) {
            if (intval($this->getSpoFreqWhenCpl()) <= 0) {
                $this->addError(
                    FFCST::ERROR_REQUIRED,
                    sprintf('%s field is required !', 'spo_freq_when_cpl'),
                    \FreeFW\Core\Error::TYPE_PRECONDITION,
                    'spo_freq_when_cpl'
                );
            }
        }
        return $this;
    }

    /**
     *
     * @return boolean
     */
    public function afterCreate()
    {
        $from = \FreeFW\Tools\Date::mysqlToDatetime($this->getSpoFrom());
        $now  = \FreeFW\Tools\Date::getServerDatetime();
        // On ajoute le premier paiement
        if ($this->getSpoAddFirst()) {
            if ($from < $now) {
                $donation = $this->getNewDonation($from);
            } else {
                $donation = $this->getNewDonation($now);
            }
            if (!$donation->create()) {
                $this->addErrors($donation->getErrors());
                return false;
            }
        }
        return true;
    }

    /**
     * Before save
     *
     * @return boolean
     */
    public function beforeSave()
    {
        if ($this->getSpoTo()) {
            $old = \FreeAsso\Model\Sponsorship::findFirst(['spo_id' => $this->getSpoId()]);
            $this->previous_to = $old->getSpoTo();
        }
        return true;
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        if (!$this->previous_to && $this->previous_to == '' && $this->getSpoTo()) {
            $this->forwardRawEvent(\FreeAsso\Constants::EVENT_END_SPONSORSHIP, $this);
        }
        return true;
    }
}
