<?php
namespace FreeAsso\Model\Base;

/**
 * SiteType
 *
 * @author jeromeklam
 */
abstract class SiteType extends \FreeAsso\Model\StorageModel\SiteType
{

    /**
     * sitt_id
     * @var int
     */
    protected $sitt_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sitt_name
     * @var string
     */
    protected $sitt_name = null;

    /**
     * sitt_pattern
     * @var string
     */
    protected $sitt_pattern = null;

    /**
     * sitt_mask
     * @var string
     */
    protected $sitt_mask = null;

    /**
     * sitt_string_1
     * @var bool
     */
    protected $sitt_string_1 = null;

    /**
     * sitt_string_2
     * @var bool
     */
    protected $sitt_string_2 = null;

    /**
     * sitt_string_3
     * @var bool
     */
    protected $sitt_string_3 = null;

    /**
     * sitt_string_4
     * @var bool
     */
    protected $sitt_string_4 = null;

    /**
     * sitt_string_5
     * @var bool
     */
    protected $sitt_string_5 = null;

    /**
     * sitt_string_6
     * @var bool
     */
    protected $sitt_string_6 = null;

    /**
     * sitt_string_7
     * @var bool
     */
    protected $sitt_string_7 = null;

    /**
     * sitt_string_8
     * @var bool
     */
    protected $sitt_string_8 = null;

    /**
     * sitt_number_1
     * @var bool
     */
    protected $sitt_number_1 = null;

    /**
     * sitt_number_2
     * @var bool
     */
    protected $sitt_number_2 = null;

    /**
     * sitt_number_3
     * @var bool
     */
    protected $sitt_number_3 = null;

    /**
     * sitt_number_4
     * @var bool
     */
    protected $sitt_number_4 = null;

    /**
     * sitt_number_5
     * @var bool
     */
    protected $sitt_number_5 = null;

    /**
     * sitt_number_6
     * @var bool
     */
    protected $sitt_number_6 = null;

    /**
     * sitt_date_1
     * @var bool
     */
    protected $sitt_date_1 = null;

    /**
     * sitt_date_2
     * @var bool
     */
    protected $sitt_date_2 = null;

    /**
     * sitt_date_3
     * @var bool
     */
    protected $sitt_date_3 = null;

    /**
     * sitt_date_4
     * @var bool
     */
    protected $sitt_date_4 = null;

    /**
     * sitt_text_1
     * @var bool
     */
    protected $sitt_text_1 = null;

    /**
     * sitt_text_2
     * @var bool
     */
    protected $sitt_text_2 = null;

    /**
     * sitt_text_3
     * @var bool
     */
    protected $sitt_text_3 = null;

    /**
     * sitt_text_4
     * @var bool
     */
    protected $sitt_text_4 = null;

    /**
     * sitt_bool_1
     * @var bool
     */
    protected $sitt_bool_1 = null;

    /**
     * sitt_bool_2
     * @var bool
     */
    protected $sitt_bool_2 = null;

    /**
     * sitt_bool_3
     * @var bool
     */
    protected $sitt_bool_3 = null;

    /**
     * sitt_bool_4
     * @var bool
     */
    protected $sitt_bool_4 = null;

    /**
     * Set sitt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteType
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteType
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
     * Set sitt_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittName($p_value)
    {
        $this->sitt_name = $p_value;
        return $this;
    }

    /**
     * Get sitt_name
     *
     * @return string
     */
    public function getSittName()
    {
        return $this->sitt_name;
    }

    /**
     * Set sitt_pattern
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittPattern($p_value)
    {
        $this->sitt_pattern = $p_value;
        return $this;
    }

    /**
     * Get sitt_pattern
     *
     * @return string
     */
    public function getSittPattern()
    {
        return $this->sitt_pattern;
    }

    /**
     * Set sitt_mask
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittMask($p_value)
    {
        $this->sitt_mask = $p_value;
        return $this;
    }

    /**
     * Get sitt_mask
     *
     * @return string
     */
    public function getSittMask()
    {
        return $this->sitt_mask;
    }

    /**
     * Set sitt_string_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_1($p_value)
    {
        $this->sitt_string_1 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_1
     *
     * @return bool
     */
    public function getSittString_1()
    {
        return $this->sitt_string_1;
    }

    /**
     * Set sitt_string_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_2($p_value)
    {
        $this->sitt_string_2 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_2
     *
     * @return bool
     */
    public function getSittString_2()
    {
        return $this->sitt_string_2;
    }

    /**
     * Set sitt_string_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_3($p_value)
    {
        $this->sitt_string_3 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_3
     *
     * @return bool
     */
    public function getSittString_3()
    {
        return $this->sitt_string_3;
    }

    /**
     * Set sitt_string_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_4($p_value)
    {
        $this->sitt_string_4 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_4
     *
     * @return bool
     */
    public function getSittString_4()
    {
        return $this->sitt_string_4;
    }

    /**
     * Set sitt_string_5
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_5($p_value)
    {
        $this->sitt_string_5 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_5
     *
     * @return bool
     */
    public function getSittString_5()
    {
        return $this->sitt_string_5;
    }

    /**
     * Set sitt_string_6
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_6($p_value)
    {
        $this->sitt_string_6 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_6
     *
     * @return bool
     */
    public function getSittString_6()
    {
        return $this->sitt_string_6;
    }

