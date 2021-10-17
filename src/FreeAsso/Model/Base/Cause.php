<?php
namespace FreeAsso\Model\Base;

/**
 * Cause
 *
 * @author jeromeklam
 */
abstract class Cause extends \FreeAsso\Model\StorageModel\Cause
{

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * caut_id
     * @var int
     */
    protected $caut_id = null;

    /**
     * cau_name
     * @var string
     */
    protected $cau_name = null;

    /**
     * cau_desc
     * @var mixed
     */
    protected $cau_desc = null;

    /**
     * cau_from
     * @var mixed
     */
    protected $cau_from = null;

    /**
     * cau_to
     * @var mixed
     */
    protected $cau_to = null;

    /**
     * cau_public
     * @var bool
     */
    protected $cau_public = null;

    /**
     * cau_available
     * @var bool
     */
    protected $cau_available = null;

    /**
     * sspe_id
     * @var int
     */
    protected $sspe_id = null;

    /**
     * site_id
     * @var int
     */
    protected $site_id = null;

    /**
     * orig_cli_id
     * @var int
     */
    protected $orig_cli_id = null;

    /**
     * rais_cli_id
     * @var int
     */
    protected $rais_cli_id = null;

    /**
     * cau_mnt
     * @var mixed
     */
    protected $cau_mnt = null;

    /**
     * cau_mnt_left
     * @var mixed
     */
    protected $cau_mnt_left = null;

    /**
     * cau_money
     * @var string
     */
    protected $cau_money = null;

    /**
     * cau_code
     * @var string
     */
    protected $cau_code = null;

    /**
     * cau_family
     * @var string
     */
    protected $cau_family = null;

    /**
     * cau_sex
     * @var string
     */
    protected $cau_sex = null;

    /**
     * cau_year
     * @var int
     */
    protected $cau_year = null;

    /**
     * cau_string_1
     * @var string
     */
    protected $cau_string_1 = null;

    /**
     * cau_string_2
     * @var string
     */
    protected $cau_string_2 = null;

    /**
     * cau_string_3
     * @var string
     */
    protected $cau_string_3 = null;

    /**
     * cau_string_4
     * @var string
     */
    protected $cau_string_4 = null;

    /**
     * cau_number_1
     * @var int
     */
    protected $cau_number_1 = null;

    /**
     * cau_number_2
     * @var int
     */
    protected $cau_number_2 = null;

    /**
     * cau_number_3
     * @var int
     */
    protected $cau_number_3 = null;

    /**
     * cau_number_4
     * @var int
     */
    protected $cau_number_4 = null;

    /**
     * cau_date_1
     * @var mixed
     */
    protected $cau_date_1 = null;

    /**
     * cau_date_2
     * @var mixed
     */
    protected $cau_date_2 = null;

    /**
     * cau_date_3
     * @var mixed
     */
    protected $cau_date_3 = null;

    /**
     * cau_date_4
     * @var mixed
     */
    protected $cau_date_4 = null;

    /**
     * cau_text_1
     * @var mixed
     */
    protected $cau_text_1 = null;

    /**
     * cau_text_2
     * @var mixed
     */
    protected $cau_text_2 = null;

    /**
     * cau_text_3
     * @var mixed
     */
    protected $cau_text_3 = null;

    /**
     * cau_text_4
     * @var mixed
     */
    protected $cau_text_4 = null;

    /**
     * cau_bool_1
     * @var bool
     */
    protected $cau_bool_1 = null;

    /**
     * cau_bool_2
     * @var bool
     */
    protected $cau_bool_2 = null;

    /**
     * cau_bool_3
     * @var bool
     */
    protected $cau_bool_3 = null;

    /**
     * cau_bool_4
     * @var bool
     */
    protected $cau_bool_4 = null;

    /**
     * cau_coord
     * @var string
     */
    protected $cau_coord = null;

    /**
     * parent1_cau_id
     * @var int
     */
    protected $parent1_cau_id = null;

