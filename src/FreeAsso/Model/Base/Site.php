<?php
namespace FreeAsso\Model\Base;

/**
 * Site
 *
 * @author jeromeklam
 */
abstract class Site extends \FreeAsso\Model\StorageModel\Site
{

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * sitt_id
     * @var int
     */
    protected $sitt_id = null;

    /**
     * site_name
     * @var string
     */
    protected $site_name = null;

    /**
     * site_from
     * @var mixed
     */
    protected $site_from = null;

    /**
     * site_to
     * @var mixed
     */
    protected $site_to = null;

    /**
     * site_code
     * @var string
     */
    protected $site_code = null;

    /**
     * site_address1
     * @var string
     */
    protected $site_address1 = null;

    /**
     * site_address2
     * @var string
     */
    protected $site_address2 = null;

    /**
     * site_address3
     * @var string
     */
    protected $site_address3 = null;

    /**
     * site_cp
     * @var string
     */
    protected $site_cp = null;

    /**
     * site_town
     * @var string
     */
    protected $site_town = null;

    /**
     * owner_cli_id
     * @var int
     */
    protected $owner_cli_id = null;

    /**
     * sanit_cli_id
     * @var int
     */
    protected $sanit_cli_id = null;

    /**
     * parent_site_id
     * @var int
     */
    protected $parent_site_id = null;

    /**
     * site_area
     * @var int
     */
    protected $site_area = null;

    /**
     * site_position
     * @var int
     */
    protected $site_position = null;

    /**
     * site_plots
     * @var mixed
     */
    protected $site_plots = null;

    /**
     * site_left
     * @var int
     */
    protected $site_left = null;

    /**
     * site_right
     * @var int
     */
    protected $site_right = null;

    /**
     * site_level
     * @var int
     */
    protected $site_level = null;

    /**
     * site_string_1
     * @var string
     */
    protected $site_string_1 = null;

    /**
     * site_string_2
     * @var string
     */
    protected $site_string_2 = null;

    /**
     * site_string_3
     * @var string
     */
    protected $site_string_3 = null;

    /**
     * site_string_4
     * @var string
     */
    protected $site_string_4 = null;

    /**
     * site_string_5
     * @var string
     */
    protected $site_string_5 = null;

    /**
     * site_string_6
     * @var string
     */
    protected $site_string_6 = null;

    /**
     * site_string_7
     * @var string
     */
    protected $site_string_7 = null;

    /**
     * site_string_8
     * @var string
     */
    protected $site_string_8 = null;

    /**
     * site_number_1
     * @var int
     */
    protected $site_number_1 = null;

    /**
     * site_number_2
     * @var int
     */
    protected $site_number_2 = null;

    /**
     * site_number_3
     * @var int
     */
    protected $site_number_3 = null;

    /**
     * site_number_4
     * @var int
     */
    protected $site_number_4 = null;

    /**
     * site_number_5
     * @var int
     */
    protected $site_number_5 = null;

    /**
     * site_number_6
     * @var int
     */
    protected $site_number_6 = null;

    /**
     * site_date_1
     * @var mixed
     */
    protected $site_date_1 = null;

    /**
     * site_date_2
     * @var mixed
     */
    protected $site_date_2 = null;

    /**
     * site_date_3
     * @var mixed
     */
    protected $site_date_3 = null;

    /**
     * site_date_4
     * @var mixed
     */
    protected $site_date_4 = null;

    /**
     * site_text_1
     * @var mixed
     */
    protected $site_text_1 = null;

    /**
     * site_text_2
     * @var mixed
     */
    protected $site_text_2 = null;

    /**
     * site_text_3
     * @var mixed
     */
    protected $site_text_3 = null;

    /**
     * site_text_4
     * @var mixed
     */
    protected $site_text_4 = null;

    /**
     * site_bool_1
     * @var bool
     */
    protected $site_bool_1 = null;

    /**
     * site_bool_2
     * @var bool
     */
    protected $site_bool_2 = null;

    /**
     * site_bool_3
     * @var bool
     */
    protected $site_bool_3 = null;

    /**
     * site_bool_4
     * @var bool
     */
    protected $site_bool_4 = null;

    /**
     * site_coord
     * @var string
     */
    protected $site_coord = null;

    /**
     * site_code_ex
     * @var string
     */
    protected $site_code_ex = null;

    /**
     * site_desc
     * @var mixed
     */
    protected $site_desc = null;

