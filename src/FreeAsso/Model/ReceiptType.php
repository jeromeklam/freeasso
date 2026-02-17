<?php

namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * ReceiptType
 *
 * @author jeromeklam
 */
class ReceiptType extends \FreeAsso\Model\Base\ReceiptType
{

    /**
     * Behavior
     */
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

    /**
     * Settings
     * @var [\FreeAsso\Model\ReceiptTypeCauseType]
     */
    protected $settings = null;

    /**
     * Get new number
     *
     * @param array   $p_params
     * 
     * @return string
     */
    public function getNewNumber($p_params = [])
    {
        $fullNumber = \FreeFW\Tools\PBXString::parse($this->getRettRegex(), $p_params);
        return $fullNumber;
    }

    /**
     * Set settings
     *
     * @param [\FreeAsso\Model\ReceiptTypeCauseType] $p_settings
     * 
     * @return \FreeFW\Model\CauseType
     */
    public function setSettings($p_settings)
    {
        $this->settings = $p_settings;
        return $this;
    }

    /**
     * Get settings
     *
     * @return [\FreeAsso\Model\ReceiptTypeCauseType]
     */
    public function getSettings()
    {
        $id = 0;
        if ($this->settings === null) {
            $causeType = \FreeAsso\Model\CauseType::find();
            $settings  = \FreeAsso\Model\ReceiptTypeCauseType::find(['rett_id' => $this->getRettId()]);
            $this->settings = new \FreeFW\Model\ResultSet();
            foreach ($causeType as $oneType) {
                $found = false;
                foreach ($settings as $oneSetting) {
                    if ($oneSetting->getCautId() == $oneType->getCautId()) {
                        $this->settings[] = $oneSetting;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $id--;
                    $newSetting = new \FreeAsso\Model\ReceiptTypeCauseType();
                    $newSetting
                        ->setRtctId($id)
                        ->setCauseType($oneType)
                        ->setReceiptType($this);
                    ;
                    $this->settings[] = $newSetting;
                }
            }
        }
        return $this->settings;
    }

    /**
     * Clean before save, create
     *
     * @return boolean
     */
    protected function cleanLinks()
    {
        $toClean = \FreeAsso\Model\ReceiptTypeCauseType::find(['rett_id' => $this->getRettId()]);
        foreach ($toClean as $oneObject) {
            if (!$oneObject->remove(false)) {
                $this->addErrors($oneObject->getErrors());
                return false;
            }
        } 
        return true;
    }

    /**
     * Save links
     * 
     * @param bool $p_force_create
     *
     * @return boolean
     */
    public function saveLinks($p_force_create = false)
    {
        foreach($this->settings as $oneSetting) {
            if (intval($oneSetting->getRtctId()) <= 0 || $p_force_create) {
                $oneSetting
                    ->setRtctId(null)
                    ->setReceiptType($this)
                ;
                if (!$oneSetting->create(false)) {
                    $this->addErrors($oneSetting->getErrors());
                    return false;
                }
            } else {
                if (!$oneSetting->save(false)) {
                    $this->addErrors($oneSetting->getErrors());
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        return $this->saveLinks();
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        if ($this->cleanLinks()) {
            return $this->saveLinks(true);
        }
        return false;
    }
}
