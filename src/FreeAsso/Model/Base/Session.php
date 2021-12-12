<?php
namespace FreeAsso\Model\Base;

/**
 * Session
 *
 * @author jeromeklam
 */
abstract class Session extends \FreeAsso\Model\StorageModel\Session
{

    /**
     * sess_id
     * @var int
     */
    protected $sess_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sess_name
     * @var string
     */
    protected $sess_name = null;

    /**
     * sess_exercice
     * @var int
     */
    protected $sess_exercice = null;

    /**
     * sess_status
     * @var string
     */
    protected $sess_status = null;

    /**
     * sess_type
     * @var string
     */
    protected $sess_type = null;

    /**
     * sess_year
     * @var int
     */
    protected $sess_year = null;
    
    /**
     * sess_month
     * @var int
     */
    protected $sess_month = null;

    /**
     * sess_verif
     * @var int
     */
    protected $sess_verif = null;

    /**
     * sess_verif_text
     * @var int
     */
    protected $sess_verif_text = null;

    /**
     * Set sess_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setSessId($p_value)
    {
        $this->sess_id = $p_value;
        return $this;
    }

    /**
     * Get sess_id
     *
     * @return int
     */
    public function getSessId()
    {
        return $this->sess_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setBrkId($p_value)
    {
        $this->brk_id = $p_value;
        return $this;
    }

    /**
     * Get brk_id
     *
     * @return int
     */
    public function getBrkId()
    {
        return $this->brk_id;
    }

    /**
     * Set sess_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setSessName($p_value)
    {
        $this->sess_name = $p_value;
        return $this;
    }

    /**
     * Get sess_name
     *
     * @return string
     */
    public function getSessName()
    {
        return $this->sess_name;
    }

    /**
     * Set sess_exercice
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setSessExercice($p_value)
    {
        $this->sess_exercice = $p_value;
        return $this;
    }

    /**
     * Get sess_exercice
     *
     * @return int
     */
    public function getSessExercice()
    {
        return $this->sess_exercice;
    }

    /**
     * Set sess_status
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setSessStatus($p_value)
    {
        $this->sess_status = $p_value;
        return $this;
    }

    /**
     * Get sess_status
     *
     * @return string
     */
    public function getSessStatus()
    {
        return $this->sess_status;
    }

    /**
     * Set sess_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Session
     */
    public function setSessType($p_value)
    {
        $this->sess_type = $p_value;
        return $this;
    }

    /**
     * Get sess_type
     *
     * @return string
     */
    public function getSessType()
    {
        return $this->sess_type;
    }

    /**
     * Set sess_year
     *
     * @param int $p_value
     * 
     * @return \FreeAsso\Model\Session
     */
    public function setSessYear($p_value)
    {
        $this->sess_year = $p_value;
        return $this;
    }

    /**
     * Get sess_year
     *
     * @return int
     */
    public function getSessYear()
    {
        return $this->sess_year;
    }

    /**
     * Set sess_month
     *
     * @param int $p_value
     * 
     * @return \FreeAsso\Model\Session
     */
    public function setSessMonth($p_value)
    {
        $this->sess_month = $p_value;
        return $this;
    }

    /**
     * Get sess_month
     *
     * @return int
     */
    public function getSessMonth()
    {
        return $this->sess_month;
    }

    /**
     * Set sess_verif
     *
     * @param int $p_value
     * 
     * @return \FreeAsso\Model\Session
     */
    public function setSessVerif($p_value)
    {
        $this->sess_verif = $p_value;
        return $this;
    }

    /**
     * Get sess_verif
     *
     * @return int
     */
    public function getSessVerif()
    {
        return $this->sess_verif;
    }

    /**
     * Set sess_verif_text
     *
     * @param int $p_value
     * 
     * @return \FreeAsso\Model\Session
     */
    public function setSessVerifText($p_value)
    {
        $this->sess_verif_text = $p_value;
        return $this;
    }

    /**
     * Get sess_verif_text
     *
     * @return int
     */
    public function getSessVerifText()
    {
        return $this->sess_verif_text;
    }
}
