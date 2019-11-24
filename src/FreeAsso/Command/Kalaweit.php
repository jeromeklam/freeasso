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
        $provider = new \FreeFW\Storage\PDO\Mysql('mysql:host=mysql;dbname=kalaweit;charset=utf8;', 'super', 'YggDrasil');
        $sso      = \FreeFW\DI\DI::getShared('sso');
        $brokerId = $sso->getBrokerId();
        $p_output->write("Broker : " . $brokerId, true);
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $assoPdo = $storage->getProvider();
        /**
         * Nettoyage
         */
        $p_output->write("Nettoyage", true);
        $query = $assoPdo->exec("DELETE FROM asso_site WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_cause_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_site_type WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_data WHERE brk_id = " . $brokerId);
        $query = $assoPdo->exec("DELETE FROM asso_config WHERE brk_id = " . $brokerId);
        /**
         * Paramètres de base
         */
        $p_output->write("Import des paramètres", true);
        // Motif d'arrêt d'une cause
        $myDataMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataMotif
            ->setDataName("Motif d'arrêt")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('["Mort", "Libéré", "Autre"]')
        ;
        $myDataMotif->create();
        // Sexe
        $myDataSexe = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataSexe
            ->setDataName("Sexe")
            ->setDataType(\FreeAsso\Model\Data::TYPE_LIST)
            ->setDataContent('["Male", "Femelle"]')
        ;
        $myDataSexe->create();
        // Année de naissance
        $myDataDnai = \FreeFW\DI\DI::get('FreeAsso::Model::Data');
        $myDataDnai
            ->setDataName("Année de naissance")
            ->setDataType(\FreeAsso\Model\Data::TYPE_NUMBER)
        ;
        $myDataDnai->create();
        // Config 2
        $myCfgSexe = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgSexe
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAUT_STRING_2)
            ->setAcfgValue($myDataSexe->getDataId())
        ;
        $myCfgSexe->create();
        // Config 4
        $myCfgMotif = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgMotif
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAUT_STRING_3)
            ->setAcfgValue($myDataMotif->getDataId())
        ;
        $myCfgMotif->create();
        // Config 5
        $myCfgDnai = \FreeFW\DI\DI::get('FreeAsso::Model::Config');
        $myCfgDnai
            ->setAcfgCode(\FreeAsso\Model\Config::CONFIG_CAUT_NUMBER_1)
            ->setAcfgValue($myDataDnai->getDataId())
        ;
        $myCfgDnai->create();
        // Site Ile
        $mySiteType = \FreeFW\DI\DI::get('FreeAsso::Model::SiteType');
        $mySiteType
            ->setSittName("Ile")
        ;
        $mySiteType->create();
        // Bornéo
        $myIleBorneo = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleBorneo
            ->setSiteName("Bornéo")
            ->setSittId($mySiteType->getSittId())
        ;
        $myIleBorneo->create();
        // Sumatra
        $myIleSumatra = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleSumatra
            ->setSiteName("Sumatra")
            ->setSittId($mySiteType->getSittId())
        ;
        $myIleSumatra->create();
        // Autre
        $myIleAutre = \FreeFW\DI\DI::get('FreeAsso::Model::Site');
        $myIleAutre
            ->setSiteName("Autre")
            ->setSittId($mySiteType->getSittId())
        ;
        $myIleAutre->create();
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
        ;
        $myCauseGibbon->create();
        $tabCausesGibbon['default'] = $myCauseGibbon->getCautId();
        try {
            $query = $provider->prepare("Select * from especes_id");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                $myCauseGibbon = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
                $myCauseGibbon
                    ->setCautName($row->Especes_nom_francais . ' (' . $row->Especes_nom_latin . ')')
                    ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL)
                    ->setCautMaxMnt(360)
                    ->setCautMinMnt(0)
                    ->setCautReceipt(1)
                    ->setCautString_2(1)
                    ->setCautString_3(1)
                    ->setCautText_1(1)
                ;
                $myCauseGibbon->create();
                $tabCausesGibbon[$row->Especes_Id] = $myCauseGibbon->getCautId();
            }
        } catch (\PDOException $ex) {
            
        }
        // Cause Forêt
        $myCauseForet = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseForet
            ->setCautName('Forêt')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautText_1(1)
        ;
        $myCauseForet->create();
        // Cause Dulan
        $myCauseDulan = \FreeFW\DI\DI::get('FreeAsso::Model::CauseType');
        $myCauseDulan
            ->setCautName('Dulan')
            ->setCautMntType(\FreeAsso\Model\CauseType::MNT_TYPE_MAXIMUM)
            ->setCautMaxMnt(1000000)
            ->setCautMinMnt(0)
            ->setCautReceipt(1)
            ->setCautCertificat(1)
            ->setCautText_1(1)
        ;
        $myCauseDulan->create();
        /**
         * Import des Gibbons
         */
        $tabGibbons = [];
        $p_output->write("Import des Gibbons", true);
        $p_output->write($sso->getBrokerId(), true);
        try {
            $query = $provider->prepare("Select * from gibbons");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                /*its getting data in line.And its an object*/
                $myCause = \FreeFW\DI\DI::get('FreeAsso::Model::Cause');
                $myCause
                    ->setCauName($row->Nom_gibbon)
                    ->setCautId($myCauseGibbon->getCautId())
                    ->setCauDesc($row->Details)
                    ->setCauNumber_1($row->Annee_naissance)
                    ->setCauFamily(\FreeAsso\Model\Cause::FAMILY_ANIMAL)
                    ->setCauPublic(0)
                    ->setCauAvailable(0)
                ;
                $myCause->setSiteId($myIleAutre->getSiteId());
                if ($row->Ile == 'B') {
                    $myCause->setSiteId($myIleBorneo->getSiteId());
                }
                if ($row->Ile == 'S') {
                    $myCause->setSiteId($myIleSumatra->getSiteId());
                }
                $myCause->setCauString_2("Male");
                if ($row->Sexe == 'F') {
                    $myCause->setCauString_2("Femelle");
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
                    $myCause->setCauTo($row->Date_mort);
                }
                $myCause->create();
                $tabGibbons[$row->Numero_gibbon] = $myCause->getCauId();
            }
        } catch (\PDOException $ex) {
            echo "Error: ". $ex->getMessage();
        }
        /**
         * Import des Gibbons
         */
        $tabMembres = [];
        $p_output->write("Import des Membres", true);
        $p_output->write($sso->getBrokerId(), true);
        try {
            $query = $provider->prepare("Select * from membres");
            $query->execute();
            while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                
            }
        } catch (\PDOException $ex) {
            
        }
        //
        $p_output->write("Fin de l'import", true);
    }
}
