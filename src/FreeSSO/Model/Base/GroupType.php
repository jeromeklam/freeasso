<?php
namespace FreeSSO\Model\Base;

/**
 * GroupType
 *
 * @author jeromeklam
 */
abstract class GroupType extends \FreeSSO\Model\StorageModel\GroupType
{

    /**
     * grpt_id
     * @var int
     */
    protected $grpt_id = null;

    /**
     * grpt_code
     * @var string
     */
    protected $grpt_code = null;

    /**
     * grpt_name
     * @var string
     */
    protected $grpt_name = null;

    /**
     * grpt_from
     * @var mixed
     */
    protected $grpt_from = null;

    /**
     * grpt_to
     * @var mixed
     */
    protected $grpt_to = null;

    /**
     * Set grpt_id
     *
     * @param int $p_value
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function setGrptId($p_value)
    {
        $this->grpt_id = $p_value;
        return $this;
    }

    /**
     * Get grpt_id
     *
     * @return int
     */
    public function getGrptId()
    {
        return $this->grpt_id;
    }

    /**
     * Set grpt_code
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function setGrptCode($p_value)
    {
        $this->grpt_code = $p_value;
        return $this;
    }

    /**
     * Get grpt_code
     *
     * @return string
     */
    public function getGrptCode()
    {
        return $this->grpt_code;
    }

    /**
     * Set grpt_name
     *
     * @param string $p_value
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function setGrptName($p_value)
    {
        $this->grpt_name = $p_value;
        return $this;
    }

    /**
     * Get grpt_name
     *
     * @return string
     */
    public function getGrptName()
    {
        return $this->grpt_name;
    }

    /**
     * Set grpt_from
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function setGrptFrom($p_value)
    {
        $this->grpt_from = $p_value;
        return $this;
    }

    /**
     * Get grpt_from
     *
     * @return mixed
     */
    public function getGrptFrom()
    {
        return $this->grpt_from;
    }

    /**
     * Set grpt_to
     *
     * @param mixed $p_value
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function setGrptTo($p_value)
    {
        $this->grpt_to = $p_value;
        return $this;
    }

    /**
     * Get grpt_to
     *
     * @return mixed
     */
    public function getGrptTo()
    {
        return $this->grpt_to;
    }
}