    /**
     * site_conform
     * @var bool
     */
    protected $site_conform = null;

    /**
     * site_conform_text
     * @var mixed
     */
    protected $site_conform_text = null;

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteId($p_value)
    {
        $this->site_id = $p_value;
        return $this;
    }

    /**
     * Get site_id
     *
     * @return int
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
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
     * Set sitt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
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
     * Set site_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteName($p_value)
    {
        $this->site_name = $p_value;
        return $this;
    }

    /**
     * Get site_name
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * Set site_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteFrom($p_value)
    {
        $this->site_from = $p_value;
        return $this;
    }

    /**
     * Get site_from
     *
     * @return mixed
     */
    public function getSiteFrom()
    {
        return $this->site_from;
    }

    /**
     * Set site_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteTo($p_value)
    {
        $this->site_to = $p_value;
        return $this;
    }

    /**
     * Get site_to
     *
     * @return mixed
     */
    public function getSiteTo()
    {
        return $this->site_to;
    }

    /**
     * Set site_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCode($p_value)
    {
        $this->site_code = $p_value;
        return $this;
    }

    /**
     * Get site_code
     *
     * @return string
     */
    public function getSiteCode()
    {
        return $this->site_code;
    }

    /**
     * Set site_address1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress1($p_value)
    {
        $this->site_address1 = $p_value;
        return $this;
    }

    /**
     * Get site_address1
     *
     * @return string
     */
    public function getSiteAddress1()
    {
        return $this->site_address1;
    }

    /**
     * Set site_address2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress2($p_value)
    {
        $this->site_address2 = $p_value;
        return $this;
    }

    /**
     * Get site_address2
     *
     * @return string
     */
    public function getSiteAddress2()
    {
        return $this->site_address2;
    }

    /**
     * Set site_address3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteAddress3($p_value)
    {
        $this->site_address3 = $p_value;
        return $this;
    }

    /**
     * Get site_address3
     *
     * @return string
     */
    public function getSiteAddress3()
    {
        return $this->site_address3;
    }

    /**
     * Set site_cp
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCp($p_value)
    {
        $this->site_cp = $p_value;
        return $this;
    }

    /**
     * Get site_cp
     *
     * @return string
     */
    public function getSiteCp()
    {
        return $this->site_cp;
    }

    /**
     * Set site_town
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteTown($p_value)
    {
        $this->site_town = $p_value;
        return $this;
    }

    /**
     * Get site_town
     *
     * @return string
     */
    public function getSiteTown()
    {
        return $this->site_town;
    }

    /**
     * Set owner_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setOwnerCliId($p_value)
    {
        $this->owner_cli_id = $p_value;
        return $this;
    }

    /**
     * Get owner_cli_id
     *
     * @return int
     */
    public function getOwnerCliId()
    {
        return $this->owner_cli_id;
    }

    /**
     * Set sanit_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSanitCliId($p_value)
    {
        $this->sanit_cli_id = $p_value;
        return $this;
    }

    /**
     * Get sanit_cli_id
     *
     * @return int
     */
    public function getSanitCliId()
    {
        return $this->sanit_cli_id;
    }

    /**
     * Set parent_site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setParentSiteId($p_value)
    {
        $this->parent_site_id = $p_value;
        return $this;
    }

    /**
     * Get parent_site_id
     *
     * @return int
     */
    public function getParentSiteId()
    {
        return $this->parent_site_id;
    }

    /**
     * Set site_area
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteArea($p_value)
    {
        $this->site_area = $p_value;
        return $this;
    }

    /**
     * Get site_area
     *
     * @return int
     */
    public function getSiteArea()
    {
        return $this->site_area;
    }

    /**
     * Set site_position
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSitePosition($p_value)
    {
        $this->site_position = $p_value;
        return $this;
    }

    /**
     * Get site_position
     *
     * @return int
     */
    public function getSitePosition()
    {
        return $this->site_position;
    }

    /**
     * Set site_plots
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSitePlots($p_value)
    {
        $this->site_plots = $p_value;
        return $this;
    }

    /**
     * Get site_plots
     *
     * @return mixed
     */
    public function getSitePlots()
    {
        return $this->site_plots;
    }

    /**
     * Set site_left
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteLeft($p_value)
    {
        $this->site_left = $p_value;
        return $this;
    }

    /**
     * Get site_left
     *
     * @return int
     */
    public function getSiteLeft()
    {
        return $this->site_left;
    }

