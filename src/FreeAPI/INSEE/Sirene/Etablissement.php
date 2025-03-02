<?php

namespace FreeAPI\INSEE\Sirene;

/**
 * class UniteLegale
 */
class Etablissement extends Base
{
    public $siren = null;

    public $siret = null;

    public $statutDiffusionUniteLegale = null;

    public $dateCreationUniteLegale = null;

    public $sigleUniteLegale = null;

    public $categorieEntreprise = null;

    public $denominationUniteLegale = null;

    public $categorieJuridiqueUniteLegale = null;

    public $identifiantAssociationUniteLegale = null;

    public $nomUniteLegale = null;

    public $complementAdresseEtablissement = null;

    public $numeroVoieEtablissement = null;

    public $indiceRepetitionEtablissement = null;

    public $typeVoieEtablissement = null;

    public $libelleVoieEtablissement = null;

    public $codePostalEtablissement = null;

    public $libelleCommuneEtablissement = null;

    public $libelleCommuneEtrangerEtablissement = null;

    public $distributionSpecialeEtablissement = null;

    public $codeCommuneEtablissement = null;

    public $codeCedexEtablissement = null;

    public $libelleCedexEtablissement = null;

    public $codePaysEtrangerEtablissement = null;
    
    public $libellePaysEtrangerEtablissement = null;

    public $categorie = null;

    /**
     * Constructor
     * 
     * @param array $p_data
     */
    public function __construct($p_data)
    {
        parent::__construct($p_data);
        if (isset($p_data['uniteLegale'])) {
            if (is_array($p_data['uniteLegale'])) {
                foreach ($p_data['uniteLegale'] as $name => $value) {
                    if (property_exists($this, $name)) {
                        $this->{$name} = $value;
                    }
                }
            }
        }
        if (isset($p_data['adresseEtablissement'])) {
            if (is_array($p_data['adresseEtablissement'])) {
                foreach ($p_data['adresseEtablissement'] as $name => $value) {
                    if (property_exists($this, $name)) {
                        $this->{$name} = $value;
                    }
                }
            }
        }
        if (isset(\FreeAPI\INSEE\Constants::$categories[$this->categorieJuridiqueUniteLegale])) {
            $this->categorie = \FreeAPI\INSEE\Constants::$categories[$this->categorieJuridiqueUniteLegale];
        }
    }
}