    /**
     * parent2_cau_id
     * @var int
     */
    protected $parent2_cau_id = null;

    /**
     * caum_text_id
     * @var int
     */
    protected $caum_text_id = null;

    /**
     * caum_blob_id
     * @var int
     */
    protected $caum_blob_id = null;

    /**
     * cau_unit_unit
     * @var string
     */
    protected $cau_unit_unit = null;

    /**
     * cau_unit_mnt
     * @var mixed
     */
    protected $cau_unit_mnt = null;

    /**
     * cau_unit_base
     * @var mixed
     */
    protected $cau_unit_base = null;

    /**
     * cau_waiting
     * @var bool
     */
    protected $cau_waiting = null;

    /**
     * cau_conform
     * @var bool
     */
    protected $cau_conform = null;

    /**
     * cau_conform_text
     * @var mixed
     */
    protected $cau_conform_text = null;

    /**
     * grp_id
     * @var int
     */
    protected $grp_id = null;

    /**
     * cau_last_news
     * @var mixed
     */
    protected $cau_last_news = null;

    /**
     * cau_last_photo
     * @var mixed
     */
    protected $cau_last_photo = null;

    /**
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauId($p_value)
    {
        $this->cau_id = $p_value;
        return $this;
    }

    /**
     * Get cau_id
     *
     * @return int
     */
    public function getCauId()
    {
        return $this->cau_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
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
     * Set caut_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCautId($p_value)
    {
        $this->caut_id = $p_value;
        return $this;
    }

    /**
     * Get caut_id
     *
     * @return int
     */
    public function getCautId()
    {
        return $this->caut_id;
    }

    /**
     * Set cau_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauName($p_value)
    {
        $this->cau_name = $p_value;
        return $this;
    }

    /**
     * Get cau_name
     *
     * @return string
     */
    public function getCauName()
    {
        return $this->cau_name;
    }

    /**
     * Set cau_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDesc($p_value)
    {
        $this->cau_desc = $p_value;
        return $this;
    }

    /**
     * Get cau_desc
     *
     * @return mixed
     */
    public function getCauDesc()
    {
        return $this->cau_desc;
    }

    /**
     * Set cau_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauFrom($p_value)
    {
        $this->cau_from = $p_value;
        return $this;
    }

    /**
     * Get cau_from
     *
     * @return mixed
     */
    public function getCauFrom()
    {
        return $this->cau_from;
    }

    /**
     * Set cau_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauTo($p_value)
    {
        $this->cau_to = $p_value;
        return $this;
    }

    /**
     * Get cau_to
     *
     * @return mixed
     */
    public function getCauTo()
    {
        return $this->cau_to;
    }

    /**
     * Set cau_public
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauPublic($p_value)
    {
        $this->cau_public = $p_value;
        return $this;
    }

    /**
     * Get cau_public
     *
     * @return bool
     */
    public function getCauPublic()
    {
        return $this->cau_public;
    }

    /**
     * Set cau_available
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauAvailable($p_value)
    {
        $this->cau_available = $p_value;
        return $this;
    }

    /**
     * Get cau_available
     *
     * @return bool
     */
    public function getCauAvailable()
    {
        return $this->cau_available;
    }

    /**
     * Set sspe_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setSspeId($p_value)
    {
        $this->sspe_id = $p_value;
        return $this;
    }

    /**
     * Get sspe_id
     *
     * @return int
     */
    public function getSspeId()
    {
        return $this->sspe_id;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
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
     * Set orig_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setOrigCliId($p_value)
    {
        $this->orig_cli_id = $p_value;
        return $this;
    }

    /**
     * Get orig_cli_id
     *
     * @return int
     */
    public function getOrigCliId()
    {
        return $this->orig_cli_id;
    }

    /**
     * Set rais_cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setRaisCliId($p_value)
    {
        $this->rais_cli_id = $p_value;
        return $this;
    }

    /**
     * Get rais_cli_id
     *
     * @return int
     */
    public function getRaisCliId()
    {
        return $this->rais_cli_id;
    }

    /**
     * Set cau_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauMnt($p_value)
    {
        $this->cau_mnt = $p_value;
        return $this;
    }

    /**
     * Get cau_mnt
     *
     * @return mixed
     */
    public function getCauMnt()
    {
        return $this->cau_mnt;
    }

    /**
     * Set cau_mnt_left
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauMntLeft($p_value)
    {
        $this->cau_mnt_left = $p_value;
        return $this;
    }

    /**
     * Get cau_mnt_left
     *
     * @return mixed
     */
    public function getCauMntLeft()
    {
        return $this->cau_mnt_left;
    }

    /**
     * Set cau_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauMoney($p_value)
    {
        $this->cau_money = $p_value;
        return $this;
    }

    /**
     * Get cau_money
     *
     * @return string
     */
    public function getCauMoney()
    {
        return $this->cau_money;
    }

    /**
     * Set cau_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauCode($p_value)
    {
        $this->cau_code = $p_value;
        return $this;
    }

    /**
     * Get cau_code
     *
     * @return string
     */
    public function getCauCode()
    {
        return $this->cau_code;
    }

    /**
     * Set cau_family
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauFamily($p_value)
    {
        $this->cau_family = $p_value;
        return $this;
    }

    /**
     * Get cau_family
     *
     * @return string
     */
    public function getCauFamily()
    {
        return $this->cau_family;
    }

    /**
     * Set cau_sex
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauSex($p_value)
    {
        $this->cau_sex = $p_value;
        return $this;
    }

    /**
     * Get cau_sex
     *
     * @return string
     */
    public function getCauSex()
    {
        return $this->cau_sex;
    }

    /**
     * Set cau_year
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauYear($p_value)
    {
        $this->cau_year = $p_value;
        return $this;
    }

    /**
     * Get cau_year
     *
     * @return int
     */
    public function getCauYear()
    {
        return $this->cau_year;
    }

    /**
     * Set cau_string_1
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauString_1($p_value)
    {
        $this->cau_string_1 = $p_value;
        return $this;
    }

    /**
     * Get cau_string_1
     *
     * @return string
     */
    public function getCauString_1()
    {
        return $this->cau_string_1;
    }

    /**
     * Set cau_string_2
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauString_2($p_value)
    {
        $this->cau_string_2 = $p_value;
        return $this;
    }

    /**
     * Get cau_string_2
     *
     * @return string
     */
    public function getCauString_2()
    {
        return $this->cau_string_2;
    }

    /**
     * Set cau_string_3
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauString_3($p_value)
    {
        $this->cau_string_3 = $p_value;
        return $this;
    }

    /**
     * Get cau_string_3
     *
     * @return string
     */
    public function getCauString_3()
    {
        return $this->cau_string_3;
    }

    /**
     * Set cau_string_4
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauString_4($p_value)
    {
        $this->cau_string_4 = $p_value;
        return $this;
    }

    /**
     * Get cau_string_4
     *
     * @return string
     */
    public function getCauString_4()
    {
        return $this->cau_string_4;
    }

    /**
     * Set cau_number_1
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauNumber_1($p_value)
    {
        $this->cau_number_1 = $p_value;
        return $this;
    }

    /**
     * Get cau_number_1
     *
     * @return int
     */
    public function getCauNumber_1()
    {
        return $this->cau_number_1;
    }

    /**
     * Set cau_number_2
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauNumber_2($p_value)
    {
        $this->cau_number_2 = $p_value;
        return $this;
    }

    /**
     * Get cau_number_2
     *
     * @return int
     */
    public function getCauNumber_2()
    {
        return $this->cau_number_2;
    }

    /**
     * Set cau_number_3
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauNumber_3($p_value)
    {
        $this->cau_number_3 = $p_value;
        return $this;
    }

    /**
     * Get cau_number_3
     *
     * @return int
     */
    public function getCauNumber_3()
    {
        return $this->cau_number_3;
    }

    /**
     * Set cau_number_4
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauNumber_4($p_value)
    {
        $this->cau_number_4 = $p_value;
        return $this;
    }

    /**
     * Get cau_number_4
     *
     * @return int
     */
    public function getCauNumber_4()
    {
        return $this->cau_number_4;
    }

    /**
     * Set cau_date_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDate_1($p_value)
    {
        $this->cau_date_1 = $p_value;
        return $this;
    }

    /**
     * Get cau_date_1
     *
     * @return mixed
     */
    public function getCauDate_1()
    {
        return $this->cau_date_1;
    }

    /**
     * Set cau_date_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDate_2($p_value)
    {
        $this->cau_date_2 = $p_value;
        return $this;
    }

    /**
     * Get cau_date_2
     *
     * @return mixed
     */
    public function getCauDate_2()
    {
        return $this->cau_date_2;
    }

    /**
     * Set cau_date_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDate_3($p_value)
    {
        $this->cau_date_3 = $p_value;
        return $this;
    }

    /**
     * Get cau_date_3
     *
     * @return mixed
     */
    public function getCauDate_3()
    {
        return $this->cau_date_3;
    }

    /**
     * Set cau_date_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauDate_4($p_value)
    {
        $this->cau_date_4 = $p_value;
        return $this;
    }

    /**
     * Get cau_date_4
     *
     * @return mixed
     */
    public function getCauDate_4()
    {
        return $this->cau_date_4;
    }

    /**
     * Set cau_text_1
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauText_1($p_value)
    {
        $this->cau_text_1 = $p_value;
        return $this;
    }

    /**
     * Get cau_text_1
     *
     * @return mixed
     */
    public function getCauText_1()
    {
        return $this->cau_text_1;
    }

    /**
     * Set cau_text_2
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauText_2($p_value)
    {
        $this->cau_text_2 = $p_value;
        return $this;
    }

    /**
     * Get cau_text_2
     *
     * @return mixed
     */
    public function getCauText_2()
    {
        return $this->cau_text_2;
    }

    /**
     * Set cau_text_3
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauText_3($p_value)
    {
        $this->cau_text_3 = $p_value;
        return $this;
    }

    /**
     * Get cau_text_3
     *
     * @return mixed
     */
    public function getCauText_3()
    {
        return $this->cau_text_3;
    }

    /**
     * Set cau_text_4
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauText_4($p_value)
    {
        $this->cau_text_4 = $p_value;
        return $this;
    }

    /**
     * Get cau_text_4
     *
     * @return mixed
     */
    public function getCauText_4()
    {
        return $this->cau_text_4;
    }

    /**
     * Set cau_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauBool_1($p_value)
    {
        $this->cau_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get cau_bool_1
     *
     * @return bool
     */
    public function getCauBool_1()
    {
        return $this->cau_bool_1;
    }

    /**
     * Set cau_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauBool_2($p_value)
    {
        $this->cau_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get cau_bool_2
     *
     * @return bool
     */
    public function getCauBool_2()
    {
        return $this->cau_bool_2;
    }

    /**
     * Set cau_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauBool_3($p_value)
    {
        $this->cau_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get cau_bool_3
     *
     * @return bool
     */
    public function getCauBool_3()
    {
        return $this->cau_bool_3;
    }

    /**
     * Set cau_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauBool_4($p_value)
    {
        $this->cau_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get cau_bool_4
     *
     * @return bool
     */
    public function getCauBool_4()
    {
        return $this->cau_bool_4;
    }

    /**
     * Set cau_coord
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauCoord($p_value)
    {
        $this->cau_coord = $p_value;
        return $this;
    }

    /**
     * Get cau_coord
     *
     * @return string
     */
    public function getCauCoord()
    {
        return $this->cau_coord;
    }

    /**
     * Set parent1_cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent1CauId($p_value)
    {
        $this->parent1_cau_id = $p_value;
        return $this;
    }

    /**
     * Get parent1_cau_id
     *
     * @return int
     */
    public function getParent1CauId()
    {
        return $this->parent1_cau_id;
    }

    /**
     * Set parent2_cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent2CauId($p_value)
    {
        $this->parent2_cau_id = $p_value;
        return $this;
    }

    /**
     * Get parent2_cau_id
     *
     * @return int
     */
    public function getParent2CauId()
    {
        return $this->parent2_cau_id;
    }

    /**
     * Set caum_text_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCaumTextId($p_value)
    {
        $this->caum_text_id = $p_value;
        return $this;
    }

    /**
     * Get caum_text_id
     *
     * @return int
     */
    public function getCaumTextId()
    {
        return $this->caum_text_id;
    }

    /**
     * Set caum_blob_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCaumBlobId($p_value)
    {
        $this->caum_blob_id = $p_value;
        return $this;
    }

    /**
     * Get caum_blob_id
     *
     * @return int
     */
    public function getCaumBlobId()
    {
        return $this->caum_blob_id;
    }

    /**
     * Set cau_unit_unit
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauUnitUnit($p_value)
    {
        $this->cau_unit_unit = $p_value;
        return $this;
    }

    /**
     * Get cau_unit_unit
     *
     * @return string
     */
    public function getCauUnitUnit()
    {
        return $this->cau_unit_unit;
    }

    /**
     * Set cau_unit_mnt
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauUnitMnt($p_value)
    {
        $this->cau_unit_mnt = $p_value;
        return $this;
    }

    /**
     * Get cau_unit_mnt
     *
     * @return mixed
     */
    public function getCauUnitMnt()
    {
        return $this->cau_unit_mnt;
    }

    /**
     * Set cau_unit_base
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauUnitBase($p_value)
    {
        $this->cau_unit_base = $p_value;
        return $this;
    }

    /**
     * Get cau_unit_base
     *
     * @return mixed
     */
    public function getCauUnitBase()
    {
        return $this->cau_unit_base;
    }

    /**
     * Set cau_waiting
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauWaiting($p_value)
    {
        $this->cau_waiting = $p_value;
        return $this;
    }

    /**
     * Get cau_waiting
     *
     * @return bool
     */
    public function getCauWaiting()
    {
        return $this->cau_waiting;
    }

    /**
     * Set cau_conform
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauConform($p_value)
    {
        $this->cau_conform = $p_value;
        return $this;
    }

    /**
     * Get cau_conform
     *
     * @return bool
     */
    public function getCauConform()
    {
        return $this->cau_conform;
    }

    /**
     * Set cau_conform_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauConformText($p_value)
    {
        $this->cau_conform_text = $p_value;
        return $this;
    }

    /**
     * Get cau_conform_text
     *
     * @return mixed
     */
    public function getCauConformText()
    {
        return $this->cau_conform_text;
    }

    /**
     * Set grp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\Cause
     */
    public function setGrpId($p_value)
    {
        $this->grp_id = $p_value;
        return $this;
    }

    /**
     * Get grp_id
     *
     * @return int
     */
    public function getGrpId()
    {
        return $this->grp_id;
    }

    /**
     * Set cau_last_news
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauLastNews($p_value)
    {
        $this->cau_last_news = $p_value;
        return $this;
    }

    /**
     * Get cau_last_news
     *
     * @return mixed
     */
    public function getCauLastNews()
    {
        return $this->cau_last_news;
    }

    /**
     * Set cau_last_photo
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setCauLastPhoto($p_value)
    {
        $this->cau_last_photo = $p_value;
        return $this;
    }

    /**
     * Get cau_last_photo
     *
     * @return mixed
     */
    public function getCauLastPhoto()
    {
        return $this->cau_last_photo;
    }
}
