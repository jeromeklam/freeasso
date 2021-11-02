<?php
namespace FreeAsso\Model\Base;

/**
 * ClientType
 *
 * @author jeromeklam
 */
abstract class ClientType extends \FreeAsso\Model\StorageModel\ClientType
{

    /**
     * clit_id
     * @var int
     */
    protected $clit_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * clit_name
     * @var string
     */
    protected $clit_name = null;

    /**
     * clit_code
     * @var string
     */
    protected $clit_code = null;

    /**
     * clit_string_1
     * @var bool
     */
    protected $clit_string_1 = null;

    /**
     * clit_string_2
     * @var bool
     */
    protected $clit_string_2 = null;

    /**
     * clit_string_3
     * @var bool
     */
    protected $clit_string_3 = null;

    /**
     * clit_string_4
     * @var bool
     */
    protected $clit_string_4 = null;

    /**
     * clit_number_1
     * @var bool
     */
    protected $clit_number_1 = null;

    /**
     * clit_number_2
     * @var bool
     */
    protected $clit_number_2 = null;

    /**
     * clit_number_3
     * @var bool
     */
    protected $clit_number_3 = null;

    /**
     * clit_number_4
     * @var bool
     */
    protected $clit_number_4 = null;

    /**
     * clit_date_1
     * @var bool
     */
    protected $clit_date_1 = null;

    /**
     * clit_date_2
     * @var bool
     */
    protected $clit_date_2 = null;

    /**
     * clit_date_3
     * @var bool
     */
    protected $clit_date_3 = null;

    /**
     * clit_date_4
     * @var bool
     */
    protected $clit_date_4 = null;

    /**
     * clit_text_1
     * @var bool
     */
    protected $clit_text_1 = null;

    /**
     * clit_text_2
     * @var bool
     */
    protected $clit_text_2 = null;

    /**
     * clit_text_3
     * @var bool
     */
    protected $clit_text_3 = null;

    /**
     * clit_text_4
     * @var bool
     */
    protected $clit_text_4 = null;

    /**
     * clit_bool_1
     * @var bool
     */
    protected $clit_bool_1 = null;

    /**
     * clit_bool_2
     * @var bool
     */
    protected $clit_bool_2 = null;

    /**
     * clit_bool_3
     * @var bool
     */
    protected $clit_bool_3 = null;

    /**
     * clit_bool_4
     * @var bool
     */
    protected $clit_bool_4 = null;

    /**
     * Add email id
     *
     * @var int
     */
    protected $clit_add_email_id = null;

    /**
     * Update email id
     *
     * @var int
     */
    protected $clit_update_email_id = null;

    /**
     * End email id
     *
     * @var int
     */
    protected $clit_end_email_id = null;

