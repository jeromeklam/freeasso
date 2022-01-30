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
    use \FreeAsso\Model\Behaviour\CertificateGeneration;
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
        $this->logger->info('certificate.generate.start');
        /**
         * @var \FreeAsso\Model\Cause
         */
        $cause = $this->getCause();
        if ($cause) {
            /**
             * @var \FreeAsso\Model\CauseType
             */
            $causeType = $cause->getCauseType();
            if ($causeType) {
                $ediId = $causeType->getCautCertEdiId();
                if ($ediId) {
                    /**
                     * @var \FreeFW\Service\Edition
                     */
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    $this->logger->info('certificate.generate.print.start');
                    $datas = $editionService->printEdition(
                        $ediId,
                        $this->getLangId(),
                        $this
                    );
                    $this->logger->info('certificate.generate.print.end');
                    if (isset($datas['filename']) && is_file($datas['filename'])) {
                        /**
                         * @var \FreeFW\Model\File $file
                         */
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
                                $this->logger->info('certificate.generate.file.error');
                                $this->setErrors($file->getErrors());
                                return false;
                            }
                            $this->logger->info('certificate.generate.file.ok');
                            return true;
                        } else {
                            if ($file->create()) {
                                $this
                                    ->setFileId($file->getFileId())
                                    ->setCertGenTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ;
                                return $this->save(true, false);
                            } else {
                                $this->logger->info('certificate.generate.error');
                                $this->setErrors($file->getErrors());
                                return false;
                            }
                        }
                    }
                }
            }
        }
        $this->logger->info('certificate.generate.end');
        return false;
    }

    /**
     * Specific fields
     *
     * @return array
     */
    public function getSpecificEditionFields()
    {
        $monnaie = $this->getCertInputMoney();
        if ($monnaie === 'EUR') {
            $monnaie = '€';
        }
        $fields   = [];
        $fields[] = [
            'name'    => 'mon',
            'type'    => 'string',
            'title'   => 'Monnaie',
            'content' => $monnaie
        ];
        return $fields;
    }
}
