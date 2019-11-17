<?php
namespace FreeAsso\Model\Base;

/**
 * Data
 *
 * @author jeromeklam
 */
abstract class Data extends \FreeAsso\Model\StorageModel\Data
{

    /**
     * data_id
     * @var int
     */
    protected $data_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * data_name
     * @var string
     */
    protected $data_name = null;

    /**
     * data_code
     * @var string
     */
    protected $data_code = null;

    /**
     * data_type
     * @var string
     */
    protected $data_type = null;

    /**
     * data_from
     * @var string
     */
    protected $data_from = null;

    /**
     * data_to
     * @var string
     */
    protected $data_to = null;

    /**
     * data_content
     * @var mixed
     */
    protected $data_content = null;

    /**
     * Set data_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataId($p_value)
    {
        $this->data_id = $p_value;
        return $this;
    }

    /**
     * Get data_id
     *
     * @return int
     */
    public function getDataId()
    {
        return $this->data_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Data
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
     * Set data_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataName($p_value)
    {
        $this->data_name = $p_value;
        return $this;
    }

    /**
     * Get data_name
     *
     * @return string
     */
    public function getDataName()
    {
        return $this->data_name;
    }

    /**
     * Set data_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataCode($p_value)
    {
        $this->data_code = $p_value;
        return $this;
    }

    /**
     * Get data_code
     *
     * @return string
     */
    public function getDataCode()
    {
        return $this->data_code;
    }

    /**
     * Set data_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataType($p_value)
    {
        $this->data_type = $p_value;
        return $this;
    }

    /**
     * Get data_type
     *
     * @return string
     */
    public function getDataType()
    {
        return $this->data_type;
    }

    /**
     * Set data_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataFrom($p_value)
    {
        $this->data_from = $p_value;
        return $this;
    }

    /**
     * Get data_from
     *
     * @return string
     */
    public function getDataFrom()
    {
        return $this->data_from;
    }

    /**
     * Set data_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataTo($p_value)
    {
        $this->data_to = $p_value;
        return $this;
    }

    /**
     * Get data_to
     *
     * @return string
     */
    public function getDataTo()
    {
        return $this->data_to;
    }

    /**
     * Set data_content
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Data
     */
    public function setDataContent($p_value)
    {
        $this->data_content = $p_value;
        return $this;
    }

    /**
     * Get data_content
     *
     * @return mixed
     */
    public function getDataContent()
    {
        return $this->data_content;
    }
}