    /**
     * Set site_right
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteRight($p_value)
    {
        $this->site_right = $p_value;
        return $this;
    }

    /**
     * Get site_right
     *
     * @return int
     */
    public function getSiteRight()
    {
        return $this->site_right;
    }

    /**
     * Set site_level
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteLevel($p_value)
    {
        $this->site_level = $p_value;
        return $this;
    }

    /**
     * Get site_level
     *
     * @return int
     */
    public function getSiteLevel()
    {
        return $this->site_level;
    }

    /**
     * Set site_string_1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_1($p_value)
    {
        $this->site_string_1 = $p_value;
        return $this;
    }

    /**
     * Get site_string_1
     *
     * @return string
     */
    public function getSiteString_1()
    {
        return $this->site_string_1;
    }

    /**
     * Set site_string_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_2($p_value)
    {
        $this->site_string_2 = $p_value;
        return $this;
    }

    /**
     * Get site_string_2
     *
     * @return string
     */
    public function getSiteString_2()
    {
        return $this->site_string_2;
    }

    /**
     * Set site_string_3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_3($p_value)
    {
        $this->site_string_3 = $p_value;
        return $this;
    }

    /**
     * Get site_string_3
     *
     * @return string
     */
    public function getSiteString_3()
    {
        return $this->site_string_3;
    }

    /**
     * Set site_string_4
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_4($p_value)
    {
        $this->site_string_4 = $p_value;
        return $this;
    }

    /**
     * Get site_string_4
     *
     * @return string
     */
    public function getSiteString_4()
    {
        return $this->site_string_4;
    }

    /**
     * Set site_string_5
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_5($p_value)
    {
        $this->site_string_5 = $p_value;
        return $this;
    }

    /**
     * Get site_string_5
     *
     * @return string
     */
    public function getSiteString_5()
    {
        return $this->site_string_5;
    }

    /**
     * Set site_string_6
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_6($p_value)
    {
        $this->site_string_6 = $p_value;
        return $this;
    }

    /**
     * Get site_string_6
     *
     * @return string
     */
    public function getSiteString_6()
    {
        return $this->site_string_6;
    }

    /**
     * Set site_string_7
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_7($p_value)
    {
        $this->site_string_7 = $p_value;
        return $this;
    }

    /**
     * Get site_string_7
     *
     * @return string
     */
    public function getSiteString_7()
    {
        return $this->site_string_7;
    }

    /**
     * Set site_string_8
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteString_8($p_value)
    {
        $this->site_string_8 = $p_value;
        return $this;
    }

    /**
     * Get site_string_8
     *
     * @return string
     */
    public function getSiteString_8()
    {
        return $this->site_string_8;
    }

    /**
     * Set site_number_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_1($p_value)
    {
        $this->site_number_1 = $p_value;
        return $this;
    }

    /**
     * Get site_number_1
     *
     * @return int
     */
    public function getSiteNumber_1()
    {
        return $this->site_number_1;
    }

    /**
     * Set site_number_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_2($p_value)
    {
        $this->site_number_2 = $p_value;
        return $this;
    }

    /**
     * Get site_number_2
     *
     * @return int
     */
    public function getSiteNumber_2()
    {
        return $this->site_number_2;
    }

    /**
     * Set site_number_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_3($p_value)
    {
        $this->site_number_3 = $p_value;
        return $this;
    }

    /**
     * Get site_number_3
     *
     * @return int
     */
    public function getSiteNumber_3()
    {
        return $this->site_number_3;
    }

    /**
     * Set site_number_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_4($p_value)
    {
        $this->site_number_4 = $p_value;
        return $this;
    }

    /**
     * Get site_number_4
     *
     * @return int
     */
    public function getSiteNumber_4()
    {
        return $this->site_number_4;
    }

    /**
     * Set site_number_5
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_5($p_value)
    {
        $this->site_number_5 = $p_value;
        return $this;
    }

    /**
     * Get site_number_5
     *
     * @return int
     */
    public function getSiteNumber_5()
    {
        return $this->site_number_5;
    }

    /**
     * Set site_number_6
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteNumber_6($p_value)
    {
        $this->site_number_6 = $p_value;
        return $this;
    }

    /**
     * Get site_number_6
     *
     * @return int
     */
    public function getSiteNumber_6()
    {
        return $this->site_number_6;
    }

