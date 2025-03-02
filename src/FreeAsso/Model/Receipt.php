<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Receipt
 *
 * @author jeromeklam
 */
class Receipt extends \FreeAsso\Model\Base\Receipt
{

    use \FreeAsso\Model\Behaviour\Client;
    use \FreeAsso\Model\Behaviour\ReceiptType;
    use \FreeAsso\Model\Behaviour\ReceiptGeneration;
    use \FreeSSO\Model\Behaviour\Group;
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\File;

    const MODE_AUTO   = 'AUTO';
    const MODE_MANUAL = 'MANUAL';

    const SEND_METHOD_EMAIL   = 'EMAIL';
    const SEND_METHOD_MANUAL  = 'MANUAL';
    const SEND_METHOD_UNKNOWN = 'UNKNOWN';

    /**
     * Paiements
     * @var array[\FreeAsso\Model\Donation]
     */
    protected $donations = null;

    /**
     * Add amount
     *
     * @param number $p_mnt
     * @param string $p_money
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function addMnt($p_mnt, $p_money)
    {
        if (!$this->rec_mnt) {
            $this->rec_mnt = 0;
        }
        $mnt = \FreeFW\Model\Rate::convert($p_money, $this->getRecMoney(), $p_mnt);
        $this->rec_mnt += $mnt;
        return $this;
    }

    /**
     * Add donation
     *
     * @param \FreeAsso\Model\Donation $p_donation
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function addDonation($p_donation)
    {
        $this->donations[$p_donation->getDonId()] = $p_donation;
        return $this;
    }

    /**
     * Get donations
     *
     * @return array
     */
    public function getDonations()
    {
        if ($this->donations === null) {
            $this->donations = new \FreeFW\Model\ResultSet();
            $query = \FreeAsso\Model\ReceiptDonation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'rec_id' => $this->getRecId()
                    ]
                )
                ->addRelations(['payment_type'])
                ->setSort('-rdo_ts,rdo_mnt')
            ;
            if ($query->execute()) {
                $this->donations = $query->getResult();
            }
        }
        return $this->donations;
    }

    /**
     * Suppression d'un reçu en cascade
     *
     * @return void
     */
    public function beforeRemove()
    {
        // On commence par updater les dons
        $donations = \FreeAsso\Model\Donation::find(
            [
                'rec_id' => $this->getRecId()
            ]
        );
        /**
         * @var \FreeAsso\Model\Donation $oneDonation
         */
        foreach ($donations as $oneDonation) {
            $oneDonation
                ->setCheckSession(false)
                ->setRecId(null)
            ;
            if (!$oneDonation->save(false, true)) {
                $this->addErrors($oneDonation->getErrors());
                return false;
            }
        }
        // Ensuite on peut supprimer les lignes
        $receiptDonations = \FreeAsso\Model\ReceiptDonation::find(
            [
                'rec_id' => $this->getRecId()
            ]
        );
        /**
         * @var \FreeAsso\Model\ReceiptDonation $oneDonation
         */
        foreach ($receiptDonations as $oneDonation) {
            if (!$oneDonation->remove(false, true)) {
                $this->addErrors($oneDonation->getErrors());
                return false;
            }
        }
        return true;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function afterRemove()
    {
        // Et finalement l'édition
        $file = $this->getFile();
        if ($file) {
            if (!$file->remove(false, true)) {
                $this->addErrors($file->getErrors());
                return false;
            }
        }
        return true;
    }

    /**
     * Set full address
     *
     * @param string $p_address
     * 
     * @return \FreeAsso\Model\Receipt
     */
    public function setRecFullAddress($p_address)
    {
        return $this;
    }

    /**
     * Full address
     *
     * @return string
     */
    public function getRecFullAddress()
    {
        $address = trim($this->getRecFullname());
        if ($this->getRecAddress1() != '') {
            $address .= ' - ' . trim($this->getRecAddress1());
        }
        if ($this->getRecAddress2() != '') {
            $address .= ' - ' . trim($this->getRecAddress2());
        }
        if ($this->getRecAddress3() != '') {
            $address .= ' - ' . trim($this->getRecAddress3());
        }
        if ($this->getRecCp() != '' || $this->getRecTown() != '') {
            $cpl = trim($this->getRecCp()) . ' ' . trim($this->getRecTown());
            $address .= ' - ' . trim($cpl);
        }
        if ($this->getCntyId() > 0) {
            $address .= ' - ' . trim($this->getCountry()->getCntyName());
        }
        return $address;
    }

    /**
     * Specific fields
     *
     * @return array
     */
    public function getSpecificEditionFields($p_tmp_dir = '/tmp/', $p_keep_binary = true, $p_lang_code = null)
    {
        $donations = $this->getDonations();
        $donation = '';
        $monnaie = $this->getRecMoney();
        if ($monnaie === 'EUR') {
            $monnaie = '€';
        }
        $exercice = $this->getRecYear();
        if (count($donations) > 0) {
            $firstDonation = $donations[0];
            $datD = \FreeFW\Tools\Date::mysqlToDatetime($firstDonation->getRdoTs());
            if ($p_lang_code == 'fr') {
                $date = \FreeFW\Tools\DateTime::toFRLetter($datD);
            } else {
                $date = \FreeFW\Tools\DateTime::toENLetter($datD);
            }
            if (count($donations) == 1) {
                $exercice = $date;
            }
            $type = $firstDonation->getPaymentType();
            $donation = number_format($firstDonation->getRdoMnt(), 2, '.', ' ') . ' ' . $monnaie . ' - ' . $date . ' - (';
            if ($p_lang_code == 'fr') {
                $donation .= $type->getPtypName();
            } else {
                $donation .= $type->getPtypNameEn();
            }
            $donation .= ')';
        }
        $fields   = [];
        $fields[] = [
            'name'    => 'rec_first_donation',
            'type'    => 'string',
            'title'   => 'Don',
            'content' => $donation
        ];
        $fields[] = [
            'name'    => 'mon',
            'type'    => 'string',
            'title'   => 'Monnaie',
            'content' => $monnaie
        ];
        $address = new \FreeFW\Tools\Address();
        $address
            ->setFullname($this->getRecFullname())
            ->setAddress1($this->getRecAddress1())
            ->setAddress2($this->getRecAddress2())
            ->setAddress3($this->getRecAddress3())
            ->setPostcode($this->getRecCp())
            ->setTown($this->getRecTown())
        ;
        $country = $this->getCountry();
        if ($country) {
            $address->setCountry($country->getCntyName());
        }
        $address->compute();
        $fields[] = [
            'name'    => 'addr1',
            'type'    => 'string',
            'title'   => 'Address 1',
            'content' => $address->getLine(0)
        ];
        $fields[] = [
            'name'    => 'addr2',
            'type'    => 'string',
            'title'   => 'Address 2',
            'content' => $address->getLine(1)
        ];
        $fields[] = [
            'name'    => 'addr3',
            'type'    => 'string',
            'title'   => 'Address 3',
            'content' => $address->getLine(2)
        ];
        $fields[] = [
            'name'    => 'addr4',
            'type'    => 'string',
            'title'   => 'Address 4',
            'content' => $address->getLine(3)
        ];
        $fields[] = [
            'name'    => 'addr5',
            'type'    => 'string',
            'title'   => 'Address 5',
            'content' => $address->getLine(4)
        ];
        $fields[] = [
            'name'    => 'addr6',
            'type'    => 'string',
            'title'   => 'Address 6',
            'content' => $address->getLine(5)
        ];
        $fields[] = [
            'name'    => 'exercice',
            'type'    => 'string',
            'title'   => 'Exercice',
            'content' => $exercice
        ];
        return $fields;
    }

    /**
     * Génère et etocke le PDF
     *
     * @param [type] $p_edi_id
     * 
     * @return boolean
     */
    public function generatePDF($p_edi_id)
    {
        /**
         * @var \FreeFW\Service\Edition $editionService
         */
        $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
        $result = $editionService->printEdition($p_edi_id, $this->getLangId(), $this);
        if (is_array($result) && isset($result['filename'])) {
            if (is_file($result['filename'])) {
                $file = new \FreeFW\Model\File();
                $file
                    ->setFileName($this->getRecNumber() . '.pdf')
                    ->setFileObjectId($this->getRecId())
                    ->setFileObjectName('Freeasso_receipt')
                    ->setFileType(\FreeFW\Model\File::TYPE_PDF)
                    ->setFileTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                    ->setFileBlob(file_get_contents($result['filename']))
                ;
                @unlink($result['filename']);
                if ($file->create()) {
                    $this->setFileId($file->getFileId());
                    if ($this->save(false, true)) {
                        return \FreeOffice\Tools\Pdf::countPages($file->getFileBlob());
                    }
                }
            }
        }
        return false;
    }
}
