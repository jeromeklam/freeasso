<?php
namespace FreeAsso\Model\Base;

/**
 * Sickness
 *
 * @author jeromeklam
 */
abstract class Sickness extends \FreeAsso\Model\StorageModel\Sickness
{

    /**
     * sick_id
     * @var int
     */
    protected $sick_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sick_name
     * @var string
     */
    protected $sick_name = null;

    /**
     * sick_desc
     * @var mixed
     */
    protected $sick_desc = null;

    /**
     * sick_duration
     * @var string
     */
    protected $sick_duration = null;

    /**
     * sick_type
     * @var string
     */
    protected $sick_type = null;

    /**
     * sick_freq
     * @var string
     */
    protected $sick_freq = null;

    /**
     * sick_spread
     * @var int
     */
    protected $sick_spread = null;

    /**
     * Set sick_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickId($p_value)
    {
        $this->sick_id = $p_value;
        return $this;
    }

    /**
     * Get sick_id
     *
     * @return int
     */
    public function getSickId()
    {
        return $this->sick_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sickness
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
     * Set sick_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickName($p_value)
    {
        $this->sick_name = $p_value;
        return $this;
    }

    /**
     * Get sick_name
     *
     * @return string
     */
    public function getSickName()
    {
        return $this->sick_name;
    }

    /**
     * Set sick_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickDesc($p_value)
    {
        $this->sick_desc = $p_value;
        return $this;
    }

    /**
     * Get sick_desc
     *
     * @return mixed
     */
    public function getSickDesc()
    {
        return $this->sick_desc;
    }

    /**
     * Set sick_duration
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickDuration($p_value)
    {
        $this->sick_duration = $p_value;
        return $this;
    }

    /**
     * Get sick_duration
     *
     * @return string
     */
    public function getSickDuration()
    {
        return $this->sick_duration;
    }

    /**
     * Set sick_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickType($p_value)
    {
        $this->sick_type = $p_value;
        return $this;
    }

    /**
     * Get sick_type
     *
     * @return string
     */
    public function getSickType()
    {
        return $this->sick_type;
    }

    /**
     * Set sick_freq
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickFreq($p_value)
    {
        $this->sick_freq = $p_value;
        return $this;
    }

    /**
     * Get sick_freq
     *
     * @return string
     */
    public function getSickFreq()
    {
        return $this->sick_freq;
    }

    /**
     * Set sick_spread
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function setSickSpread($p_value)
    {
        $this->sick_spread = $p_value;
        return $this;
    }

    /**
     * Get sick_spread
     *
     * @return int
     */
    public function getSickSpread()
    {
        return $this->sick_spread;
    }
}
