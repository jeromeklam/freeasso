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
     * Import data
     *
     * @param \FreeFW\Console\Input\Input $p_input
     */
    public function import(
        \FreeFW\Console\Input\AbstractInput $p_input,
        \FreeFW\Console\Output\AbstractOutput $p_output
    ) {
        $p_output->write("Début de l'import", true);
        $provider = new \FreeFW\Storage\PDO\Mysql('mysql:host=mysql;dbname=kalaweit;charset=latin1;', 'super', 'YggDrasil');
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $assoPdo = $storage->getProvider();
        /**
         * Nettoyage
         */
        $p_output->write("Nettoyage", true);
        $query = $assoPdo->exec("UPDATE asso_cause SET parent1_cau_id = null, parent2_cau_id = null WHERE  brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_media WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_donation WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_sponsorship WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_main_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_data WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_config WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_payment_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_category WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM crm_client_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM core_country");
        $query = $assoPdo->exec("DELETE FROM core_lang");
        /**
         * Paramètres de base
         */
        $p_output->write("Import des Paramètres", true);
        // Motif d'arrêt d'une cause
        $myDataMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataMotif
            ->setDataName("Motif d'arrêt")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('[{"value":"Mort", "label":"Mort"}, {"value":"Libéré", "label":"Libéré"}, {"value":"Autre", "label":"Autre"}]')
        ;
        if (!$myDataMotif->create()) {
            var_export($myDataMotif->getErrors());die;
        }
        // Année de naissance
        $myDataDnai = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataDnai
            ->setDataName("Année de naissance")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        if (!$myDataDnai->create()) {
            var_export($myDataDnai->getErrors());die;
        }
        // Config 4
        $myCfgMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgMotif
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAU_STRING_3)
            ->setAcfgValue($myDataMotif->getDataId())
        ;
        if (!$myCfgMotif->create()) {
            var_export($myCfgMotif->getErrors());die;
        }
        // Config 5
        $myCfgDnai = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgDnai
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAU_NUMBER_1)
            ->setAcfgValue($myDataDnai->getDataId())
        ;
        if (!$myCfgDnai->create()) {
            var_export($myCfgDnai->getErrors());die;
        }
        // Site Ile
        $mySiteType = \FreeFW\DI\DI::get('FreeAsso::Model::SiteType');
        $mySiteType
            ->setSittName("Ile")
        ;
        if (!$mySiteType->create()) {
            var_export($mySiteType->getErrors());die;
        }
        // Bornéo
        $myIleBorneo = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleBorneo
            ->setSiteName("Bornéo")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleBorneo->create()) {
            var_export($myIleBorneo->getErrors());die;
        }
        // Sumatra
        $myIleSumatra = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleSumatra
            ->setSiteName("Sumatra")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleSumatra->create()) {
            var_export($myIleSumatra->getErrors());die;
        }
        // Autre
        $myIleAutre = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleAutre
            ->setSiteName("Autre")
            ->setSittId($mySiteType->getSittId())
        ;
        if (!$myIleAutre->create()) {
            var_export($myIleAutre->getErrors());die;
        }
        // Grandes causes
        $myGibbonCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myGibbonCause->setCamtName('Gibbons');
        $myGibbonCause->create();
        $myForestCause = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMainType');
        $myForestCause->setCamtName('Forêt');
        $myForestCause->create();
        // Causes Gibbon
        $tabCausesGibbon = [];
        $myCauseGibbon = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseGibbon
            ->setCautName('Gibbon')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL)
            ->setCautMaxMnt(360)
            ->setCautMinMnt(0)
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
        try {
            $query = $provider->prepare("Select * from especes_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myCauseGibbon = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
                $myCauseGibbon
                    ->setCautName(utf8_encode($row->Especes_nom_francais) . ' (' . $row->Especes_nom_latin . ')')
                    ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL)
                    ->setCautMaxMnt(360)
                    ->setCautMinMnt(0)
                    ->setCautReceipt(1)
                    ->setCautString_2(1)
                    ->setCautString_3(1)
                    ->setCautText_1(1)
                    ->setCamtId($myGibbonCause->getCamtId())
                ;
                if (!$myCauseGibbon->create()) {
                    var_export($myCauseGibbon->getErrors());die;
                }
                $tabCausesGibbon[$row->Especes_Id] = $myCauseGibbon->getCautId();
            }
        } catch (\PDOException $ex) {
            var_export($ex);die;
        }
        // Cause Forêt
        $myCauseTForet = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseTForet
            ->setCautName('Forêt')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautText_1(1)
            ->setCamtId($myForestCause->getCamtId())
        ;
        if (!$myCauseTForet->create()) {
            var_export($myCauseTForet->getErrors());die;
        }
        $myCauseForet = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $myCauseForet
            ->setCauName('Forêt')
            ->setCautId($myCauseTForet->getCautId())
            ->setSiteId($myIleBorneo->getSiteId())
            ->setCauDesc(null)
            ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_FOREST)
            ->setCauPublic(0)
            ->setCauAvailable(0)
        ;
        if (!$myCauseForet->create()) {
            var_export($myCauseForet->getErrors());die;
        }
        // Cause Dulan
        $myCauseTDulan = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseTDulan
            ->setCautName('Dulan')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautText_1(1)
            ->setCamtId($myForestCause->getCamtId())
        ;
        if (!$myCauseTDulan->create()) {
            var_export($myCauseTDulan->getErrors());die;
        }
        $myCauseDulan = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
        $myCauseDulan
            ->setCauName('Dulan')
            ->setCautId($myCauseTDulan->getCautId())
            ->setSiteId($myIleBorneo->getSiteId())
            ->setCauDesc(null)
            ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_FOREST)
            ->setCauPublic(0)
            ->setCauAvailable(0)
        ;
        if (!$myCauseDulan->create()) {
            var_export($myCauseDulan->getErrors());die;
        }
        // Type de client 
        $myTypeMembre = \FreeFW\DI\DI::get('FreeAsso::Model::ClientType');
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
                $myLang = \FreeFW\DI\DI::get('FreeFW::Model::Lang');
                $myLang->setLangName($row->lang_parle);
                if (!$myLang->create()) {
                    $myLang->flushErrors();
                    $myLang->setLangName(utf8_encode($row->lang_parle));
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
                $lib  = utf8_encode($row->Type_reglement_Libelle);
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
                $myCountry = \FreeFW\DI\DI::get('FreeFW::Model::Country');
                $myCountry->setCntyName($row->Pays_nom);
                if (!$myCountry->create()) {
                    var_export($myCountry->getErrors());die;
                }
                $tabPays[$row->Pays_id] = $myCountry->getCntyId();
                if ($row->Pays_nom == 'France') {
                    $tabPays['default'] = $myCountry->getCntyId();
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
            $query = $provider->prepare("Select * from type_membre_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myClientCategory = \FreeFW\DI\DI::get('FreeAsso::Model::ClientCategory');
                $myClientCategory->setClicName(utf8_encode($row->type_membre));
                if (!$myClientCategory->create()) {
                    var_export($myClientCategory->getErrors());die;
                }
                $tabClientCategory[$row->type_membre] = $myClientCategory->getClicId();
                if ($row->id_type_membre == 0) {
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
            $query = $provider->prepare("Select * from gibbons");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                /*its getting data in line.And its an object*/
                $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                $myCause
                    ->setCauName(utf8_encode($row->Nom_gibbon))
                    ->setCautId($myCauseGibbon->getCautId())
                    ->setCauDesc($row->Details)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
                    ->setCauPublic(0)
                    ->setCauAvailable(0)
                ;
                if ($myCause->getCauName() == '') {
                    $myCause->setCauName('Sans nom');
                }
                if (intval($row->Annee_naissance) > 0) {
                    $myCause->setCauNumber_1(intval($row->Annee_naissance));
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
                
                if (array_key_exists($row->Espece, $tabCausesGibbon)) {
                    $myCause->setCautId($tabCausesGibbon[$row->Espece]);
                } else {
                    $myCause->setCautId($tabCausesGibbon['default']);
                }
                if (strtolower($row->site) == 'oui') {
                    $myCause->setCauPublic(1);
                }
                if (strtolower($row->adoption) == 'oui') {
                    $myCause->setCauAvailable(1);
                }
                if (strtolower($row->Gibbon_libere) == 'oui') {
                    $myCause->setCauString_3('Libéré');
                }
                if (strtolower($row->Gibbon_mort) == 'oui') {
                    $myCause->setCauString_3('Mort');
                }
                if (strtolower($row->Date_mort) != '') {
                    if ($row->Date_mort != '0000-00-00') {
                        $myCause->setCauTo($row->Date_mort);
                    } else {
                        $myCause->setCauTo(\FreeFW\Tools\Date::getCurrentTimestamp());
                    }
                }
                if (!$myCause->create()) {
                    $myCause->flushErrors();
                    $myCause->setCauDesc(utf8_encode($row->Details));
                    if (!$myCause->create()) {
                        var_export($myCause->getErrors());die;
                    }
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
                        var_export($file . ' not found !');
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
                        var_export($file . ' not found !');
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
            $query = $provider->prepare("Select * from membres");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myClient = \FreeFW\DI\DI::get('FreeAsso::Model::Client');
                $myClient
                    ->setCliExternId($row->id)
                    ->setCliFirstname($row->prenom)
                    ->setCliLastname($row->nom)
                    ->setClitId($myTypeMembre->getClitId())
                    ->setCliCp($row->code_postal)
                    ->setCliTown($row->ville)
                    ->setCliPhoneHome($row->tel1)
                    ->setCliPhoneGsm($row->tel2)
                    ->setCliEmail($row->email)
                    ->setCliEmailOld($row->old_email)
                    ->setCliReceipt($row->recu)
                    ->setCliCertificat(1)
                ;
                if ($row->commentaires != '') {
                    $myClient->setCliDesc('<p>' . utf8_encode($row->commentaires) . '</p>');
                }
                $addresses = explode("\n", $row->adresse);
                if (count($addresses) > 0) {
                    $myClient->setCliAddress1($addresses[0]);
                    array_shift($addresses);
                }
                if (count($addresses) > 0) {
                    $myClient->setCliAddress2($addresses[0]);
                    array_shift($addresses);
                }
                if (count($addresses) > 0) {
                    $myClient->setCliAddress3(implode(' ', $addresses));
                }
                if (array_key_exists($row->id_type, $tabClientCategory)) {
                    $myClient->setClicId($tabClientCategory[$row->id_type]);
                } else {
                    $myClient->setClicId($tabClientCategory['default']);
                }
                if (array_key_exists($row->pays_id, $tabPays)) {
                    $myClient->setCntyId($tabPays[$row->pays_id]);
                } else {
                    $myClient->setCntyId($tabPays['default']);
                }
                if (array_key_exists($row->lang_parle_id, $tabLangues)) {
                    $myClient->setLangId($tabLangues[$row->lang_parle_id]);
                } else {
                    $myClient->setLangId($tabLangues['default']);
                }
                if (!$myClient->create()) {
                    $myClient->flushErrors();
                    $myClient->setCliDesc(null);
                    var_export($row);
                    if (!$myClient->create()) {
                        var_export($myClient->getErrors());
                    }
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
            $query = $provider->prepare("Select * from les_amis");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $sponsors = [];
                if ($row->invites != '') {
                    $list = explode(',##', $row->invites);
                    foreach ($list as $idx => $oneS) {
                        $parts = explode(';#', $oneS);
                        if ($parts[0] != '') {
                            $name  = $parts[0];
                            $email = $parts[1];
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
                $mySponsorship
                    ->setSpoDisplaySite($row->afficher_nom_parrain)
                    ->setSpoSponsors($sponsors)
                    ->setSpoFreq(\FreeAsso\Model\Sponsorship::PAYMENT_TYPE_MONTH)
                    ->setSpoMnt($row->montant)
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
                        var_export('Pb Gibbon ' . $row->id_gibbon . ' !');
                    }
                }
                if (intval($row->Type_reglement_Id) > 0) {
                    if (array_key_exists($row->Type_reglement_Id, $tabTypePay)) {
                        $mySponsorship->setPtypId($tabTypePay[$row->Type_reglement_Id]);
                    } else {
                        var_export('Pb type de règlement ' . $row->id_ligne_amis . ' !');
                    }
                }
                if (array_key_exists($row->id_membre, $tabMembres)) {
                    $mySponsorship->setCliId($tabMembres[$row->id_membre]->getCliId());
                } else {
                    var_export('Member not found : ' . $row->id_membre . ' !');
                    continue;
                }
                if (!$mySponsorship->create()) {
                    var_export($mySponsorship->getErrors());
                }
                $tabAmis[$row->id_ligne_amis] = $mySponsorship;
            }
        } catch (\Exception $ex) {
            var_export($ex);die;
        }
        //
        /**
         * Import des dons
         */
        $tabEntrees = [];
        $p_output->write("Import des dons", true);
        try {
            $query = $provider->prepare("Select * from entrees");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myDonation = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
                $myDonation
                    ->setDonStatus(\FreeAsso\Model\Donation::STATUS_NOK)
                    ->setDonMnt($row->montant)
                    ->setDonDisplaySite(0)
                ;
                $ts = \FreeFW\Tools\Date::mysqlToDatetime($row->date_entree);
                if ($ts) {
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
                $myDonation->setDonTs($ts);
                if ($row->etat_paiement == '1') {
                    $myDonation
                        ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
                    ;
                }
                if ($row->commentaire != '') {
                    $myDonation->setDonComment('<p>' . $row->commentaire . '</p>');
                }
                if (intval($row->id_adoption) > 0) {
                    if (array_key_exists($row->id_adoption, $tabGibbons)) {
                        $myDonation->setCauId($tabGibbons[$row->id_adoption]->getCauId());
                    } else {
                        var_export('Pb Gibbon ' . $row->id_adoption . ' !');
                    }
                } else {
                    $myDonation->setCauId(null);
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
                    var_export('Member not found : ' . $row->id_membre . ' !');
                    continue;
                }
                if (intval($row->afficher_nom_parrain) > 0) {
                    $myDonation->setDonDisplaySite(1);
                }
                if (intval($row->id_ligne_amis) > 0) {
                    if (array_key_exists($row->id_ligne_amis, $tabAmis)) {
                        $myDonation->setSpoId($tabAmis[$row->id_ligne_amis]->getSpoId());
                    } else {
                        var_export('Ami not found : ' . $row->id_ligne_amis . ' !');
                        continue;
                    }
                }
                if (!$myDonation->create()) {
                    var_export($myDonation->getErrors());
                }
                $tabEntrees[$row->id] = $myDonation;
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