    /**
     * Set sitt_string_7
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_7($p_value)
    {
        $this->sitt_string_7 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_7
     *
     * @return bool
     */
    public function getSittString_7()
    {
        return $this->sitt_string_7;
    }

    /**
     * Set sitt_string_8
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittString_8($p_value)
    {
        $this->sitt_string_8 = $p_value;
        return $this;
    }

    /**
     * Get sitt_string_8
     *
     * @return bool
     */
    public function getSittString_8()
    {
        return $this->sitt_string_8;
    }

    /**
     * Set sitt_number_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_1($p_value)
    {
        $this->sitt_number_1 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_1
     *
     * @return bool
     */
    public function getSittNumber_1()
    {
        return $this->sitt_number_1;
    }

    /**
     * Set sitt_number_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_2($p_value)
    {
        $this->sitt_number_2 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_2
     *
     * @return bool
     */
    public function getSittNumber_2()
    {
        return $this->sitt_number_2;
    }

    /**
     * Set sitt_number_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_3($p_value)
    {
        $this->sitt_number_3 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_3
     *
     * @return bool
     */
    public function getSittNumber_3()
    {
        return $this->sitt_number_3;
    }

    /**
     * Set sitt_number_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_4($p_value)
    {
        $this->sitt_number_4 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_4
     *
     * @return bool
     */
    public function getSittNumber_4()
    {
        return $this->sitt_number_4;
    }

    /**
     * Set sitt_number_5
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_5($p_value)
    {
        $this->sitt_number_5 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_5
     *
     * @return bool
     */
    public function getSittNumber_5()
    {
        return $this->sitt_number_5;
    }

    /**
     * Set sitt_number_6
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittNumber_6($p_value)
    {
        $this->sitt_number_6 = $p_value;
        return $this;
    }

    /**
     * Get sitt_number_6
     *
     * @return bool
     */
    public function getSittNumber_6()
    {
        return $this->sitt_number_6;
    }

    /**
     * Set sitt_date_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittDate_1($p_value)
    {
        $this->sitt_date_1 = $p_value;
        return $this;
    }

    /**
     * Get sitt_date_1
     *
     * @return bool
     */
    public function getSittDate_1()
    {
        return $this->sitt_date_1;
    }

    /**
     * Set sitt_date_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittDate_2($p_value)
    {
        $this->sitt_date_2 = $p_value;
        return $this;
    }

    /**
     * Get sitt_date_2
     *
     * @return bool
     */
    public function getSittDate_2()
    {
        return $this->sitt_date_2;
    }

    /**
     * Set sitt_date_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittDate_3($p_value)
    {
        $this->sitt_date_3 = $p_value;
        return $this;
    }

    /**
     * Get sitt_date_3
     *
     * @return bool
     */
    public function getSittDate_3()
    {
        return $this->sitt_date_3;
    }

    /**
     * Set sitt_date_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittDate_4($p_value)
    {
        $this->sitt_date_4 = $p_value;
        return $this;
    }

    /**
     * Get sitt_date_4
     *
     * @return bool
     */
    public function getSittDate_4()
    {
        return $this->sitt_date_4;
    }

    /**
     * Set sitt_text_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittText_1($p_value)
    {
        $this->sitt_text_1 = $p_value;
        return $this;
    }

    /**
     * Get sitt_text_1
     *
     * @return bool
     */
    public function getSittText_1()
    {
        return $this->sitt_text_1;
    }

    /**
     * Set sitt_text_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittText_2($p_value)
    {
        $this->sitt_text_2 = $p_value;
        return $this;
    }

    /**
     * Get sitt_text_2
     *
     * @return bool
     */
    public function getSittText_2()
    {
        return $this->sitt_text_2;
    }

    /**
     * Set sitt_text_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittText_3($p_value)
    {
        $this->sitt_text_3 = $p_value;
        return $this;
    }

    /**
     * Get sitt_text_3
     *
     * @return bool
     */
    public function getSittText_3()
    {
        return $this->sitt_text_3;
    }

    /**
     * Set sitt_text_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittText_4($p_value)
    {
        $this->sitt_text_4 = $p_value;
        return $this;
    }

    /**
     * Get sitt_text_4
     *
     * @return bool
     */
    public function getSittText_4()
    {
        return $this->sitt_text_4;
    }

    /**
     * Set sitt_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittBool_1($p_value)
    {
        $this->sitt_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get sitt_bool_1
     *
     * @return bool
     */
    public function getSittBool_1()
    {
        return $this->sitt_bool_1;
    }

    /**
     * Set sitt_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittBool_2($p_value)
    {
        $this->sitt_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get sitt_bool_2
     *
     * @return bool
     */
    public function getSittBool_2()
    {
        return $this->sitt_bool_2;
    }

    /**
     * Set sitt_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittBool_3($p_value)
    {
        $this->sitt_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get sitt_bool_3
     *
     * @return bool
     */
    public function getSittBool_3()
    {
        return $this->sitt_bool_3;
    }

    /**
     * Set sitt_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\SiteType
     */
    public function setSittBool_4($p_value)
    {
        $this->sitt_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get sitt_bool_4
     *
     * @return bool
     */
    public function getSittBool_4()
    {
        return $this->sitt_bool_4;
    }
}
