<?php
namespace FreeAsso\Command;

/**
 * Kalaweit commands
 *
 * @author jeromeklam
 */
class Kalaweit
{

    /**
     * Découpage du détail français en blocs
     *
     * @param string $p_detail
     *
     * @return string[]
     */
    protected function getDetailsFrAsArray($p_detail)
    {
        $monthsFR = ['JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE'];
        $monthsEN = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
        $lib = \FreeFW\Tools\Encoding::toUTF8($p_detail);
        $lib = \FreeFW\Tools\Encoding::fixUTF8($lib);
        $lib = str_replace('&nbsp;', ' ', $lib);
        $lib = html_entity_decode($lib);
        $lib = strip_tags($lib);
        $lib = \FreeFW\Tools\PBXString::clean($lib);
        $lines = explode("\n", $lib);
        $crtSubject = 'Presentation';
        $parts[$crtSubject] = [];
        $parts[$crtSubject]['subject'] = 'Présentation';
        $parts[$crtSubject]['text']    = '';
        foreach ($lines as $line) {
            $words = explode(" ", trim($line));
            if (count($words) <= 5) {
                $subject = '';
                $number  = false;
                $date    = false;
                foreach ($words as $word) {
                    $word = str_replace('-', '', $word);
                    $word = str_replace(',', '', $word);
                    $word = str_replace(';', '', $word);
                    $word = str_replace('.', '', $word);
                    if (intval($word) == $word && intval($word) > 1900) {
                        $number = '' . intval($word);
                    }
                    $maj = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($word));
                    if (in_array($maj, $monthsEN) !== false || in_array($maj, $monthsFR) !== false) {
                        $date = true;
                        if (in_array($maj, $monthsFR) !== false) {
                            $date = '-' . array_search($maj, $monthsFR);
                        }
                        if (in_array($maj, $monthsEN) !== false) {
                            $date = '-' . array_search($maj, $monthsEN);
                        }
                    }
                }
                if ($date && $number) {
                    $crtSubject = $number . $date;
                }
            }
            if (!array_key_exists($crtSubject, $parts)) {
                $parts[$crtSubject] = [];
                $parts[$crtSubject]['subject'] = trim($line);
                $parts[$crtSubject]['text']    = '';
                continue;
            }
            $parts[$crtSubject]['text'] .= $line . PHP_EOL;
        }
        return $parts;
    }

    /**
     * Découpage du détail anglais en blocs
     *
     * @param string $p_detail
     *
     * @return string[]
     */
    protected function getDetailsEnAsArray($p_detail)
    {
        $monthsFR = ['JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAIL', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE'];
        $monthsEN = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
        $lib = \FreeFW\Tools\Encoding::toUTF8($p_detail);
        $lib = \FreeFW\Tools\Encoding::fixUTF8($lib);
        $lib = str_replace('&nbsp;', ' ', $lib);
        $lib = html_entity_decode($lib);
        $lib = strip_tags($lib);
        $lib = \FreeFW\Tools\PBXString::clean($lib);
        $lines = explode("\n", $lib);
        $crtSubject = 'Presentation';
        $parts = [];
        $parts[$crtSubject] = [];
        $parts[$crtSubject]['subject'] = 'Presentation';
        $parts[$crtSubject]['text']    = '';
        foreach ($lines as $line) {
            $words = explode(" ", trim($line));
            if (count($words) <= 5) {
                $subject = '';
                $number  = false;
                $date    = false;
                foreach ($words as $word) {
                    $word = str_replace('-', '', $word);
                    $word = str_replace(',', '', $word);
                    $word = str_replace(';', '', $word);
                    $word = str_replace('.', '', $word);
                    if (intval($word) == $word && intval($word) > 1900) {
                        $number = '' . intval($word);
                    }
                    $maj = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($word));
                    if (in_array($maj, $monthsEN) !== false || in_array($maj, $monthsFR) !== false) {
                        $date = true;
                        if (in_array($maj, $monthsFR) !== false) {
                            $date = '-' . array_search($maj, $monthsFR);
                        }
                        if (in_array($maj, $monthsEN) !== false) {
                            $date = '-' . array_search($maj, $monthsEN);
                        }
                    }
                }
                if ($date && $number) {
                    $crtSubject = $number . $date;
                }
            }
            if (!array_key_exists($crtSubject, $parts)) {
                $parts[$crtSubject] = [];
                $parts[$crtSubject]['subject'] = trim($line);
                $parts[$crtSubject]['text']    = '';
                continue;
            }
            $parts[$crtSubject]['text'] .= $line . PHP_EOL;
        }
        return $parts;
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
        ini_set('memory_limit', '8096M');
        set_time_limit(3600);
        $p_output->write("Début de l'import", true);
        $provider = new \FreeFW\Storage\PDO\Mysql('mysql:host=mysql;dbname=kalaweitv1;charset=latin1;', 'super', 'YggDrasil');
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $assoPdo = $storage->getProvider();
        if ($brokerId != '4') {
            die('Wrong brokerId !');
        }

        /*
        $p_output->write("Import des Gibbons", true);
        try {
            $query = $provider->prepare("Select * from gibbons");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                if ($row->Details != '' || $row->Details_ang != '' || $row->Details_esp != '') {
                    $partsFR = $this->getDetailsFrAsArray($row->Details);
                    $partsEN = $this->getDetailsEnAsArray($row->Details_ang);
                    $keys = array_unique(array_merge(array_keys($partsFR), array_keys($partsEN)));
                    sort($keys);
                    var_export($keys) . PHP_EOL;;
                }
            }
        } catch (\Exception $ex) {

        }
        die('End');
        */

        /**
         * Langues
         */
        $langFR = 368;
        $langEN = 366;
        $langES = 367;
        /**
         * Nettoyage
         */
        $p_output->write("Nettoyage", true);
        $query = $assoPdo->exec("UPDATE asso_cause SET parent1_cau_id = null, parent2_cau_id = null, caum_blob_id = null, caum_text_id = null WHERE  brk_id = " . $brokerId);
        $query = $assoPdo->exec("UPDATE crm_client SET last_don_id = null WHERE  brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_file WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_media_lang WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_media WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_receipt_donation WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_donation WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_donation_origin WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_sponsorship WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_certificate WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_receipt WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_main_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_data WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_config WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_payment_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_receipt_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_session WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_file WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_subspecies WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_species WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_category WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_type WHERE brk_id = " . $brokerId);
        /**
         * Paramètres de base
         */
        $p_output->write("Import des Paramètres", true);
        // Motif d'arrêt d'une cause
        $myDataMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataMotif->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myDataMotif
            ->setDataName("Motif d'arrêt")
            ->setDataCode("MOTIFARRET")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[{"value":"Mort", "label":"Mort"}, {"value":"Libéré", "label":"Libéré"}, {"value":"Autre", "label":"Autre"}]')
        ;
        if (!$myDataMotif->create()) {
            var_export($myDataMotif->getErrors());die;
        }
        // Config 4
        $myCfgMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgMotif->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCfgMotif
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAU_STRING_3)
            ->setAcfgValue($myDataMotif->getDataId())
        ;
        if (!$myCfgMotif->create()) {
            var_export($myCfgMotif->getErrors());die;
        }
        // Site Ile
        $mySiteType = \FreeFW\DI\DI::get('FreeAsso::Model::SiteType');
        $mySiteType->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $mySiteType
            ->setSittName("Ile")
        ;
        if (!$mySiteType->create()) {
            var_export($mySiteType->getErrors());die;
        }
        // Bornéo
        $myIleBorneo = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleBorneo->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myIleBorneo
            ->setSiteName("Bornéo")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleBorneo->create()) {
            var_export($myIleBorneo->getErrors());die;
        }
        // Sumatra
        $myIleSumatra = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleSumatra->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myIleSumatra
            ->setSiteName("Sumatra")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleSumatra->create()) {
            var_export($myIleSumatra->getErrors());die;
        }
        // Autre
        $myIleAutre = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleAutre->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myIleAutre
            ->setSiteName("Autre")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleAutre->create()) {
            var_export($myIleAutre->getErrors());die;
        }
        // Grandes causes
        $myGibbonCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myGibbonCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myGibbonCause->setCamtName('Animaux');
        $myGibbonCause->create();
        $myForestCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myForestCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myForestCause->setCamtName('Forêt');
        $myForestCause->create();
        $myReserveCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myReserveCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myReserveCause->setCamtName('Réserve');
        $myReserveCause->create();
        $myKalaweitCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myKalaweitCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myKalaweitCause->setCamtName('Kalaweit');
        $myKalaweitCause->create();
        // Causes Gibbon
        $tabCausesGibbon = [];
        $myCauseGibbon = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseGibbon->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseGibbon
            ->setCautName('Gibbon')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL)
            ->setCautMaxMnt(280)
            ->setCautMinMnt(0)
            ->setCautFamily(\FreeAsso\Model\CauseType::FAMILY_ANIMAL)
            ->setCautDonation(\FreeAsso\Model\CauseType::DONATION_ALL)
            ->setCautOnceDuration(\FreeAsso\Model\CauseType::DURATION_1YEAR)
            ->setCautRegularDuration(\FreeAsso\Model\CauseType::DURATION_1YEAR)
            ->setCautNews(true)
            ->setCautReceipt(1)
            ->setCautString_2(1)
            ->setCautString_3(1)
            ->setCautText_1(1)
            ->setCamtId($myGibbonCause->getCamtId())
        ;
        if (!$myCauseGibbon->create()) {
            var_export($myCauseGibbon->getErrors());die;
        }
        $tabCausesGibbon['default'] = $myCauseGibbon->getCautId();
        //
        $mySpecies = \FreeFW\DI\DI::get('FreeAsso::Model::Species');
        $mySpecies->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $mySpecies->setSpeName('Gibbon');
        $mySpecies->create();
        //
        $tabSpecies = [];
        try {
            $query = $provider->prepare("Select * from especes_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $mySubspecies = \FreeFW\DI\DI::get('FreeAsso::Model::Subspecies');
                $mySubspecies->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $name = $row->Especes_nom_francais . ' (' . $row->Especes_nom_latin . ')';
                $name = \FreeFW\Tools\Encoding::toUTF8($name);
                $name = \FreeFW\Tools\Encoding::fixUTF8($name);
                $name = \FreeFW\Tools\PBXString::clean($name);
                $mySubspecies
                    ->setSspeName($name)
                    ->setSpeId($mySpecies->getSpeId())
                ;
                if (!$mySubspecies->create()) {
                    var_export($mySubspecies->getErrors());die;
                }
                $tabSpecies[$row->Especes_Id] = $mySubspecies->getSspeId();
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        // Cause Forêt
        $myCauseTForet = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseTForet->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseTForet
            ->setCautName('Forêt')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautFamily(\FreeAsso\Model\CauseType::FAMILY_NATURE)
            ->setCautDonation(\FreeAsso\Model\CauseType::DONATION_ALL)
            ->setCautOnceDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautRegularDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautNews(false)
            ->setCautText_1(1)
            ->setCamtId($myForestCause->getCamtId())
        ;
        if (!$myCauseTForet->create()) {
            var_export($myCauseTForet->getErrors());die;
        }
        $myCauseForet = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $myCauseForet->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseForet
            ->setCauName('Forêt')
            ->setCautId($myCauseTForet->getCautId())
            ->setSiteId($myIleBorneo->getSiteId())
            ->setCauDesc(null)
            ->setCauPublic(0)
            ->setCauAvailable(1)
        ;
        if (!$myCauseForet->create()) {
            var_export($myCauseForet->getErrors());die;
        }
        // Cause Dulan
        $myCauseTDulan = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseTDulan->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseTDulan
            ->setCautName('Dulan')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautFamily(\FreeAsso\Model\CauseType::FAMILY_NATURE)
            ->setCautDonation(\FreeAsso\Model\CauseType::DONATION_ALL)
            ->setCautOnceDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautRegularDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautNews(false)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautText_1(1)
            ->setCamtId($myReserveCause->getCamtId())
        ;
        if (!$myCauseTDulan->create()) {
            var_export($myCauseTDulan->getErrors());die;
        }
        $myCauseDulan = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $myCauseDulan->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseDulan
            ->setCauName('Dulan')
            ->setCautId($myCauseTDulan->getCautId())
            ->setSiteId($myIleBorneo->getSiteId())
            ->setCauDesc(null)
            ->setCauPublic(0)
            ->setCauAvailable(1)
        ;
        if (!$myCauseDulan->create()) {
            var_export($myCauseDulan->getErrors());die;
        }
        // Cause Kalaweit
        $myCauseTKalaweit = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseTKalaweit->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseTKalaweit
            ->setCautName('Kalaweit')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautFamily(\FreeAsso\Model\CauseType::FAMILY_ADMINISTRATIV)
            ->setCautDonation(\FreeAsso\Model\CauseType::DONATION_ALL)
            ->setCautOnceDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautRegularDuration(\FreeAsso\Model\CauseType::DURATION_INFINITE)
            ->setCautNews(false)
            ->setCautReceipt(1)
            ->setCautCertificat(0)
            ->setCautText_1(1)
            ->setCamtId($myKalaweitCause->getCamtId())
        ;
        if (!$myCauseTKalaweit->create()) {
            var_export($myCauseTKalaweit->getErrors());die;
        }
        $myCauseKalaweit = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $myCauseKalaweit->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myCauseKalaweit
            ->setCauName('Kalaweit')
            ->setCautId($myCauseTKalaweit->getCautId())
            ->setSiteId($myIleBorneo->getSiteId())
            ->setCauDesc(null)
            ->setCauPublic(0)
            ->setCauAvailable(1)
        ;
        if (!$myCauseKalaweit->create()) {
            var_export($myCauseKalaweit->getErrors());die;
        }
        // Type de client
        $myTypeMembre = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
        $myTypeMembre->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
        $myTypeMembre
            ->setClitName('Membre')
        ;
        if (!$myTypeMembre->create()) {
            var_export($myTypeMembre->getErrors());die;
        }
        /**
         * Import des Langues
         */
        $tabLangues = [];
        $p_output->write("Import des Langues", true);
        try {
            $query = $provider->prepare("Select * from lang_parle_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $name = \FreeFW\Tools\Encoding::toUTF8($row->lang_parle);
                $name = \FreeFW\Tools\Encoding::fixUTF8($name);
                $name = \FreeFW\Tools\PBXString::clean($name);
                $name = html_entity_decode($name);
                $myLang = \FreeFW\Model\Lang::findFirst(
                    [
                        'lang_name' => $name
                    ]
                );
                if (!$myLang) {
                    $myLang = \FreeFW\Model\Lang::findFirst(
                        [
                            'lang_name' => $name
                        ]
                    );
                }
                if (!$myLang) {
                    $myLang = \FreeFW\DI\DI::get('FreeFW::Model::Lang');
                    $myLang->setLangName($name);
                    if (!$myLang->create()) {
                        var_export($myLang->getErrors());die;
                    }
                }
                $tabLangues[$row->id_lang_parle] = $myLang->getLangId();
                if ($row->id_lang_parle == '1') {
                    $tabLangues['default'] = $myLang->getLangId();
                }
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des Types de paiement
         */
        $tabTypePay = [];
        $p_output->write("Import des Types de paiement", true);
        $TypHelloAsso = 0;
        $TypAlvarum = 0;
        $TypFacebook = 0;
        try {
            $query = $provider->prepare("Select * from type_reglement_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myTP = \FreeFW\DI\DI::get('FreeAsso::Model::PaymentType');
                $lib = \FreeFW\Tools\Encoding::toUTF8($row->Type_reglement_Libelle);
                $lib = \FreeFW\Tools\Encoding::fixUTF8($lib);
                $lib = \FreeFW\Tools\PBXString::clean($lib);
                $myTP
                    ->setPtypCode(strtoupper(\FreeFW\Tools\PBXString::withoutAccent(str_replace([' '], '', $lib))))
                    ->setPtypName($lib)
                    ->setPtypReceipt(1)
                ;
                if (!$myTP->create()) {
                    var_export($myTP->getErrors());die;
                }
                $tabTypePay[$row->Type_reglement_Id] = $myTP->getPtypId();
            }
            //
            $myTP = \FreeFW\DI\DI::get('FreeAsso::Model::PaymentType');
            $myTP
                ->setPtypCode('HELLOASSO')
                ->setPtypName('HelloAsso')
                ->setPtypReceipt(0)
            ;
            if (!$myTP->create()) {
                var_export($myTP->getErrors());die;
            }
            $TypHelloAsso = $myTP->getPtypId();
            //
            $myTP = \FreeFW\DI\DI::get('FreeAsso::Model::PaymentType');
            $myTP
                ->setPtypCode('ALVARUM')
                ->setPtypName('Alvarum')
                ->setPtypReceipt(0)
            ;
            if (!$myTP->create()) {
                var_export($myTP->getErrors());die;
            }
            $TypAlvarum = $myTP->getPtypId();
            //
            $myTP = \FreeFW\DI\DI::get('FreeAsso::Model::PaymentType');
            $myTP
                ->setPtypCode('FACEBOOK')
                ->setPtypName('Facebook')
                ->setPtypReceipt(0)
            ;
            if (!$myTP->create()) {
                var_export($myTP->getErrors());die;
            }
            $TypFacebook = $myTP->getPtypId();
            //
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des Pays
         */
        $tabPays = [];
        $p_output->write("Import des Pays", true);
        try {
            $query = $provider->prepare("Select * from pays_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myCountry = \FreeFW\Model\Country::findFirst(
                    [
                        'cnty_name' => $row->Pays_nom
                    ]
                );
                if (!$myCountry) {
                    $myCountry = \FreeFW\DI\DI::get('FreeFW::Model::Country');
                    $myCountry->setCntyName($row->Pays_nom);
                    if (!$myCountry->create()) {
                        var_export($myCountry->getErrors());die;
                    }
                }
                $tabPays[$row->Pays_id] = $myCountry;
                if ($row->Pays_nom == 'France') {
                    $tabPays['default'] = $myCountry;
                }
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des catégories de client
         */
        $tabClientCategory = [];
        $p_output->write("Import des Catégories de client", true);
        try {
            $query = $provider->prepare("Select distinct id_type from membres");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $name = \FreeFW\Tools\Encoding::toUTF8($row->id_type);
                $name = \FreeFW\Tools\Encoding::fixUTF8($name);
                $name = \FreeFW\Tools\PBXString::clean($name);
                $myClientCategory = \FreeFW\DI\DI::get('FreeAsso::Model::ClientCategory');
                $myClientCategory->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                if ($name == '') {
                    continue;
                }
                $myClientCategory->setClicName($name);
                if (!$myClientCategory->create()) {
                    var_export($myClientCategory->getErrors());die;
                }
                $tabClientCategory[$row->id_type] = $myClientCategory->getClicId();
                if ($row->id_type == 'Autre') {
                    $tabClientCategory['default'] = $myClientCategory->getClicId();
                }
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des Gibbons
         */
        $tabGibbons = [];
        $p_output->write("Import des Gibbons", true);
        try {
            $query = $provider->prepare("Select * from gibbons order by Numero_gibbon");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $desc = trim(\FreeFW\Tools\Encoding::toUTF8($row->Details));
                $desc = trim(\FreeFW\Tools\Encoding::fixUTF8($desc));
                $desc = \FreeFW\Tools\PBXString::clean($desc);
                if (strpos($desc, '<p>') === false) {
                    $desc = '<p>' . $desc . '</p>';
                }
                /*its getting data in line.And its an object*/
                $name = trim(\FreeFW\Tools\Encoding::toUTF8($row->Nom_gibbon));
                $name = \FreeFW\Tools\Encoding::fixUTF8($name);
                $name = \FreeFW\Tools\PBXString::clean($name);
                $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                $myCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $myCause
                    ->setCauName($name)
                    ->setCautId($myCauseGibbon->getCautId())
                    ->setCauDesc($desc)
                    ->setCauPublic(0)
                    ->setCauAvailable(0)
                ;
                if ($myCause->getCauName() == '') {
                    $myCause->setCauName('Sans nom');
                }
                if (intval($row->Annee_naissance) > 0) {
                    $myCause->setCauYear(intval($row->Annee_naissance));
                }
                $myCause->setSiteId($myIleAutre->getSiteId());
                if ($row->Ile == 'B') {
                    $myCause->setSiteId($myIleBorneo->getSiteId());
                }
                if ($row->Ile == 'S') {
                    $myCause->setSiteId($myIleSumatra->getSiteId());
                }
                if ($row->Sexe == 'F') {
                    $myCause->setCauSex("F");
                } else {
                    $myCause->setCauSex("M");
                }
                if (array_key_exists($row->Espece, $tabSpecies)) {
                    $myCause->setSspeId($tabSpecies[$row->Espece]);
                } else {
                    $myCause->setSspeId($tabSpecies[1]);
                }
                if (strtolower($row->site) == 'oui') {
                    $myCause->setCauPublic(1);
                }
                if (strtolower($row->adoption) == 'oui') {
                    $myCause->setCauAvailable(1);
                }
                $keep = true;
                if (strtolower($row->Gibbon_libere) == 'oui') {
                    $myCause->setCauString_3('Libéré');
                    $keep = false;
                }
                if (strtolower($row->Gibbon_mort) == 'oui') {
                    $myCause->setCauString_3('Mort');
                    $keep = false;
                }
                if (strtolower($row->Date_mort) != '') {
                    if ($row->Date_mort != '0000-00-00') {
                        $myCause->setCauTo($row->Date_mort);
                    } else {
                        $myCause->setCauTo(\FreeFW\Tools\Date::getCurrentTimestamp());
                    }
                } else {
                    if (!$keep) {
                        $myCause->setCauTo(\FreeFW\Tools\Date::getCurrentTimestamp());
                    }
                }
                if (!$myCause->create()) {
                    var_export($myCause->getErrors());die;
                }
                // Gestion des medias
                $blob = false;
                if ($row->Photo1 != '') {
                    $file = APP_ROOT . '/datas/kalaweit/adoption/' . $row->Photo1;
                    if (is_file($file)) {
                        $photo        = file_get_contents($file);
                        $thumb        = new \FreeFW\Tools\ImageResizer($file);
                        $myCauseMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                        $myCauseMedia
                            ->setCaumType(\FreeAsso\Model\CauseMedia::TYPE_PHOTO)
                            ->setCauId($myCause->getCauId())
                            ->setCaumCode('PHOTO1')
                            ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                            ->setCaumBlob(file_get_contents($file))
                            ->setCaumShortBlob($thumb->resizeToBestFit(200, 200))
                        ;
                        if (!$myCauseMedia->create()) {
                            var_export($myCauseMedia);
                        } else {
                            $myCause->setCaumBlobId($myCauseMedia->getCaumId());
                            $myCause->save();
                            $blob = true;
                        }
                    } else {
                        echo $file . ' not found !' . PHP_EOL;
                    }
                }
                if ($row->Photo2 != '') {
                    $file = APP_ROOT . '/datas/kalaweit/adoption/' . $row->Photo2;
                    if (is_file($file)) {
                        $photo        = file_get_contents($file);
                        $thumb        = new \FreeFW\Tools\ImageResizer($file);
                        $myCauseMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                        $myCauseMedia
                            ->setCaumType(\FreeAsso\Model\CauseMedia::TYPE_PHOTO)
                            ->setCauId($myCause->getCauId())
                            ->setCaumCode('PHOTO2')
                            ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                            ->setCaumBlob($photo)
                            ->setCaumShortBlob($thumb->resizeToBestFit(200, 200))
                        ;
                        if (!$myCauseMedia->create()) {
                            var_export($myCauseMedia);
                        } else {
                            if (!$blob) {
                                $myCause->setCaumBlobId($myCauseMedia->getCaumId());
                                $myCause->save();
                                $blob = true;
                            }
                        }
                    } else {
                        echo $file . ' not found !' . PHP_EOL;
                    }
                }
                if ($row->Details != '' || $row->Details_ang != '' || $row->Details_esp != '') {
                    $partsFR = $this->getDetailsFrAsArray($row->Details);
                    $partsEN = $this->getDetailsEnAsArray($row->Details_ang);
                    $keys = array_unique(array_merge(array_keys($partsFR), array_keys($partsEN)));
                    sort($keys);
                    $idx = count($keys) - 1;
                    $order = 0;
                    while ($idx >= 0) {
                        if ($keys[$idx] == 'Presentation') {
                            $desc = str_replace("\n", "<br />", $partsFR[$keys[$idx]]['text']);
                            if (strpos('<p>', $desc) === false) {
                                $desc = '<p>' . $desc . '</p>';
                            }
                            $myCause->setCauDesc($desc);
                            $myCause->save();
                        }
                        $order++;
                        $myCauseMedia = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMedia');
                        $myCauseMedia
                            ->setCaumType(\FreeAsso\Model\CauseMedia::TYPE_HTML)
                            ->setCauId($myCause->getCauId())
                            ->setCaumCode('NEWS')
                            ->setCaumTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                            ->setCaumTitle($keys[$idx])
                            ->setCaumOrder($order)
                        ;
                        if (!$myCauseMedia->create()) {
                            var_export($myCauseMedia);
                        }
                        if (array_key_exists($keys[$idx], $partsFR)) {
                            $desc = str_replace("\n", "<br />", $partsFR[$keys[$idx]]['text']);
                            if (strpos('<p>', $desc) === false) {
                                $desc = '<p>' . $desc . '</p>';
                            }
                            $myCauseMediaLang = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMediaLang');
                            $myCauseMediaLang
                                ->setCaumId($myCauseMedia->getCaumId())
                                ->setLangId($langFR)
                                ->setCamlSubject($partsFR[$keys[$idx]]['subject'])
                                ->setCamlText($desc)
                            ;
                            if (!$myCauseMediaLang->create()) {
                                var_export($myCauseMediaLang);die;
                            }
                        }
                        if (array_key_exists($keys[$idx], $partsEN)) {
                            $desc = str_replace("\n", "<br />", $partsEN[$keys[$idx]]['text']);
                            if (strpos('<p>', $desc) === false) {
                                $desc = '<p>' . $desc . '</p>';
                            }
                            $myCauseMediaLang = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMediaLang');
                            $myCauseMediaLang
                                ->setCaumId($myCauseMedia->getCaumId())
                                ->setLangId($langEN)
                                ->setCamlSubject($partsEN[$keys[$idx]]['subject'])
                                ->setCamlText($desc)
                            ;
                            if (!$myCauseMediaLang->create()) {
                                var_export($myCauseMediaLang);die;
                            }
                        }
                        $idx--;
                    }
                }
                //
                $tabGibbons[$row->Numero_gibbon] = $myCause;
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des Membres
         */
        $tabMembres = [];
        $updates    = [];
        $p_output->write("Import des Membres", true);
        try {
            $query = $provider->prepare("Select * from membres order by id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myClient = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                $myClient->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $name = trim($row->nom);
                if ($name == '') {
                    $name = 'membre ' . $row->id;
                    echo 'Membre ' . $row->id . ' sans nom' . PHP_EOL;
                } else {
                    $name = \FreeFW\Tools\Encoding::toUTF8($name);
                    $name = \FreeFW\Tools\Encoding::fixUTF8($name);
                    $name = \FreeFW\Tools\PBXString::clean($name);
                }
                $pren = trim($row->prenom);
                $pren = \FreeFW\Tools\Encoding::toUTF8($pren);
                $pren = \FreeFW\Tools\Encoding::fixUTF8($pren);
                $pren = \FreeFW\Tools\PBXString::clean($pren);
                $ville = trim($row->ville);
                $ville = \FreeFW\Tools\Encoding::toUTF8($ville);
                $ville = \FreeFW\Tools\Encoding::fixUTF8($ville);
                $ville = \FreeFW\Tools\PBXString::clean($ville);
                $email = $row->email;
                if ($row->old_email != '') {
                    if ($email == '') {
                        $email = $row->old_email;
                    }
                }
                $myClient
                    ->setCliExternId($row->id)
                    ->setCliFirstname($pren)
                    ->setCliLastname($name)
                    ->setClitId($myTypeMembre->getClitId())
                    ->setCliCp($row->code_postal)
                    ->setCliTown($ville)
                    ->setCliPhoneHome($row->tel1)
                    ->setCliPhoneGsm($row->tel2)
                    ->setCliEmail($email)
                    ->setCliEmailRefused($row->old_email)
                    ->setCliReceipt($row->recu)
                    ->setCliCertificat(true)
                    ->setCliDisplaySite(true)
                    ->setCliSendNews(true)
                ;
                $queryAmi = $provider->prepare("Select * from les_amis where id_membre = " . $row->id . " order by date_debut desc");
                $queryAmi->execute();
                while ($rowAmi = $queryAmi->fetch(\PDO::FETCH_OBJ)) {
                    if ($rowAmi->afficher_nom_parrain != '1') {
                        $myClient->setCliDisplaySite(false);
                    }
                    if ($rowAmi->recevoir_nouvelle_adoption != '1') {
                        $myClient->setCliSendNews(false);
                    }
                    break;
                }
                if ($row->commentaires != '') {
                    $comment = \FreeFW\Tools\Encoding::toUTF8($row->commentaires);
                    $comment = \FreeFW\Tools\Encoding::fixUTF8($comment);
                    $comment = \FreeFW\Tools\PBXString::clean($comment);
                    $myClient->setCliDesc('<p>' . $comment . '</p>');
                }
                $address = trim(\FreeFW\Tools\Encoding::toUTF8($row->adresse));
                $address = \FreeFW\Tools\Encoding::fixUTF8($address);
                $address = \FreeFW\Tools\PBXString::clean($address);
                $addresses = explode("\n", $address);
                if (count($addresses) > 0) {
                    $myClient->setCliAddress1(trim($addresses[0]));
                    array_shift($addresses);
                }
                if (count($addresses) > 0) {
                    $myClient->setCliAddress2(trim($addresses[0]));
                    array_shift($addresses);
                }
                if (count($addresses) > 0) {
                    $myClient->setCliAddress3(trim(implode(' ', $addresses)));
                }
                if (array_key_exists($row->id_type, $tabClientCategory)) {
                    $myClient->setClicId($tabClientCategory[$row->id_type]);
                } else {
                    $myClient->setClicId($tabClientCategory['default']);
                }
                if (array_key_exists($row->pays_id, $tabPays)) {
                    $myClient->setCntyId($tabPays[$row->pays_id]->getCntyId());
                } else {
                    $myClient->setCntyId($tabPays['default']->getCntyId());
                }
                if (array_key_exists($row->lang_parle_id, $tabLangues)) {
                    $myClient->setLangId($tabLangues[$row->lang_parle_id]);
                } else {
                    $myClient->setLangId($tabLangues['default']);
                }
                if (!$myClient->create()) {
                    var_export($myClient->getErrors());die;
                }
                if (intval($row->parraine_par) > 0) {
                    $updates[$row->id] = $row->parraine_par;
                }
                $tabMembres[$row->id] = $myClient;
            }
            foreach($updates as $new => $old) {
                $myUpdate = $tabMembres[$new];
                if (array_key_exists($old, $tabMembres)) {
                    $myUpdate->setCliSponsorId($tabMembres[$old]->getCliId());
                    $myUpdate->save();
                }
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        /**
         * Import des dons réguliers
         */
        $tabAmis = [];
        $p_output->write("Import des Amis", true);
        try {
            $query = $provider->prepare("Select * from les_amis order by date_debut desc");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $sponsors = [];
                if ($row->invites != '') {
                    $list = explode(';##', $row->invites);
                    foreach ($list as $idx => $oneS) {
                        $parts = explode(';#', $oneS);
                        if ($parts[0] != '') {
                            $name  = str_replace([';','#'], '', $parts[0]);
                            $email = str_replace([';','#'], '', $parts[1]);
                            $sponsors[] = '{"name":"' . $name . '","email":"' . $email . '"}';
                        }
                    }
                }
                $from = \FreeFW\Tools\Date::mysqlToDatetime($row->date_debut);
                $to   = \FreeFW\Tools\Date::mysqlToDatetime($row->date_fin);
                if ($from) {
                    if (intval($from->format('Y')) <= 2020) {
                        $from = \FreeFW\Tools\Date::datetimeToMysql($from);
                    } else {
                        $from = null;
                    }
                }
                if ($to) {
                    if (intval($to->format('Y')) <= 2020) {
                        if (intval($to->format('Y')) > 1980) {
                            $to = \FreeFW\Tools\Date::datetimeToMysql($to);
                        } else {
                            $to = \FreeFW\Tools\Date::getCurrentTimestamp();
                        }
                    } else {
                        $to = null;
                    }
                }
                $mySponsorship = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
                $mySponsorship->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $mySponsorship
                    ->setSpoDisplaySite($row->afficher_nom_parrain)
                    ->setSpoFreq(\FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH)
                    ->setSpoMnt($row->montant)
                    ->setSpoMoney('EUR')
                    ->setSpoFrom($from)
                    ->setSpoTo($to)
                ;
                if (count($sponsors) > 0) {
                    $mySponsorship->setSpoSponsors('[' . implode(',', $sponsors) . ']');
                } else {
                    $mySponsorship->setSpoSponsors(null);
                }
                if (intval($row->id_gibbon) > 0) {
                    if (array_key_exists($row->id_gibbon, $tabGibbons)) {
                        $mySponsorship->setCauId($tabGibbons[$row->id_gibbon]->getCauId());
                    } else {
                        echo 'Pb Gibbon parrainage ' . $row->id_gibbon . ' !' . PHP_EOL;
                        $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                        $myCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                        $myCause
                            ->setCauName('Gibbon ' . $row->id_gibbon)
                            ->setCautId($myCauseGibbon->getCautId())
                            ->setCauPublic(0)
                            ->setCauAvailable(0)
                            ->setSiteId($myIleAutre->getSiteId())
                        ;
                        if (!$myCause->create()) {
                            var_export($myCause->getErrors());die;
                        }
                        $tabGibbons[$row->id_gibbon] = $myCause;
                        $mySponsorship->setCauId($tabGibbons[$row->id_gibbon]->getCauId());
                    }
                } else {
                    $mySponsorship->setCauId($myCauseKalaweit->getCauId());
                }
                if (intval($row->Type_reglement_Id) > 0) {
                    if (array_key_exists($row->Type_reglement_Id, $tabTypePay)) {
                        $mySponsorship->setPtypId($tabTypePay[$row->Type_reglement_Id]);
                    } else {
                        echo 'Pb type de règlement ' . $row->id_ligne_amis . ' !' . PHP_EOL;
                    }
                }
                if (array_key_exists($row->id_membre, $tabMembres)) {
                    $mySponsorship->setCliId($tabMembres[$row->id_membre]->getCliId());
                } else {
                    echo 'Member not found : ' . $row->id_membre . ', ' . $row->id_ligne_amis . ' !' . PHP_EOL;
                    $myClient = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                    $myClient->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                    $myClient
                        ->setCliExternId($row->id_membre)
                        ->setCliLastname('Membre ' . $row->id_membre)
                        ->setClitId($myTypeMembre->getClitId())
                        ->setClicId($tabClientCategory['default'])
                        ->setCliCertificat(1)
                    ;
                    if (!$myClient->create()){
                        var_export($myClient->getErrors());die;
                    }
                    $tabMembres[$row->id_membre] = $myClient;
                    $mySponsorship->setCliId($tabMembres[$row->id_membre]->getCliId());
                }
                if (!$mySponsorship->create()) {
                    var_export($mySponsorship->getErrors());die;
                }
                $tabAmis[$row->id_ligne_amis] = $mySponsorship;
            }
        } catch (\Exception $ex) {
            var_export($ex);die;
        }
        /**
         * Import des générations de prélèvement
         */
        $tabDonationOrigins = [];
        $p_output->write("Import des générations de dons", true);
        try {
            $query = $provider->prepare("Select * from prelevements");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $comments = $row->prlv_anomalies;
                $myDonationOrigin = \FreeFW\DI\DI::get('FreeAsso::Model::DonationOrigin');
                $myDonationOrigin
                    ->setDonoTs($row->prlv_ts)
                    ->setDonoYear($row->prlv_annee)
                    ->setDonoMonth($row->prlv_mois)
                    ->setDonoDay(1)
                    ->setDonoStatus($row->prlv_status)
                    ->setDonoComments($comments)
                ;
                if (!$myDonationOrigin->create()) {
                    var_export($myDonationOrigin->getErrors());die;
                }
                $tabDonationOrigins[$row->prlv_id] = $myDonationOrigin;
            }
        } catch (\Exception $ex) {
            var_export($ex);die;
        }
        /**
         * Import des en-têtes de reçus
         */
        $tabTypesRecus = [];
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type adhésion')
            ->setRettRegex('ADH[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['ADH'] = $myReceiptType;
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type ami')
            ->setRettRegex('AM[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['AM'] = $myReceiptType;
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type don ponctuel')
            ->setRettRegex('D[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['D'] = $myReceiptType;
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type parrainage ponctuel')
            ->setRettRegex('P[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['P'] = $myReceiptType;
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type autre')
            ->setRettRegex('O[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['O'] = $myReceiptType;
        $myReceiptType = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptType');
        $myReceiptType
            ->setRettName('Type manuel')
            ->setRettRegex('M[[:number:]]')
        ;
        if (!$myReceiptType->create()) {
            var_export($myReceiptType->getErrors());die;
        }
        $tabTypesRecus['M'] = $myReceiptType;
        $tabReceipts = [];
        $p_output->write("Import des reçus fiscaux", true);
        try {
            $query = $provider->prepare("Select * from recus_fiscaux order by id_recus_fiscaux");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myReceipt = \FreeFW\DI\DI::get('FreeAsso::Model::Receipt');
                $myReceipt->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $myReceipt->setRettId($tabTypesRecus['O']->getRettId());
                if (strpos($row->numero, 'ADH') !== false) {
                    $myReceipt->setRettId($tabTypesRecus['ADH']->getRettId());
                }
                if (strpos($row->numero, 'AM') !== false) {
                    $myReceipt->setRettId($tabTypesRecus['AM']->getRettId());
                }
                if (strpos($row->numero, 'D') !== false) {
                    $myReceipt->setRettId($tabTypesRecus['D']->getRettId());
                }
                if (strpos($row->numero, 'P') !== false) {
                    $myReceipt->setRettId($tabTypesRecus['P']->getRettId());
                }
                if (array_key_exists($row->id_membre, $tabMembres)) {
                    $myReceipt
                        ->setCliId($tabMembres[$row->id_membre]->getCliId())
                        ->setRecEmail($tabMembres[$row->id_membre]->getCliEmail())
                    ;
                } else {
                    echo 'Member not found : ' . $row->id_membre . ' !' . PHP_EOL;
                    $myClient = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                    $myClient->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                    $myClient
                        ->setCliExternId($row->id_membre)
                        ->setCliLastname('Membre ' . $row->id_membre)
                        ->setClitId($myTypeMembre->getClitId())
                        ->setClicId($tabClientCategory['default'])
                        ->setCliCertificat(1)
                    ;
                    if (!$myClient->create()){
                        var_export($myClient->getErrors());die;
                    }
                    $tabMembres[$row->id_membre] = $myClient;
                    $myReceipt->setCliId($tabMembres[$row->id_membre]->getCliId());
                }
                $fullname = $row->nom_membre;
                $fullname = \FreeFW\Tools\Encoding::toUTF8($fullname);
                $fullname = \FreeFW\Tools\Encoding::fixUTF8($fullname);
                $fullname = \FreeFW\Tools\PBXString::clean($fullname);
                $myReceipt->setRecFullname($fullname);
                $address = $row->adresse_membre;
                $address = html_entity_decode($address);
                $address = str_replace("<br />", "\n", $address);
                $address = str_replace("<br/>", "\n", $address);
                $address = str_replace("<br>", "\n", $address);
                $address = \FreeFW\Tools\Encoding::toUTF8($address);
                $address = \FreeFW\Tools\Encoding::fixUTF8($address);
                $address = \FreeFW\Tools\PBXString::clean($address);
                $parts = explode("\n", $address);
                $myReceipt->setRecAddress1($parts[0]);
                if (count($parts) > 1) {
                    $myReceipt->setRecAddress2($parts[1]);
                }
                if (count($parts) > 2) {
                    $myReceipt->setRecAddress3($parts[2]);
                }
                $myReceipt->setRecCp($row->code_postale_membre);
                $town = $row->ville_membre;
                $town = \FreeFW\Tools\Encoding::toUTF8($town);
                $town = \FreeFW\Tools\Encoding::fixUTF8($town);
                $town = \FreeFW\Tools\PBXString::clean($town);
                $myReceipt->setRecTown($town);
                $pays  = $row->pays_membre_fr;
                $found = false;
                foreach ($tabPays as $idx => $country) {
                    if (strtoupper($country->getCntyName()) == strtoupper($pays)) {
                        $myReceipt->setCntyId($tabPays[$idx]->getCntyId());
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    echo 'Receipt ' . $row->id_recus_fiscaux . ' country not found !' . PHP_EOL;
                    $myReceipt->setCntyId($tabPays['default']->getCntyId());
                }
                if (array_key_exists($row->id_langue_parle, $tabLangues)) {
                    $myReceipt->setLangId($tabLangues[$row->id_langue_parle]);
                } else {
                    $myReceipt->setLangId($tabLangues['default']);
                }
                $myReceipt
                    ->setRecTs($row->date_emission)
                    ->setRecGenTs($row->date_emission)
                    ->setRecPrintTs($row->date_emission)
                    ->setRecMoney('EUR')
                    ->setRecMode('AUTO')
                    ->setRecSendMethod('MANUAL')
                    ->setRecYear($row->annee)
                    ->setRecNumber($row->numero)
                    ->setRecMnt($row->montant)
                ;
                if (intval($row->email_membre) > 0) {
                    $myReceipt->setRecSendMethod('EMAIL');
                }
                if ($row->id_langue_parle == '1' || $row->id_langue_parle == '0') {
                    $myReceipt->setRecMntLetter($row->montant_lettre_fr);
                } else {
                    $myReceipt->setRecMntLetter($row->montant_lettre_en);
                }
                if (!$myReceipt->create()) {
                    var_export($myReceipt->getErrors());die;
                }
                $tabReceipts[$row->id_recus_fiscaux] = $myReceipt->getRecId();
            }
        } catch (\Exception $ex) {
            var_export($ex);die;
        }
        /**
         * Import des dons
         */
        $tabSessions = [];
        $tabEntrees  = [];
        $p_output->write("Import des dons", true);
        try {
            $query = $provider->prepare("Select * from entrees order by id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                echo '.';
                $sponsors = [];
                if ($row->invites != '') {
                    $list = explode(';##', $row->invites);
                    foreach ($list as $idx => $oneS) {
                        $parts = explode(';#', $oneS);
                        if ($parts[0] != '') {
                            $name  = str_replace([';','#'], '', $parts[0]);
                            $email = str_replace([';','#'], '', $parts[1]);
                            $sponsors[] = '{"name":"' . $name . '","email":"' . $email . '"}';
                        }
                    }
                }
                // @TODO grp_id
                $myDonation = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                $myDonation->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                $myDonation
                    ->setDonStatus(\FreeAsso\Model\Donation::STATUS_NOK)
                    ->setGrpId(3)
                    ->setDonMnt($row->montant)
                    ->setDonMoney('EUR')
                    ->setDonMntInput($row->montant)
                    ->setDonMoneyInput('EUR')
                    ->setDonDisplaySite(0)
                ;
                if (count($sponsors) > 0) {
                    $myDonation->setDonSponsors('[' . implode(',', $sponsors) . ']');
                } else {
                    $myDonation->setDonSponsors(null);
                }
                $ts = \FreeFW\Tools\Date::mysqlToDatetime($row->date_entree);
                $year = 2020;
                if ($ts) {
                    $year = $ts->format('Y');
                    if (intval($ts->format('Y')) <= 2020) {
                        $ts = \FreeFW\Tools\Date::datetimeToMysql($ts);
                    } else {
                        var_export('Erreur ts !');
                        continue;
                    }
                } else {
                    var_export('Erreur ts !');
                    continue;
                }
                if (!array_key_exists($year, $tabSessions)) {
                    $mySession = \FreeFW\DI\DI::get('FreeAsso::Model::Session');
                    $mySession
                        ->setSessName('Année ' . $year)
                        ->setSessExercice($year)
                        ->setSessStatus('CLOSED')
                    ;
                    if ($year == '2020') {
                        $mySession->setSessStatus('OPEN');
                    }
                    if (!$mySession->create()) {
                        var_export($mySession->getErrors());die;
                    }
                    $tabSessions[$year] = $mySession;
                }
                $realTs = null;
                if ($row->date_parrainage != '') {
                    $realTs = \FreeFW\Tools\Date::mysqlToDatetime($row->date_parrainage);
                    $realTs = \FreeFW\Tools\Date::datetimeToMysql($realTs);
                } else {
                    $realTs = $ts;
                }
                $endTs = null;
                if ($row->date_fin != '') {
                    $endTs = \FreeFW\Tools\Date::mysqlToDatetime($row->date_fin);
                    $endTs = \FreeFW\Tools\Date::datetimeToMysql($endTs);
                }
                $myDonation
                    ->setDonTs($ts)
                    ->setDonAskTs($realTs)
                    ->setDonRealTs($realTs)
                    ->setDonEndTs($endTs)
                    ->setSessId($tabSessions[$year]->getSessId())
                ;
                if ($row->etat_paiement == '1') {
                    $myDonation
                        ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
                    ;
                }
                if ($row->commentaire != '') {
                    $comment = \FreeFW\Tools\Encoding::toUTF8($row->commentaire);
                    $comment = \FreeFW\Tools\Encoding::fixUTF8($address);
                    $comment = \FreeFW\Tools\PBXString::clean($address);
                    $myDonation->setDonComment('<p>' . $comment . '</p>');
                }
                if (intVal($row->id_prelevement) > 1) {
                    $myDonationOrigin = $tabDonationOrigins[$row->id_prelevement];
                    $myDonation->setDonoId($myDonationOrigin->getDonoId());
                }
                if (intval($row->id_adoption) > 0) {
                    if (array_key_exists($row->id_adoption, $tabGibbons)) {
                        $myDonation->setCauId($tabGibbons[$row->id_adoption]->getCauId());
                    } else {
                        echo 'Pb Gibbon don : ' . $row->id_adoption . ' !' . PHP_EOL;
                        $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                        $myCause->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                        $myCause
                            ->setCauName('Gibbon ' . $row->id_adoption)
                            ->setCautId($myCauseGibbon->getCautId())
                            ->setCauPublic(0)
                            ->setCauAvailable(0)
                            ->setSiteId($myIleAutre->getSiteId())
                        ;
                        if (!$myCause->create()) {
                            var_export($myCause->getErrors());die;
                        }
                        $tabGibbons[$row->id_adoption] = $myCause;
                        $myDonation->setCauId($tabGibbons[$row->id_adoption]->getCauId());
                    }
                } else {
                    $myDonation->setCauId($myCauseKalaweit->getCauId());
                    $typeE = $row->type_entree;
                    if ($typeE == '12' || $typeE == '14') {
                        $myDonation->setCauId($myCauseForet->getCauId());
                    }
                    if ($typeE == '15') {
                        $myDonation->setCauId($myCauseDulan->getCauId());
                    }
                }
                if (intval($row->id_methode_paiement) >= 0) {
                    if (array_key_exists($row->id_methode_paiement, $tabTypePay)) {
                        $myDonation->setPtypId($tabTypePay[$row->id_methode_paiement]);
                    } else {
                        var_export('Pb type de règlement ' . $row->id_methode_paiement . ' !');
                    }
                }
                switch (intval($row->origine)) {
                    case 2:
                        $myDonation->setPtypId($TypHelloAsso);
                        break;
                    case 3:
                        $myDonation->setPtypId($TypAlvarum);
                        break;
                    case 4:
                        $myDonation->setPtypId($TypFacebook);
                        break;
                }
                if (array_key_exists($row->id_membre, $tabMembres)) {
                    $myDonation->setCliId($tabMembres[$row->id_membre]->getCliId());
                } else {
                    echo 'Member not found : ' . $row->id_membre . ' !' . PHP_EOL;
                    $myClient = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                    $myClient->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                    $myClient
                        ->setCliExternId($row->id_membre)
                        ->setCliLastname('Membre ' . $row->id_membre)
                        ->setClitId($myTypeMembre->getClitId())
                        ->setClicId($tabClientCategory['default'])
                        ->setCliCertificat(1)
                    ;
                    if (!$myClient->create()){
                        var_export($myClient->getErrors());die;
                    }
                    $tabMembres[$row->id_membre] = $myClient;
                    $myDonation->setCliId($tabMembres[$row->id_membre]->getCliId());
                }
                if (intval($row->afficher_nom_parrain) > 0) {
                    $myDonation->setDonDisplaySite(1);
                }
                if (intval($row->id_ligne_amis) > 0) {
                    if (array_key_exists($row->id_ligne_amis, $tabAmis)) {
                        $myDonation->setSpoId($tabAmis[$row->id_ligne_amis]->getSpoId());
                    } else {
                        echo 'Ami not found : ' . $row->id_ligne_amis . ' !' . PHP_EOL;
                        continue;
                    }
                }
                if (!$myDonation->create()) {
                    var_export($row);
                    var_export($myDonation->getErrors());die;
                }
                $tabEntrees[$row->id] = $myDonation;
                // Vérification et enregistrement du certificat
                if ($row->id_certificat > 0) {
                    $queryCert = $provider->prepare("Select * from certificats where id_certificat = " . $row->id_certificat);
                    $queryCert->execute();
                    while ($rowCert = $queryCert->fetch(\PDO::FETCH_OBJ)) {
                        echo '.';
                        $member = $tabMembres[$row->id_membre];
                        $fullname = $rowCert->nom;
                        $fullname = \FreeFW\Tools\Encoding::toUTF8($fullname);
                        $fullname = \FreeFW\Tools\Encoding::fixUTF8($fullname);
                        $fullname = \FreeFW\Tools\PBXString::clean($fullname);
                        $myCertificate = \FreeFW\DI\DI::get('FreeAsso::Model::Certificate');
                        $myCertificate->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                        $myCertificate
                            ->setCliId($member->getCliId())
                            ->setLangId($member->getLangId())
                            ->setCertFullname($fullname)
                            ->setCertEmail($rowCert->email)
                            ->setCntyId($member->getCntyId())
                            ->setCertAddress1($member->getCliAddress1())
                            ->setCertAddress2($member->getCliAddress2())
                            ->setCertAddress3($member->getCliAddress3())
                            ->setCertCp($member->getCliCp())
                            ->setCertTown($member->getCliTown())
                            ->setCertInputMnt($rowCert->montant)
                            ->setCertInputMoney('EUR')
                            ->setCertOutputMnt($rowCert->montant_roupies)
                            ->setCertOutputMoney('IDR')
                            ->setCertData1($rowCert->surface_calcul)
                        ;
                        if ($rowCert->date_send != '') {
                            $myCertificate->setCertPrintTs($rowCert->date_send);
                        }
                        if ($rowCert->date_emission != '') {
                            $myCertificate->setCertGenTs($rowCert->date_emission);
                        }
                        if ($rowCert->date_calcul != '') {
                            $myCertificate->setCertTs($rowCert->date_calcul);
                        }
                        if (!$myCertificate->create()) {
                            var_export($rowCert);
                            var_export($myCertificate->getErrors());die;
                        }
                        $myDonation->setCertId($myCertificate->getCertId());
                        if (!$myDonation->save()) {
                            var_export($myDonation->getErrors());die;
                        }
                        break;
                    }
                }
                $queryRecu = $provider->prepare("Select * from recus_fiscaux_entrees where id_entrees = " . $row->id);
                $queryRecu->execute();
                while ($rowRecu = $queryRecu->fetch(\PDO::FETCH_OBJ)) {
                    echo '.';
                    if (array_key_exists($rowRecu->id_recus_fiscaux, $tabReceipts)) {
                        $myReceiptDonation = \FreeFW\DI\DI::get('FreeAsso::Model::ReceiptDonation');
                        $myReceiptDonation->setModelBehaviour(\FreeFW\Core\Model::MODEL_BEHAVIOUR_RAW);
                        $myReceiptDonation
                            ->setDonId($myDonation->getDonId())
                            ->setRecid($tabReceipts[$rowRecu->id_recus_fiscaux])
                            ->setRdoTs($myDonation->getDonTs())
                            ->setRdoMnt($myDonation->getDonMnt())
                            ->setRdoMoney($myDonation->getDonMoney())
                            ->setPtypId($myDonation->getPtypId())
                        ;
                        $desc = null;
                        if (intval($row->id_adoption) > 0) {
                            if (array_key_exists($row->id_adoption, $tabGibbons)) {
                                $desc = $tabGibbons[$row->id_adoption]->getCauName();
                            } else {
                                echo 'Gibbon id ' . $row->id_adoption . ' non trouvé !' . PHP_EOL;
                            }
                        } else {
                            $typeE = $row->type_entree;
                            if ($typeE == '12' || $typeE == '14') {
                                $desc = 'Forêt';
                            }
                            if ($typeE == '15') {
                                $desc = 'Dulan';
                            }
                        }
                        $myReceiptDonation->setRdoDesc($desc);
                        if (!$myReceiptDonation->create()) {
                            var_export($myReceiptDonation->getErrors());die;
                        }
                    } else {
                        echo 'Reçu fiscal introuvable pour le reçu ' . $row->id . ' !' . PHP_EOL;
                    }
                }
            }
        } catch (\Exception $ex) {
            var_export($ex);die;
        }
        /**
         *
         */
        $p_output->write("Fin de l'import", true);
    }
}