    /**
     * Set clit_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitId($p_value)
    {
        $this->clit_id = $p_value;
        return $this;
    }

    /**
     * Get clit_id
     *
     * @return int
     */
    public function getClitId()
    {
        return $this->clit_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ClientType
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
     * Set clit_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitName($p_value)
    {
        $this->clit_name = $p_value;
        return $this;
    }

    /**
     * Get clit_name
     *
     * @return string
     */
    public function getClitName()
    {
        return $this->clit_name;
    }

    /**
     * Set clit_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitCode($p_value)
    {
        $this->clit_code = $p_value;
        return $this;
    }

    /**
     * Get clit_code
     *
     * @return string
     */
    public function getClitCode()
    {
        return $this->clit_code;
    }

    /**
     * Set clit_string_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitString_1($p_value)
    {
        $this->clit_string_1 = $p_value;
        return $this;
    }

    /**
     * Get clit_string_1
     *
     * @return bool
     */
    public function getClitString_1()
    {
        return $this->clit_string_1;
    }

    /**
     * Set clit_string_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitString_2($p_value)
    {
        $this->clit_string_2 = $p_value;
        return $this;
    }

    /**
     * Get clit_string_2
     *
     * @return bool
     */
    public function getClitString_2()
    {
        return $this->clit_string_2;
    }

    /**
     * Set clit_string_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitString_3($p_value)
    {
        $this->clit_string_3 = $p_value;
        return $this;
    }

    /**
     * Get clit_string_3
     *
     * @return bool
     */
    public function getClitString_3()
    {
        return $this->clit_string_3;
    }

    /**
     * Set clit_string_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitString_4($p_value)
    {
        $this->clit_string_4 = $p_value;
        return $this;
    }

    /**
     * Get clit_string_4
     *
     * @return bool
     */
    public function getClitString_4()
    {
        return $this->clit_string_4;
    }

    /**
     * Set clit_number_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitNumber_1($p_value)
    {
        $this->clit_number_1 = $p_value;
        return $this;
    }

    /**
     * Get clit_number_1
     *
     * @return bool
     */
    public function getClitNumber_1()
    {
        return $this->clit_number_1;
    }

    /**
     * Set clit_number_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitNumber_2($p_value)
    {
        $this->clit_number_2 = $p_value;
        return $this;
    }

    /**
     * Get clit_number_2
     *
     * @return bool
     */
    public function getClitNumber_2()
    {
        return $this->clit_number_2;
    }

    /**
     * Set clit_number_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitNumber_3($p_value)
    {
        $this->clit_number_3 = $p_value;
        return $this;
    }

    /**
     * Get clit_number_3
     *
     * @return bool
     */
    public function getClitNumber_3()
    {
        return $this->clit_number_3;
    }

    /**
     * Set clit_number_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitNumber_4($p_value)
    {
        $this->clit_number_4 = $p_value;
        return $this;
    }

    /**
     * Get clit_number_4
     *
     * @return bool
     */
    public function getClitNumber_4()
    {
        return $this->clit_number_4;
    }

    /**
     * Set clit_date_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitDate_1($p_value)
    {
        $this->clit_date_1 = $p_value;
        return $this;
    }

    /**
     * Get clit_date_1
     *
     * @return bool
     */
    public function getClitDate_1()
    {
        return $this->clit_date_1;
    }

    /**
     * Set clit_date_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitDate_2($p_value)
    {
        $this->clit_date_2 = $p_value;
        return $this;
    }

    /**
     * Get clit_date_2
     *
     * @return bool
     */
    public function getClitDate_2()
    {
        return $this->clit_date_2;
    }

    /**
     * Set clit_date_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitDate_3($p_value)
    {
        $this->clit_date_3 = $p_value;
        return $this;
    }

    /**
     * Get clit_date_3
     *
     * @return bool
     */
    public function getClitDate_3()
    {
        return $this->clit_date_3;
    }

    /**
     * Set clit_date_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitDate_4($p_value)
    {
        $this->clit_date_4 = $p_value;
        return $this;
    }

    /**
     * Get clit_date_4
     *
     * @return bool
     */
    public function getClitDate_4()
    {
        return $this->clit_date_4;
    }

    /**
     * Set clit_text_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitText_1($p_value)
    {
        $this->clit_text_1 = $p_value;
        return $this;
    }

    /**
     * Get clit_text_1
     *
     * @return bool
     */
    public function getClitText_1()
    {
        return $this->clit_text_1;
    }

    /**
     * Set clit_text_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitText_2($p_value)
    {
        $this->clit_text_2 = $p_value;
        return $this;
    }

    /**
     * Get clit_text_2
     *
     * @return bool
     */
    public function getClitText_2()
    {
        return $this->clit_text_2;
    }

    /**
     * Set clit_text_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitText_3($p_value)
    {
        $this->clit_text_3 = $p_value;
        return $this;
    }

    /**
     * Get clit_text_3
     *
     * @return bool
     */
    public function getClitText_3()
    {
        return $this->clit_text_3;
    }

    /**
     * Set clit_text_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitText_4($p_value)
    {
        $this->clit_text_4 = $p_value;
        return $this;
    }

    /**
     * Get clit_text_4
     *
     * @return bool
     */
    public function getClitText_4()
    {
        return $this->clit_text_4;
    }

    /**
     * Set clit_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitBool_1($p_value)
    {
        $this->clit_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get clit_bool_1
     *
     * @return bool
     */
    public function getClitBool_1()
    {
        return $this->clit_bool_1;
    }

    /**
     * Set clit_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitBool_2($p_value)
    {
        $this->clit_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get clit_bool_2
     *
     * @return bool
     */
    public function getClitBool_2()
    {
        return $this->clit_bool_2;
    }

    /**
     * Set clit_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitBool_3($p_value)
    {
        $this->clit_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get clit_bool_3
     *
     * @return bool
     */
    public function getClitBool_3()
    {
        return $this->clit_bool_3;
    }

    /**
     * Set clit_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ClientType
     */
    public function setClitBool_4($p_value)
    {
        $this->clit_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get clit_bool_4
     *
     * @return bool
     */
    public function getClitBool_4()
    {
        return $this->clit_bool_4;
    }
}
