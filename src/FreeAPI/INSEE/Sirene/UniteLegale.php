<?php
namespace FreeAPI\INSEE\Sirene;

/**
 * class UniteLegale
 */
class UniteLegale extends Base
{
    public $siren = null;

    public $statutDiffusionUniteLegale = null;

    public $dateCreationUniteLegale = null;

    public $sigleUniteLegale = null;

    public $categorieEntreprise = null;

    public $denominationUniteLegale = null;

    public $categorieJuridiqueUniteLegale = null;

    public $identifiantAssociationUniteLegale = null;

    public $nomUniteLegale = null;

    /**
     * Constructor
     * 
     * @param array $p_data
     */
    public function __construct($p_data)
    {
        parent::__construct($p_data);
        if (isset($p_data['periodesUniteLegale'])) {
            if (is_array($p_data['periodesUniteLegale'])) {
                foreach ($p_data['periodesUniteLegale'] as $periode) {
                    if ($periode['dateFin'] == '') {
                        foreach ($periode as $name => $value) {
                            if (property_exists($this, $name)) {
                                $this->{$name} = $value;
                            }
                        }
                        break;
                    }
                }
            }
        }
    }
}
