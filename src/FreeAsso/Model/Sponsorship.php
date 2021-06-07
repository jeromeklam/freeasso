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
        // Si le parrainage a déjà commencé on génère le(s) don(s).
        if ($from <= $now) {
            if ($this->getSpoFreq() == self::PAYMENT_TYPE_MONTH) {
                $dFrom = $from->format('d');
                $mFrom = $from->format('m');
                $yFrom = $from->format('Y');
                $dNow  = $now->format('d');
                $mNow  = $now->format('m');
                $yNow  = $now->format('Y');
                while ($yFrom < $yNow || ($yFrom == $yNow && $mFrom < $mNow) || ($yFrom == $yNow && $mFrom == $mNow && $dFrom <= $dNow)) {
                    $addDonation = false;
                    if ($yFrom < $yNow || ($yFrom == $yNow && $mFrom < $mNow)) {
                        $addDonation = true;
                    } else {
                        if ($dFrom <= $this->getSpoFreqWhen() && $this->getSpoFreqWhen() <= $dNow) {
                            $addDonation = true;
                        }
                    }
                    if ($addDonation) {
                        $date = new \DateTime();
                        $date->setDate($yFrom, $mFrom, $this->getSpoFreqWhen());
                        $donation = $this->getNewDonation($date);
                        if (!$donation->create()) {
                            return false;
                        }
                    }
                    $mFrom = $mFrom + 1;
                    if ($mFrom > 12) {
                        $mFrom = 1;
                        $yFrom = $yFrom + 1;
                    }
                }
            }
        }
        return true;
    }
}
