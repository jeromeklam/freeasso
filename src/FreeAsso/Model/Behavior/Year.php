<?php
namespace FreeAsso\Model\Behavior;

/**
 * year
 *
 * @author jeromeklam
 *
 */
trait Year
{

   /**
     * Id
     * @var number
     */
    protected $year_id = null;

    /**
     * Year
     * @var \FreeAsso\Model\Year
     */
    protected $year = null;

    /**
     * Set id : year
     *
     * @param number $p_id
     *
     * @return \FreeAsso\Model\Behavior\Year
     */
    public function setYearId($p_id)
    {
        $this->year_id = $p_id;
        if ($this->year) {
            if ($this->year->getYearId() != $this->year_id) {
                $this->year = null;
            }
        }
        return $this;
    }

    /**
     * Get id : year
     *
     * @return number
     */
    public function getYearId()
    {
        return $this->year_id;
    }

    /**
     * Set year
     *
     * @param \FreeAsso\Model\Year $p_model
     *
     * @return \FreeFW\Core\Model
     */
    public function setYear($p_model)
    {
        $this->year = $p_model;
        if ($p_model) {
            $this->year_id = $p_model->getYearId();
        }
        return $this;
   }

   /**
     * Get year
     *
     * @param boolean $p_force
     *
     * @return \FreeAsso\Model\Year
     */
    public function getYear($p_force = false)
    {
        if ($this->year === null || $p_force) {
            if ($this->year_id > 0) {
                $this->year = \FreeAsso\Model\Year::findFirst(
                    [
                        'year_id' => $this->year_id
                    ]
                );
            } else {
                $this->year = null;
            }
        }
        return $this->year;
    }
}