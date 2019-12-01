<?php
namespace FreeAsso\Model\Base;

/**
 * SiteTypeData
 *
 * @author jeromeklam
 */
abstract class SiteTypeData extends \FreeAsso\Model\StorageModel\SiteTypeData
{

    /**
     * sittd_id
     * @var int
     */
    protected $sittd_id = null;

    /**
     * sitt_id
     * @var int
     */
    protected $sitt_id = null;

    /**
     * data_id
     * @var int
     */
    protected $data_id = null;

    /**
     * sittd_value
     * @var string
     */
    protected $sittd_value = null;

    /**
     * sittd_position
     * @var string
     */
    protected $sittd_position = null;

    /**
     * sittd_from
     * @var string
     */
    protected $sittd_from = null;

    /**
     * sittd_to
     * @var string
     */
    protected $sittd_to = null;

    /**
     * Set sittd_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittdId($p_value)
    {
        $this->sittd_id = $p_value;
        return $this;
    }

    /**
     * Get sittd_id
     *
     * @return int
     */
    public function getSittdId()
    {
        return $this->sittd_id;
    }

    /**
     * Set sitt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittId($p_value)
    {
        $this->sitt_id = $p_value;
        return $this;
    }

    /**
     * Get sitt_id
     *
     * @return int
     */
    public function getSittId()
    {
        return $this->sitt_id;
    }

    /**
     * Set data_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
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
     * Set sittd_value
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittdValue($p_value)
    {
        $this->sittd_value = $p_value;
        return $this;
    }

    /**
     * Get sittd_value
     *
     * @return string
     */
    public function getSittdValue()
    {
        return $this->sittd_value;
    }

    /**
     * Set sittd_position
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittdPosition($p_value)
    {
        $this->sittd_position = $p_value;
        return $this;
    }

    /**
     * Get sittd_position
     *
     * @return string
     */
    public function getSittdPosition()
    {
        return $this->sittd_position;
    }

    /**
     * Set sittd_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittdFrom($p_value)
    {
        $this->sittd_from = $p_value;
        return $this;
    }

    /**
     * Get sittd_from
     *
     * @return string
     */
    public function getSittdFrom()
    {
        return $this->sittd_from;
    }

    /**
     * Set sittd_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteTypeData
     */
    public function setSittdTo($p_value)
    {
        $this->sittd_to = $p_value;
        return $this;
    }

    /**
     * Get sittd_to
     *
     * @return string
     */
    public function getSittdTo()
    {
        return $this->sittd_to;
    }
}
