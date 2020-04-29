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
     * @var string
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
     * @param string $p_value
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
     * @return string
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
}