    /**
     * Set site_date_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteDate_1($p_value)
    {
        $this->site_date_1 = $p_value;
        return $this;
    }

    /**
     * Get site_date_1
     *
     * @return mixed
     */
    public function getSiteDate_1()
    {
        return $this->site_date_1;
    }

    /**
     * Set site_date_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteDate_2($p_value)
    {
        $this->site_date_2 = $p_value;
        return $this;
    }

    /**
     * Get site_date_2
     *
     * @return mixed
     */
    public function getSiteDate_2()
    {
        return $this->site_date_2;
    }

    /**
     * Set site_date_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteDate_3($p_value)
    {
        $this->site_date_3 = $p_value;
        return $this;
    }

    /**
     * Get site_date_3
     *
     * @return mixed
     */
    public function getSiteDate_3()
    {
        return $this->site_date_3;
    }

    /**
     * Set site_date_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteDate_4($p_value)
    {
        $this->site_date_4 = $p_value;
        return $this;
    }

    /**
     * Get site_date_4
     *
     * @return mixed
     */
    public function getSiteDate_4()
    {
        return $this->site_date_4;
    }

    /**
     * Set site_text_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteText_1($p_value)
    {
        $this->site_text_1 = $p_value;
        return $this;
    }

    /**
     * Get site_text_1
     *
     * @return mixed
     */
    public function getSiteText_1()
    {
        return $this->site_text_1;
    }

    /**
     * Set site_text_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteText_2($p_value)
    {
        $this->site_text_2 = $p_value;
        return $this;
    }

    /**
     * Get site_text_2
     *
     * @return mixed
     */
    public function getSiteText_2()
    {
        return $this->site_text_2;
    }

    /**
     * Set site_text_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteText_3($p_value)
    {
        $this->site_text_3 = $p_value;
        return $this;
    }

    /**
     * Get site_text_3
     *
     * @return mixed
     */
    public function getSiteText_3()
    {
        return $this->site_text_3;
    }

    /**
     * Set site_text_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteText_4($p_value)
    {
        $this->site_text_4 = $p_value;
        return $this;
    }

    /**
     * Get site_text_4
     *
     * @return mixed
     */
    public function getSiteText_4()
    {
        return $this->site_text_4;
    }

    /**
     * Set site_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteBool_1($p_value)
    {
        $this->site_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get site_bool_1
     *
     * @return bool
     */
    public function getSiteBool_1()
    {
        return $this->site_bool_1;
    }

    /**
     * Set site_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteBool_2($p_value)
    {
        $this->site_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get site_bool_2
     *
     * @return bool
     */
    public function getSiteBool_2()
    {
        return $this->site_bool_2;
    }

    /**
     * Set site_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteBool_3($p_value)
    {
        $this->site_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get site_bool_3
     *
     * @return bool
     */
    public function getSiteBool_3()
    {
        return $this->site_bool_3;
    }

    /**
     * Set site_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteBool_4($p_value)
    {
        $this->site_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get site_bool_4
     *
     * @return bool
     */
    public function getSiteBool_4()
    {
        return $this->site_bool_4;
    }

    /**
     * Set site_coord
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCoord($p_value)
    {
        $this->site_coord = $p_value;
        return $this;
    }

    /**
     * Get site_coord
     *
     * @return string
     */
    public function getSiteCoord()
    {
        return $this->site_coord;
    }

    /**
     * Set site_code_ex
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteCodeEx($p_value)
    {
        $this->site_code_ex = $p_value;
        return $this;
    }

    /**
     * Get site_code_ex
     *
     * @return string
     */
    public function getSiteCodeEx()
    {
        return $this->site_code_ex;
    }

    /**
     * Set site_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteDesc($p_value)
    {
        $this->site_desc = $p_value;
        return $this;
    }

    /**
     * Get site_desc
     *
     * @return mixed
     */
    public function getSiteDesc()
    {
        return $this->site_desc;
    }

    /**
     * Set site_conform
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteConform($p_value)
    {
        $this->site_conform = $p_value;
        return $this;
    }

    /**
     * Get site_conform
     *
     * @return bool
     */
    public function getSiteConform()
    {
        return $this->site_conform;
    }

    /**
     * Set site_conform_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Site
     */
    public function setSiteConformText($p_value)
    {
        $this->site_conform_text = $p_value;
        return $this;
    }

    /**
     * Get site_conform_text
     *
     * @return mixed
     */
    public function getSiteConformText()
    {
        return $this->site_conform_text;
    }
}
