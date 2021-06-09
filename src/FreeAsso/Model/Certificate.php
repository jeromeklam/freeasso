<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Certificate
 *
 * @author jeromeklam
 */
class Certificate extends \FreeAsso\Model\Base\Certificate
{

    /**
     * Bahaviours
     */
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeFW\Model\Behaviour\File;
    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     *
     * @return boolean
     */
    public function calculateFields()
    {
        $mnt  = $this->getCertInputMnt();
        $when = $this->getCertTs();
        $rate = \FreeFW\Model\Rate::findBest($this->getCertInputMoney(),$this->getCertOutputMoney(), $when);
        if ($rate) {
            $newMnt = $mnt * $rate->getRateChange();
            $this->setCertOutputMnt($newMnt);
        }
        $unitBase = $this->getCertUnitBase();
        $unitMnt  = $this->getCertUnitMnt();
        if ($unitBase && $unitMnt) {
            $this->setCertData1(($mnt * $unitBase) / $unitMnt);
        }
        return true;
    }

    /**
     *
     */
    public function generate()
    {
        $cause = $this->getCause();
        if ($cause) {
            $causeType = $cause->getCauseType();
            if ($causeType) {
                $ediId = $causeType->getCautCertEdiId();
                if ($ediId) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $datas = $editionService->printEdition(
                        $ediId,
                        $this->getLangId(),
                        $this
                    );
                    if (isset($datas['filename']) && is_file($datas['filename'])) {
                        if ($this->getFileId()) {
                            $file = \FreeFW\Model\File::findFirst(['file_id' => $this->getFileId()]);
                        } else {
                            $file = new \FreeFW\Model\File();
                        }
                        $file
                            ->setFileObjectName('FreeAsso_Certificate')
                            ->setFileObjectId($this->getCertId())
                            ->setFileName('certificat.pdf')
                            ->setFileType('PDF')
                            ->setFileBlob(file_get_contents($datas['filename']))
                        ;
                        if ($file->getFileId()) {
                            if (!$file->save()) {
                                $this->setErrors($file->getErrors());
                                return false;
                            }
                            return true;
                        } else {
                            if ($file->create()) {
                                $this
                                    ->setFileId($file->getFileId())
                                    ->setCertGenTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ;
                                return $this->save(true, true);
                            } else {
                                $this->setErrors($file->getErrors());
                                return false;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }
}
