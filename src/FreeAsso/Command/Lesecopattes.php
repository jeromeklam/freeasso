<?php
namespace FreeAsso\Command;

/**
 * Kalaweit commands
 *
 * @author jeromeklam
 */
class Lesecopattes
{

    protected function http_response($url, $status = null, $wait = 3)
    {
        $time = microtime(true);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if (!$head) {
                return false;
            }
            return $head;
    }
    
    /**
     * Retourne les coordonnées GPS
     * 
     * @param string $p_address
     * @param string $p_cp
     * @param string $p_town
     * 
     * @return string
     */
    protected function getCoordsFromAddress($p_address, $p_cp, $p_town, $p_loop = true)
    {
        sleep(4);
        $gps = '{"lat": 49.096306, "lon": 6.160053, "alt": 0}';
        $urlStart = 'https://nominatim.openstreetmap.org/search.php?q=';
        $urlEnd   = '&email=jeromeklam@free.fr&format=json&polygon=1&addressdetails=1';
        $query    = 'FRANCE ' . $p_cp . ' ' . $p_town . ' ' . $p_address;
        $url      = $urlStart . urlencode($query) . $urlEnd;
        $content  = $this->http_response($url);
        try {
            $json = json_decode($content, true);
            if (is_array($json) && count(json) > 0) {
                if (array_key_exists('lat', $json[0]) && array_key_exists('lon', $json[0])) {
                    $gps='{"lat": ' . $json[0]['lat'] . ', "lon" : ' . $json[0]['lon'] . '}';
                } else {
                    if ($p_loop) {
                        return $this->getCoordsFromAddress('', $p_cp, $p_town, false);
                    }
                }
            } else {
                if ($p_loop) {
                    return $this->getCoordsFromAddress('', $p_cp, $p_town, false);
                }
            }
        } catch (\Exception $ex) {
            if ($p_loop) {
                return $this->getCoordsFromAddress('', $p_cp, $p_town, false);
            }
        }
        return $gps;
    }

    /**
     * Foamattage code exploitation
     * 
     * @param mixed $p_code
     * 
     * @return NULL|string
     */
    protected function formatSiteCode($p_code)
    {
        $ret = null;
        if (trim($p_code != '')) {
            $codePays  = substr($p_code, 0, 2);
            $codeInsee = substr($p_code, 2, 5);
            $codeExp   = substr($p_code, 7, 3);
            $ret = strtoupper($codePays) . '.' . $codeInsee . '.' . $codeExp;
        }
        return $ret;
    }

