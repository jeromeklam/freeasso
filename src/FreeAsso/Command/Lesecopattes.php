<?php
namespace FreeAsso\Command;

/**
 * Kalaweit commands
 *
 * @author jeromeklam
 */
class Lesecopattes
{

    /**
     * Import data
     *
     * @param \FreeFW\Console\Input\Input $p_input
     */
    public function import(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de l'import", true);
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $storage  = \FreeFW\DI\DI::getShared('Storage::default');
        $assoPdo  = $storage->getProvider();
        /**
         * Nettoyage
         */
        $p_output->write("Nettoyage", true);
        $query = $assoPdo->exec("DELETE FROM asso_cause WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_main_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_data WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_config WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_category WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_type WHERE brk_id = " . $brokerId);
        /**
         * De base
         */
        $france = \FreeFW\Model\Country::findFirst(['cnty_name' => 'France']);
        $lang   = \FreeFW\Model\Lang::findFirst(['lang_name' => 'Français']);
        /**
         * Données de base
         */
        $myClicPart = \FreeFW\DI\DI::get('FreeAsso::Model::ClientCategory');
        $myClicPart
            ->setClicName('Particulier')
        ;
        if (!$myClicPart->create()) {
            var_export($myClicPart->getErrors());die;
        }
        $myTypeVeto = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
        $myTypeVeto
            ->setClitName('Vétérinaire')
        ;
        if (!$myTypeVeto->create()) {
            var_export($myTypeVeto->getErrors());die;
        }
        $myTypeOrig = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
        $myTypeOrig
            ->setClitName('Provenance')
        ;
        if (!$myTypeOrig->create()) {
            var_export($myTypeOrig->getErrors());die;
        }
        $myTypeOwner = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
        $myTypeOwner
            ->setClitName('Propriétaire')
        ;
        if (!$myTypeOwner->create()) {
            var_export($myTypeOwner->getErrors());die;
        }
        $mySiteType = \FreeFW\DI\DI::get('FreeAsso::Model::SiteType');
        $mySiteType
            ->setSittName('Enclos')
            ->setSittString_1(true)
            ->setSittString_2(true)
        ;
        if (!$mySiteType->create()) {
            var_export($mySiteType->getErrors());die;
        }
        /**
         * Sites
         */
        $myDSite = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myDSite
            ->setSiteName('Local')
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myDSite->create()) {
            var_export($myDSite->getErrors());die;
        }
        $tabOwners     = [];
        $tabSanitaries = [];
        $tabSites      = [];
        $tabTypeClot   = [];
        $tabTypeAbr    = [];
        $hSityes       = fopen(__DIR__ . '/../../../datas/lesecopattes/sites.csv', 'r');
        if ($hSityes) {
            while (($columns = fgetcsv($hSityes, 1000, ";")) !== FALSE) {
                if ($columns[1] == 'Nom') {
                    continue;
                }
                $ownerId = false;
                $sanitId = false;
                if ($columns[6] != '') {
                    if (!array_key_exists($columns[6], $tabOwners)) {
                        $myOwner = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                        $myOwner
                            ->setClitId($myTypeOwner->getClitId())
                            ->setClicId($myClicPart->getClicId())
                            ->setCliLastname($columns[6])
                            ->setCntyId($france->getCntyId())
                            ->setLangId($lang->getLangId())
                        ;
                        if (!$myOwner->create()) {
                            var_export($myOwner->getErrors());die;
                        }
                        $tabOwners[$columns[6]] = $myOwner->getCliId();
                    }
                    $ownerId = $tabOwners[$columns[6]];
                }
                if ($columns[22] != '') {
                    if (!array_key_exists($columns[22], $tabSanitaries)) {
                        $mySanitary = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                        $mySanitary
                            ->setClitId($myTypeVeto->getClitId())
                            ->setClicId($myClicPart->getClicId())
                            ->setCliLastname($columns[22])
                            ->setCntyId($france->getCntyId())
                            ->setLangId($lang->getLangId())
                        ;
                        if (!$mySanitary->create()) {
                            var_export($mySanitary->getErrors());die;
                        }
                        $tabSanitaries[$columns[22]] = $mySanitary->getCliId();
                    }
                    $sanitId = $tabSanitaries[$columns[22]];
                }
                $mySite = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
                $mySite
                    ->setSiteName($columns[1])
                    ->setSiteCode($columns[21])
                    ->setSiteAddress1($columns[4])
                    ->setSiteCp($columns[5])
                    ->setSiteTown($columns[2])
                    ->setSittId($mySiteType->getSittId())
                    ->setSiteArea(intval($columns[9]))
                    ->setSiteBool_1(false)
                ;
                if ($columns[13] != '') {
                    if (strtolower($columns[13]) == 'oui') {
                        $mySite->setSiteBool_1(true);
                    }
                }
                if ($columns[13] != '') {
                    if (strtolower($columns[13]) == 'oui') {
                        $mySite->setSiteBool_1(true);
                    }
                }
                if ($columns[17] != '') {
                    if (!array_key_exists(strtolower($columns[17]), $tabTypeClot)) {
                        $tabTypeClot[strtolower($columns[17])] = strtolower($columns[17]);
                        $mySite->setSiteString_1(strtolower($columns[17]));
                    }
                }
                if ($columns[16] != '') {
                    if (!array_key_exists(strtolower($columns[16]), $tabTypeClot)) {
                        $tabTypeAbr[strtolower($columns[16])] = strtolower($columns[16]);
                    }
                    $mySite->setSiteString_2(strtolower($columns[16]));
                }
                if ($columns[19] != '') {
                    $mySite->setSiteNumber_1(intval($columns[19]));
                }
                if ($ownerId) {
                    $mySite->setOwnerCliId($ownerId);
                }
                if ($sanitId) {
                    $mySite->setSanitCliId($sanitId);
                }
                if (!$mySite->create()) {
                    var_export($mySite->getErrors());die;
                }
                $tabSites[strtolower($columns[1])] = $mySite->getSiteId();
            }
        } else {
            $p_output->write("Erreur de gestion des sites", true);
            die;
        }
        /**
         * Configs
         */
        $content = '{"value":"Aucun","label":"Aucun"}';
        foreach ($tabTypeClot as $idx => $val) {
            $content .= ',{"value":"' . $val . '","label":"' . $val . '"}';
        }
        $myDataCloture = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataCloture
            ->setDataName("Type clôture")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataCloture->create()) {
            var_export($myDataCloture->getErrors());die;
        }
        $content = '{"value":"Aucun","label":"Aucun"}';
        foreach ($tabTypeAbr as $idx => $val) {
            $content .= ',{"value":"' . $val . '","label":"' . $val . '"}';
        }
        $myDataAbrev = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataAbrev
            ->setDataName("Type abrevoir")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataAbrev->create()) {
            var_export($myDataAbrev->getErrors());die;
        }
        $myDataAccesE = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataAccesE
            ->setDataName("Accès eau")
            ->setDataType(\FreeAsso\Model\Data::TYPE_BOOLEAN)
        ;
        if (!$myDataAccesE->create()) {
            var_export($myDataAccesE->getErrors());die;
        }
        $myDataNbElec = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataNbElec
            ->setDataName("Nb électrificateur")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataNbElec->create()) {
            var_export($myDataNbElec->getErrors());die;
        }
        /**
         * Config
         */
        $myCfgCloture = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgCloture
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_1)
            ->setAcfgValue($myDataCloture->getDataId())
        ;
        if (!$myCfgCloture->create()) {
            var_export($myCfgCloture->getErrors());die;
        }
        //
        $myCfgAbrevoir = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgAbrevoir
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_2)
            ->setAcfgValue($myDataAbrev->getDataId())
        ;
        if (!$myCfgAbrevoir->create()) {
            var_export($myCfgAbrevoir->getErrors());die;
        }
        //
        $myCfgAccesE = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgAccesE
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_SITE_BOOL_1)
            ->setAcfgValue($myDataAccesE->getDataId())
        ;
        if (!$myCfgAccesE->create()) {
            var_export($myCfgAccesE->getErrors());die;
        }
        //
        $myCfgNbElec = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgNbElec
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_SITE_NUMBER_1)
            ->setAcfgValue($myDataNbElec->getDataId())
        ;
        if (!$myCfgNbElec->create()) {
            var_export($myCfgNbElec->getErrors());die;
        }
        /**
         * Causes
         */
        $tabCauses = [];
        $tabCType  = [];
        $tabCMType = [];
        $tabColor  = [];
        $tabOrigs  = [];
        $hCauses   = fopen(__DIR__ . '/../../../datas/lesecopattes/causes.csv', 'r');
        if ($hCauses) {
            while (($columns = fgetcsv($hCauses, 1000, ";")) !== FALSE) {
                if ($columns[2] == 'Race') {
                    continue;
                }
                $origId = false;
                if ($columns[10] != '') {
                    if (!array_key_exists($columns[10], $tabOrigs)) {
                        $myOrig = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                        $myOrig
                            ->setClitId($myTypeOrig->getClitId())
                            ->setClicId($myClicPart->getClicId())
                            ->setCliLastname($columns[10])
                            ->setCntyId($france->getCntyId())
                            ->setLangId($lang->getLangId())
                        ;
                        if (!$myOrig->create()) {
                            var_export($myOrig->getErrors());die;
                        }
                        $tabOrigs[$columns[10]] = $myOrig->getCliId();
                    }
                    $origId = $tabOrigs[$columns[10]];
                }
                $camtId = null;
                if ($columns[1] != '') {
                    if (!array_key_exists(strtolower($columns[1]), $tabCMType)) {
                        $newCMtype = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
                        $newCMtype
                            ->setCamtName(strtolower($columns[1]))
                        ;
                        if (!$newCMtype->create()) {
                            var_export($newCMtype->getErrors());die;
                        }
                        $tabCMType[strtolower($columns[1])] = $newCMtype->getCamtId();
                    }
                    $camtId = $tabCMType[strtolower($columns[1])];
                }
                $cautId = null;
                if ($columns[2] != '') {
                    if (!array_key_exists(strtolower($columns[2]), $tabCType)) {
                        $newCtype = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
                        $newCtype
                            ->setCautName(strtolower($columns[2]))
                            ->setCamtId($camtId)
                        ;
                        if (!$newCtype->create()) {
                            var_export($newCtype->getErrors());die;
                        }
                        $tabCType[strtolower($columns[2])] = $newCtype->getCautId();
                    }
                    $cautId = $tabCType[strtolower($columns[2])];
                } else {
                    var_export($columns);die;
                }
                $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                $myCause
                    ->setCauName($columns[0])
                    ->setCauCode($columns[0])
                    ->setCautId($cautId)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
                ;
                if ($origId) {
                    $myCause->setOrigCliId($origId);
                }
                if ($columns[15] != '') {
                    $myCause->setCauDesc($columns[15]);
                }
                if ($columns[14] != '') {
                    if (array_key_exists(strtolower($columns[14]), $tabSites)) {
                        $myCause->setSiteId($tabSites[strtolower($columns[14])]);
                    } else {
                        $myCause->setSiteId($myDSite->getSiteId());
                    }
                } else {
                    $myCause->setSiteId($myDSite->getSiteId());
                }
                if ($columns[3] != '') {
                    if ($columns[3] == 'M') {
                        $myCause->setCauString_1("Mâle");
                    } else {
                        $myCause->setCauString_1("Femelle");
                    }
                } else {
                    $myCause->setCauString_1("Indéfini");
                }
                if ($columns[9] != '') {
                    if (!array_key_exists(strtolower($columns[9]), $tabColor)) {
                        $tabColor[strtolower($columns[9])] = strtolower($columns[9]);
                    }
                    $myCause->setCauString_2($columns[9]);
                }
                if (!$myCause->create()) {
                    var_export($myCause->getErrors());die;
                }
            }
        }
        $myDataSexe = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataSexe
            ->setDataName("Sexe")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[{"value":"Male":"label":"Male"}, {"value":"Femelle":"label":"Femelle"}, {"value":"Indéfini":"label":"Indéfini"}]')
        ;
        if (!$myDataSexe->create()) {
            var_export($myDataSexe->getErrors());die;
        }
        $myCfgSexe = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgSexe
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_CAU_STRING_1)
            ->setAcfgValue($myDataSexe->getDataId())
        ;
        if (!$myCfgSexe->create()) {
            var_export($myCfgSexe->getErrors());die;
        }
        $content = '';
        foreach ($tabColor as $idx => $val) {
            if ($content != '') {
                $content .= ',{"value":"' . $val . '","label":"' . $val . '"}';
            } else {
                $content .= '{"value":"' . $val . '","label":"' . $val . '"}';
            }
        }
        $myDataColor = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataColor
            ->setDataName("Couleur")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataColor->create()) {
            var_export($myDataColor->getErrors());die;
        }
        $myCfgColor = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgColor
            ->setAcfgCode('DATA_ID@' . \FreeAsso\Model\Config::CONFIG_CAU_STRING_2)
            ->setAcfgValue($myDataColor->getDataId())
        ;
        if (!$myCfgColor->create()) {
            var_export($myCfgColor->getErrors());die;
        }
        /**
         * 
         */
        $p_output->write("Fin de l'import", true);
    }
}
