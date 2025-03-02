<?php
namespace FreeSSO\Model\Base;

/**
 * JobFunction
 *
 * @author jeromeklam
 */
abstract class JobFunction extends \FreeSSO\Model\StorageModel\JobFunction
{

    /**
     * fct_id
     * @var int
     */
    protected $fct_id = null;

    /**
     * fct_code
     * @var string
     */
    protected $fct_code = null;

    /**
     * fct_name
     * @var string
     */
    protected $fct_name = null;

    /**
     * fct_from
     * @var mixed
     */
    protected $fct_from = null;

    /**
     * fct_to
     * @var mixed
     */
    protected $fct_to = null;

    /**
     * Set fct_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function setFctId($p_value)
    {
        $this->fct_id = $p_value;
        return $this;
    }

    /**
     * Get fct_id
     *
     * @return int
     */
    public function getFctId()
    {
        return $this->fct_id;
    }

    /**
     * Set fct_code
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function setFctCode($p_value)
    {
        $this->fct_code = $p_value;
        return $this;
    }

    /**
     * Get fct_code
     *
     * @return string
     */
    public function getFctCode()
    {
        return $this->fct_code;
    }

    /**
     * Set fct_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function setFctName($p_value)
    {
        $this->fct_name = $p_value;
        return $this;
    }

    /**
     * Get fct_name
     *
     * @return string
     */
    public function getFctName()
    {
        return $this->fct_name;
    }

    /**
     * Set fct_from
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function setFctFrom($p_value)
    {
        $this->fct_from = $p_value;
        return $this;
    }

    /**
     * Get fct_from
     *
     * @return mixed
     */
    public function getFctFrom()
    {
        return $this->fct_from;
    }

    /**
     * Set fct_to
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\JobFunction
     */
    public function setFctTo($p_value)
    {
        $this->fct_to = $p_value;
        return $this;
    }

    /**
     * Get fct_to
     *
     * @return mixed
     */
    public function getFctTo()
    {
        return $this->fct_to;
    }
}