    /**
     * Foamattage numéro de boucle
     *
     * @param mixed $p_code
     *
     * @return NULL|string
     */
    protected function formatCauseCode($p_code)
    {
        $ret = null;
        if (trim($p_code != '')) {
            $parts = explode('.', $p_code);
            if (count($parts) == 3) {
                $ret = 'FR.' . str_pad(intval($parts[0]), 3, '0', STR_PAD_LEFT) . 
                    str_pad(intval($parts[1]), 3, '0', STR_PAD_LEFT) . '.' . 
                    str_pad(intval($parts[2]), 5, '0', STR_PAD_LEFT)
                ;
            }
        }
        return $ret;
    }

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
        $p_output->write("Nettoyage : " . $brokerId, true);
        $query = $assoPdo->exec("UPDATE asso_cause SET parent1_cau_id = null, parent2_cau_id = null WHERE  brk_id = " . $brokerId);
        $query = $assoPdo->exec("UPDATE asso_site SET parent_site_id = null WHERE  brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_movement WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_media WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_media WHERE brk_id = " . $brokerId);
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
        $myTypeRaiser = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
        $myTypeRaiser
            ->setClitName('Eleveur')
        ;
        if (!$myTypeRaiser->create()) {
            var_export($myTypeRaiser->getErrors());die;
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
        $tabTypeAbri   = [];
        $tabTypeReserv = [];
        $tabTypePiq    = [];
        $tabTypeElec   = [];
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
                $coords = $this->getCoordsFromAddress($columns[4], $columns[5], $columns[2]);
                $mySite
                    ->setSiteName($columns[1])
                    ->setSiteCode($this->formatSiteCode($columns[21]))
                    ->setSiteAddress1($columns[4])
                    ->setSiteCp($columns[5])
                    ->setSiteTown($columns[2])
                    ->setSittId($mySiteType->getSittId())
                    ->setSiteArea(intval(str_replace([' ', " ", "\t"], '', $columns[9])))
                    ->setSiteCodeEx($columns[21])
                    ->setSitePlots($columns[8])
                    ->setSiteBool_1(false)
                    ->setSiteCoord($coords)
                ;
                if ($columns[10] != '') {
                    $mySite->setSiteNumber_1(intval(str_replace([' ', " ", "\t"], '', $columns[10])));
                }
                if ($columns[11] != '') {
                    $mySite->setSiteNumber_4(intval(str_replace([' ', " ", "\t"], '', $columns[11])));
                }
                if ($columns[12] != '') {
                    if (!array_key_exists(strtolower($columns[12]), $tabTypeAbri)) {
                        $tabTypeAbri[strtolower($columns[12])] = $columns[12];
                    }
                    $mySite->setSiteString_4(strtolower($columns[12]));
                } else {
                    $mySite->setSiteString_4('aucun');
                }
                if ($columns[13] != '') {
                    if (strtolower($columns[13]) == 'oui') {
                        $mySite->setSiteBool_1(true);
                    }
                }
                if ($columns[14] != '') {
                    if (!array_key_exists(strtolower($columns[14]), $tabTypeReserv)) {
                        $tabTypeReserv[strtolower($columns[14])] = $columns[14];
                    }
                    $mySite->setSiteString_5(strtolower($columns[14]));
                } else {
                    $mySite->setSiteString_5('aucun');
                }
                if ($columns[15] != '') {
                    $mySite->setSiteNumber_5(intval(str_replace([' ', " ", "\t"], '', $columns[15])));
                }
                if ($columns[16] != '') {
                    if (!array_key_exists(strtolower($columns[16]), $tabTypeAbr)) {
                        $tabTypeAbr[strtolower($columns[16])] = $columns[16];
                    }
                    $mySite->setSiteString_6(strtolower($columns[16]));
                } else {
                    $mySite->setSiteString_6('aucun');
                }
                if ($columns[17] != '') {
                    if (!array_key_exists(strtolower($columns[17]), $tabTypeClot)) {
                        $tabTypeClot[strtolower($columns[17])] = $columns[17];
                    }
                    $mySite->setSiteString_1(strtolower($columns[17]));
                } else {
                    $mySite->setSiteString_1('aucun');
                }
                if ($columns[18] != '') {
                    if (!array_key_exists(strtolower($columns[18]), $tabTypePiq)) {
                        $tabTypePiq[strtolower($columns[18])] = $columns[18];
                    }
                    $mySite->setSiteString_2(strtolower($columns[18]));
                } else {
                    $mySite->setSiteString_2('aucun');
                }
                if ($columns[19] != '') {
                    $mySite->setSiteNumber_3(intval($columns[19]));
                }
                if ($columns[20] != '') {
                    if (!array_key_exists(strtolower($columns[20]), $tabTypeElec)) {
                        $tabTypeElec[strtolower($columns[20])] = $columns[20];
                    }
                    $mySite->setSiteString_3(strtolower($columns[20]));
                } else {
                    $mySite->setSiteString_3('aucun');
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
         * Datas
         */
        /* *************************** */
        $content = '{"value":"Aucun","label":"Aucun"}';
        foreach ($tabTypeClot as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
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
        /* *************************** */
        $myDataLinClot = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataLinClot
            ->setDataName("Linéaire clôture")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataLinClot->create()) {
            var_export($myDataLinClot->getErrors());die;
        }
        /* *************************** */
        $content = '{"value":"aucun","label":"Aucun"}';
        foreach ($tabTypeAbr as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
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
        /* *************************** */
        $content = '{"value":"aucun","label":"Aucun"}';
        foreach ($tabTypeAbri as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
        }
        $myDataAbri = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataAbri
            ->setDataName("Type d'abri")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataAbri->create()) {
            var_export($myDataAbri->getErrors());die;
        }
        /* *************************** */
        $myDataNbAbri = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataNbAbri
            ->setDataName("Nombre d'abri")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataNbAbri->create()) {
            var_export($myDataNbAbri->getErrors());die;
        }
        /* *************************** */
        $content = '{"value":"aucun","label":"Aucun"}';
        foreach ($tabTypeReserv as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
        }
        $myDataReser = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataReser
            ->setDataName("Type de réserve")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataReser->create()) {
            var_export($myDataReser->getErrors());die;
        }
        /* *************************** */
        $myDataVolRes = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataVolRes
            ->setDataName("Volume réserve")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataVolRes->create()) {
            var_export($myDataVolRes->getErrors());die;
        }
        /* *************************** */
        $content = '{"value":"aucun","label":"Aucun"}';
        foreach ($tabTypePiq as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
        }
        $myDataPiq = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataPiq
            ->setDataName("Type de piquet")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataPiq->create()) {
            var_export($myDataPiq->getErrors());die;
        }
        /* *************************** */
        $content = '{"value":"aucun","label":"Aucun"}';
        foreach ($tabTypeElec as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
        }
        $myDataElec = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataElec
            ->setDataName("Type électrificateur")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[' . $content . ']')
        ;
        if (!$myDataElec->create()) {
            var_export($myDataElec->getErrors());die;
        }
        /* *************************** */
        $myDataNbElec = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataNbElec
            ->setDataName("Nb électrificateur")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataNbElec->create()) {
            var_export($myDataNbElec->getErrors());die;
        }
        /* *************************** */
        $myDataAccesE = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataAccesE
            ->setDataName("Accès eau")
            ->setDataType(\FreeAsso\Model\Data::TYPE_BOOLEAN)
        ;
        if (!$myDataAccesE->create()) {
            var_export($myDataAccesE->getErrors());die;
        }
        /**
         * Config
         */
        /* *************************** */
        $myCfgCloture = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgCloture
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_1)
            ->setAcfgValue($myDataCloture->getDataId())
        ;
        if (!$myCfgCloture->create()) {
            var_export($myCfgCloture->getErrors());die;
        }
        $myCfgCloture2 = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgCloture2
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_NUMBER_1)
            ->setAcfgValue($myDataLinClot->getDataId())
        ;
        if (!$myCfgCloture2->create()) {
            var_export($myCfgCloture2->getErrors());die;
        }
        /* *************************** */
        $myCfgAbri = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgAbri
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_4)
            ->setAcfgValue($myDataAbri->getDataId())
        ;
        if (!$myCfgAbri->create()) {
            var_export($myCfgAbri->getErrors());die;
        }
        $myCfgNbAbri = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgNbAbri
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_NUMBER_4)
            ->setAcfgValue($myDataNbAbri->getDataId())
        ;
        if (!$myCfgNbAbri->create()) {
            var_export($myCfgNbAbri->getErrors());die;
        }
        /* *************************** */
        $myCfgAbrevoir = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgAbrevoir
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_6)
            ->setAcfgValue($myDataAbrev->getDataId())
        ;
        if (!$myCfgAbrevoir->create()) {
            var_export($myCfgAbrevoir->getErrors());die;
        }
        /* *************************** */
        $myCfgPiq = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgPiq
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_2)
            ->setAcfgValue($myDataPiq->getDataId())
        ;
        if (!$myCfgPiq->create()) {
            var_export($myCfgPiq->getErrors());die;
        }
        /* *************************** */
        $myCfgElec = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgElec
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_3)
            ->setAcfgValue($myDataElec->getDataId())
        ;
        if (!$myCfgElec->create()) {
            var_export($myCfgElec->getErrors());die;
        }
        $myCfgNbElec = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgNbElec
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_NUMBER_3)
            ->setAcfgValue($myDataNbElec->getDataId())
        ;
        if (!$myCfgNbElec->create()) {
            var_export($myCfgNbElec->getErrors());die;
        }
        /* *************************** */
        $myCfgReser = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgReser
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_STRING_5)
            ->setAcfgValue($myDataReser->getDataId())
        ;
        if (!$myCfgReser->create()) {
            var_export($myCfgReser->getErrors());die;
        }
        $myCfgVolReser = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgVolReser
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_NUMBER_5)
            ->setAcfgValue($myDataVolRes->getDataId())
        ;
        if (!$myCfgVolReser->create()) {
            var_export($myCfgVolReser->getErrors());die;
        }
        /* *************************** */
        $myCfgAccesE = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgAccesE
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_SITE_BOOL_1)
            ->setAcfgValue($myDataAccesE->getDataId())
        ;
        if (!$myCfgAccesE->create()) {
            var_export($myCfgAccesE->getErrors());die;
        }
        /**
         * Causes
         */
        $tabCauses  = [];
        $tabCType   = [];
        $tabCMType  = [];
        $tabColor   = [];
        $tabOrigs   = [];
        $tabRaisers = [];
        $hCauses    = fopen(__DIR__ . '/../../../datas/lesecopattes/causes.csv', 'r');
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
                $raisId = false;
                if ($columns[11] != '') {
                    if (!array_key_exists($columns[11], $tabRaisers)) {
                        $myRaiser = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                        $myRaiser
                            ->setClitId($myTypeRaiser->getClitId())
                            ->setClicId($myClicPart->getClicId())
                            ->setCliLastname($columns[11])
                            ->setCntyId($france->getCntyId())
                            ->setLangId($lang->getLangId())
                        ;
                        if (!$myRaiser->create()) {
                            var_export($myRaiser->getErrors());die;
                        }
                        $tabRaisers[$columns[11]] = $myRaiser->getCliId();
                    }
                    $raisId = $tabRaisers[$columns[11]];
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
                    ->setCauCode($this->formatCauseCode($columns[0]))
                    ->setCautId($cautId)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
                ;
                if ($origId) {
                    $myCause->setOrigCliId($origId);
                }
                if ($raisId) {
                    $myCause->setRaisCliId($raisId);
                }
                if ($columns[15] != '') {
                    $myCause->setCauDesc($columns[15]);
                }
                if ($columns[3] != '') {
                    if ($columns[3] == 'M') {
                        $myCause->setCauSex("M");
                    } else {
                        $myCause->setCauSex("F");
                    }
                } else {
                    $myCause->setCauSex("OTHER");
                }
                if ($columns[4] != '') {
                    $myCause->setCauYear(intval($columns[4]));
                }
                if ($columns[8] != '') {
                    $myCause->setCauFrom(\FreeFW\Tools\Date::ddmmyyyyToMysql($columns[8]));
                }
                if ($columns[9] != '') {
                    if (!array_key_exists(strtolower($columns[9]), $tabColor)) {
                        $tabColor[strtolower($columns[9])] = $columns[9];
                    }
                    $myCause->setCauString_1(strtolower($columns[9]));
                } else {
                    $myCause->setCauString_1('indefini');
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
                if (!$myCause->create()) {
                    var_export($myCause->getErrors());die;
                }
            }
        }
        /* *************************** */
        $content = '{"value":"indefini","label":"Indéfini"}';
        foreach ($tabColor as $idx => $val) {
            $content .= ',{"value":"' . $idx . '","label":"' . $val . '"}';
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
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_CAU_STRING_1)
            ->setAcfgValue($myDataColor->getDataId())
        ;
        if (!$myCfgColor->create()) {
            var_export($myCfgColor->getErrors());die;
        }
        /* *************************** */
        $myDataProv = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataProv
            ->setDataName("Provenance")
            ->setDataType(\FreeAsso\Model\Data::TYPE_STRING)
        ;
        if (!$myDataProv->create()) {
            var_export($myDataProv->getErrors());die;
        }
        $myCfgProv = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgProv
            ->setAcfgCode('' . \FreeAsso\Model\Config::CONFIG_CAU_STRING_2)
            ->setAcfgValue($myDataProv->getDataId())
        ;
        if (!$myCfgProv->create()) {
            var_export($myCfgProv->getErrors());die;
        }
        /**
         * 
         */
        $p_output->write("Fin de l'import", true);
    }
}
