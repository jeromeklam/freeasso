<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Model Subspecies
 *
 * @author jeromeklam
 */
class Subspecies extends \FreeAsso\Model\Base\Subspecies
{
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * @see \FreeFW\Core\Model
     */
    protected $__cached_model = true;

    /**
     * Species
     * @var \FreeAsso\Model\Species
     */
    protected $species = null;

    /**
     * Set species
     *
     * @param \FreeAsso\Model\Species $p_species
     *
     * @return \FreeAsso\Model\Subspecies
     */
    public function setSpecies($p_species)
    {
        $this->species = $p_species;
        return $this;
    }

    /**
     * Get species
     *
     * @return \FreeAsso\Model\Species
     */
    public function getSpecies()
    {
        return $this->species;
    }
}
