<?php
namespace FreeAsso\Model\Base;

/**
 * CauseType
 *
 * @author jeromeklam
 */
abstract class CauseType extends \FreeAsso\Model\StorageModel\CauseType
{

    /**
     * caut_id
     * @var int
     */
    protected $caut_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * camt_id
     * @var int
     */
    protected $camt_id = null;

    /**
     * caut_name
     * @var string
     */
    protected $caut_name = null;

    /**
     * caut_pattern
     * @var string
     */
    protected $caut_pattern = null;

    /**
     * caut_mask
     * @var string
     */
    protected $caut_mask = null;

    /**
     * caut_receipt
     * @var bool
     */
    protected $caut_receipt = null;

    /**
     * caut_max_mnt
     * @var int
     */
    protected $caut_max_mnt = null;

    /**
     * caut_min_mnt
     * @var int
     */
    protected $caut_min_mnt = null;

    /**
     * caut_money
     * @var string
     */
    protected $caut_money = null;

    /**
     * caut_mnt_type
     * @var string
     */
    protected $caut_mnt_type = null;

    /**
     * caut_certificat
     * @var bool
     */
    protected $caut_certificat = null;

    /**
     * caut_donation
     * @var string
     */
    protected $caut_donation = null;

    /**
     * caut_once_duration
     * @var string
     */
    protected $caut_once_duration = null;

    /**
     * caut_regular_duration
     * @var string
     */
    protected $caut_regular_duration = null;

    /**
     * caut_news
     * @var bool
     */
    protected $caut_news = null;

    /**
     * caut_family
     * @var string
     */
    protected $caut_family = null;

    /**
     * caut_string_1
     * @var bool
     */
    protected $caut_string_1 = null;

    /**
     * caut_string_2
     * @var bool
     */
    protected $caut_string_2 = null;

    /**
     * caut_string_3
     * @var bool
     */
    protected $caut_string_3 = null;

    /**
     * caut_string_4
     * @var bool
     */
    protected $caut_string_4 = null;

    /**
     * caut_number_1
     * @var bool
     */
    protected $caut_number_1 = null;

    /**
     * caut_number_2
     * @var bool
     */
    protected $caut_number_2 = null;

    /**
     * caut_number_3
     * @var bool
     */
    protected $caut_number_3 = null;

    /**
     * caut_number_4
     * @var bool
     */
    protected $caut_number_4 = null;

    /**
     * caut_date_1
     * @var bool
     */
    protected $caut_date_1 = null;

    /**
     * caut_date_2
     * @var bool
     */
    protected $caut_date_2 = null;

    /**
     * caut_date_3
     * @var bool
     */
    protected $caut_date_3 = null;

    /**
     * caut_date_4
     * @var bool
     */
    protected $caut_date_4 = null;

    /**
     * caut_text_1
     * @var bool
     */
    protected $caut_text_1 = null;

    /**
     * caut_text_2
     * @var bool
     */
    protected $caut_text_2 = null;

    /**
     * caut_text_3
     * @var bool
     */
    protected $caut_text_3 = null;

    /**
     * caut_text_4
     * @var bool
     */
    protected $caut_text_4 = null;

    /**
     * caut_bool_1
     * @var bool
     */
    protected $caut_bool_1 = null;

    /**
     * caut_bool_2
     * @var bool
     */
    protected $caut_bool_2 = null;

    /**
     * caut_bool_3
     * @var bool
     */
    protected $caut_bool_3 = null;

    /**
     * caut_bool_4
     * @var bool
     */
    protected $caut_bool_4 = null;

    /**
     * caut_max_weight
     * @var mixed
     */
    protected $caut_max_weight = null;

    /**
     * caut_max_height
     * @var mixed
     */
    protected $caut_max_height = null;

    /**
     * caut_growth_freq
     * @var int
     */
    protected $caut_growth_freq = null;

    /**
     * caut_growth_graph
     * @var mixed
     */
    protected $caut_growth_graph = null;

    /**
     * caut_rec_edi_id
     * @var int
     */
    protected $caut_rec_edi_id = null;

    /**
     * caut_cert_edi_id
     * @var int
     */
    protected $caut_cert_edi_id = null;

    /**
     * caut_ident_edi_id
     * @var int
     */
    protected $caut_ident_edi_id = null;

    /**
     * caut_add_email_id
     * @var int
     */
    protected $caut_add_email_id = null;

    /**
     * caut_update_email_id
     * @var int
     */
    protected $caut_update_email_id = null;

    /**
     * caut_end_email_id
     * @var int
     */
    protected $caut_end_email_id = null;

    /**
     * caut_spo_add_email_id
     * @var int
     */
    protected $caut_spo_add_email_id = null;

    /**
     * caut_spo_update_email_id
     * @var int
     */
    protected $caut_spo_update_email_id = null;

    /**
     * caut_spo_end_email_id
     * @var int
     */
    protected $caut_spo_end_email_id = null;

    /**
     * caut_don_add_email_id
     * @var int
     */
    protected $caut_don_add_email_id = null;

    /**
     * caut_don_update_email_id
     * @var int
     */
    protected $caut_don_update_email_id = null;

    /**
     * caut_don_end_email_id
     * @var int
     */
    protected $caut_don_end_email_id = null;

    /**
     * caut_don_generate_email_id
     * @var int
     */
    protected $caut_don_generate_email_id = null;

    /**
     * Set caut_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
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
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
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
     * Set camt_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCamtId($p_value)
    {
        $this->camt_id = $p_value;
        return $this;
    }

    /**
     * Get camt_id
     *
     * @return int
     */
    public function getCamtId()
    {
        return $this->camt_id;
    }

    /**
     * Set caut_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautName($p_value)
    {
        $this->caut_name = $p_value;
        return $this;
    }

    /**
     * Get caut_name
     *
     * @return string
     */
    public function getCautName()
    {
        return $this->caut_name;
    }

    /**
     * Set caut_pattern
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautPattern($p_value)
    {
        $this->caut_pattern = $p_value;
        return $this;
    }

    /**
     * Get caut_pattern
     *
     * @return string
     */
    public function getCautPattern()
    {
        return $this->caut_pattern;
    }

    /**
     * Set caut_mask
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMask($p_value)
    {
        $this->caut_mask = $p_value;
        return $this;
    }

    /**
     * Get caut_mask
     *
     * @return string
     */
    public function getCautMask()
    {
        return $this->caut_mask;
    }

    /**
     * Set caut_receipt
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautReceipt($p_value)
    {
        $this->caut_receipt = $p_value;
        return $this;
    }

    /**
     * Get caut_receipt
     *
     * @return bool
     */
    public function getCautReceipt()
    {
        return $this->caut_receipt;
    }

    /**
     * Set caut_max_mnt
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMaxMnt($p_value)
    {
        $this->caut_max_mnt = $p_value;
        return $this;
    }

    /**
     * Get caut_max_mnt
     *
     * @return int
     */
    public function getCautMaxMnt()
    {
        return $this->caut_max_mnt;
    }

    /**
     * Set caut_min_mnt
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMinMnt($p_value)
    {
        $this->caut_min_mnt = $p_value;
        return $this;
    }

    /**
     * Get caut_min_mnt
     *
     * @return int
     */
    public function getCautMinMnt()
    {
        return $this->caut_min_mnt;
    }

    /**
     * Set caut_money
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMoney($p_value)
    {
        $this->caut_money = $p_value;
        return $this;
    }

    /**
     * Get caut_money
     *
     * @return string
     */
    public function getCautMoney()
    {
        return $this->caut_money;
    }

    /**
     * Set caut_mnt_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMntType($p_value)
    {
        $this->caut_mnt_type = $p_value;
        return $this;
    }

    /**
     * Get caut_mnt_type
     *
     * @return string
     */
    public function getCautMntType()
    {
        return $this->caut_mnt_type;
    }

    /**
     * Set caut_certificat
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautCertificat($p_value)
    {
        $this->caut_certificat = $p_value;
        return $this;
    }

    /**
     * Get caut_certificat
     *
     * @return bool
     */
    public function getCautCertificat()
    {
        return $this->caut_certificat;
    }

    /**
     * Set caut_donation
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDonation($p_value)
    {
        $this->caut_donation = $p_value;
        return $this;
    }

    /**
     * Get caut_donation
     *
     * @return string
     */
    public function getCautDonation()
    {
        return $this->caut_donation;
    }

    /**
     * Set caut_once_duration
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautOnceDuration($p_value)
    {
        $this->caut_once_duration = $p_value;
        return $this;
    }

    /**
     * Get caut_once_duration
     *
     * @return string
     */
    public function getCautOnceDuration()
    {
        return $this->caut_once_duration;
    }

    /**
     * Set caut_regular_duration
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautRegularDuration($p_value)
    {
        $this->caut_regular_duration = $p_value;
        return $this;
    }

    /**
     * Get caut_regular_duration
     *
     * @return string
     */
    public function getCautRegularDuration()
    {
        return $this->caut_regular_duration;
    }

    /**
     * Set caut_news
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautNews($p_value)
    {
        $this->caut_news = $p_value;
        return $this;
    }

    /**
     * Get caut_news
     *
     * @return bool
     */
    public function getCautNews()
    {
        return $this->caut_news;
    }

    /**
     * Set caut_family
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautFamily($p_value)
    {
        $this->caut_family = $p_value;
        return $this;
    }

    /**
     * Get caut_family
     *
     * @return string
     */
    public function getCautFamily()
    {
        return $this->caut_family;
    }

    /**
     * Set caut_string_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautString_1($p_value)
    {
        $this->caut_string_1 = $p_value;
        return $this;
    }

    /**
     * Get caut_string_1
     *
     * @return bool
     */
    public function getCautString_1()
    {
        return $this->caut_string_1;
    }

    /**
     * Set caut_string_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautString_2($p_value)
    {
        $this->caut_string_2 = $p_value;
        return $this;
    }

    /**
     * Get caut_string_2
     *
     * @return bool
     */
    public function getCautString_2()
    {
        return $this->caut_string_2;
    }

    /**
     * Set caut_string_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautString_3($p_value)
    {
        $this->caut_string_3 = $p_value;
        return $this;
    }

    /**
     * Get caut_string_3
     *
     * @return bool
     */
    public function getCautString_3()
    {
        return $this->caut_string_3;
    }

    /**
     * Set caut_string_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautString_4($p_value)
    {
        $this->caut_string_4 = $p_value;
        return $this;
    }

    /**
     * Get caut_string_4
     *
     * @return bool
     */
    public function getCautString_4()
    {
        return $this->caut_string_4;
    }

    /**
     * Set caut_number_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautNumber_1($p_value)
    {
        $this->caut_number_1 = $p_value;
        return $this;
    }

    /**
     * Get caut_number_1
     *
     * @return bool
     */
    public function getCautNumber_1()
    {
        return $this->caut_number_1;
    }

    /**
     * Set caut_number_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautNumber_2($p_value)
    {
        $this->caut_number_2 = $p_value;
        return $this;
    }

    /**
     * Get caut_number_2
     *
     * @return bool
     */
    public function getCautNumber_2()
    {
        return $this->caut_number_2;
    }

    /**
     * Set caut_number_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautNumber_3($p_value)
    {
        $this->caut_number_3 = $p_value;
        return $this;
    }

    /**
     * Get caut_number_3
     *
     * @return bool
     */
    public function getCautNumber_3()
    {
        return $this->caut_number_3;
    }

    /**
     * Set caut_number_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautNumber_4($p_value)
    {
        $this->caut_number_4 = $p_value;
        return $this;
    }

    /**
     * Get caut_number_4
     *
     * @return bool
     */
    public function getCautNumber_4()
    {
        return $this->caut_number_4;
    }

    /**
     * Set caut_date_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDate_1($p_value)
    {
        $this->caut_date_1 = $p_value;
        return $this;
    }

    /**
     * Get caut_date_1
     *
     * @return bool
     */
    public function getCautDate_1()
    {
        return $this->caut_date_1;
    }

    /**
     * Set caut_date_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDate_2($p_value)
    {
        $this->caut_date_2 = $p_value;
        return $this;
    }

    /**
     * Get caut_date_2
     *
     * @return bool
     */
    public function getCautDate_2()
    {
        return $this->caut_date_2;
    }

    /**
     * Set caut_date_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDate_3($p_value)
    {
        $this->caut_date_3 = $p_value;
        return $this;
    }

    /**
     * Get caut_date_3
     *
     * @return bool
     */
    public function getCautDate_3()
    {
        return $this->caut_date_3;
    }

    /**
     * Set caut_date_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautDate_4($p_value)
    {
        $this->caut_date_4 = $p_value;
        return $this;
    }

    /**
     * Get caut_date_4
     *
     * @return bool
     */
    public function getCautDate_4()
    {
        return $this->caut_date_4;
    }

    /**
     * Set caut_text_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautText_1($p_value)
    {
        $this->caut_text_1 = $p_value;
        return $this;
    }

    /**
     * Get caut_text_1
     *
     * @return bool
     */
    public function getCautText_1()
    {
        return $this->caut_text_1;
    }

    /**
     * Set caut_text_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautText_2($p_value)
    {
        $this->caut_text_2 = $p_value;
        return $this;
    }

    /**
     * Get caut_text_2
     *
     * @return bool
     */
    public function getCautText_2()
    {
        return $this->caut_text_2;
    }

    /**
     * Set caut_text_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautText_3($p_value)
    {
        $this->caut_text_3 = $p_value;
        return $this;
    }

    /**
     * Get caut_text_3
     *
     * @return bool
     */
    public function getCautText_3()
    {
        return $this->caut_text_3;
    }

    /**
     * Set caut_text_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautText_4($p_value)
    {
        $this->caut_text_4 = $p_value;
        return $this;
    }

    /**
     * Get caut_text_4
     *
     * @return bool
     */
    public function getCautText_4()
    {
        return $this->caut_text_4;
    }

    /**
     * Set caut_bool_1
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautBool_1($p_value)
    {
        $this->caut_bool_1 = $p_value;
        return $this;
    }

    /**
     * Get caut_bool_1
     *
     * @return bool
     */
    public function getCautBool_1()
    {
        return $this->caut_bool_1;
    }

    /**
     * Set caut_bool_2
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautBool_2($p_value)
    {
        $this->caut_bool_2 = $p_value;
        return $this;
    }

    /**
     * Get caut_bool_2
     *
     * @return bool
     */
    public function getCautBool_2()
    {
        return $this->caut_bool_2;
    }

    /**
     * Set caut_bool_3
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautBool_3($p_value)
    {
        $this->caut_bool_3 = $p_value;
        return $this;
    }

    /**
     * Get caut_bool_3
     *
     * @return bool
     */
    public function getCautBool_3()
    {
        return $this->caut_bool_3;
    }

    /**
     * Set caut_bool_4
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautBool_4($p_value)
    {
        $this->caut_bool_4 = $p_value;
        return $this;
    }

    /**
     * Get caut_bool_4
     *
     * @return bool
     */
    public function getCautBool_4()
    {
        return $this->caut_bool_4;
    }

    /**
     * Set caut_max_weight
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMaxWeight($p_value)
    {
        $this->caut_max_weight = $p_value;
        return $this;
    }

    /**
     * Get caut_max_weight
     *
     * @return mixed
     */
    public function getCautMaxWeight()
    {
        return $this->caut_max_weight;
    }

    /**
     * Set caut_max_height
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautMaxHeight($p_value)
    {
        $this->caut_max_height = $p_value;
        return $this;
    }

    /**
     * Get caut_max_height
     *
     * @return mixed
     */
    public function getCautMaxHeight()
    {
        return $this->caut_max_height;
    }

    /**
     * Set caut_growth_freq
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautGrowthFreq($p_value)
    {
        $this->caut_growth_freq = $p_value;
        return $this;
    }

    /**
     * Get caut_growth_freq
     *
     * @return int
     */
    public function getCautGrowthFreq()
    {
        return $this->caut_growth_freq;
    }

    /**
     * Set caut_growth_graph
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseType
     */
    public function setCautGrowthGraph($p_value)
    {
        $this->caut_growth_graph = $p_value;
        return $this;
    }

    /**
     * Get caut_growth_graph
     *
     * @return mixed
     */
    public function getCautGrowthGraph()
    {
        return $this->caut_growth_graph;
    }

    /**
     * Set caut_rec_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautRecEdiid($p_value)
    {
        $this->caut_rec_edi_id = $p_value;
        return $this;
    }

    /**
     * Get caut_rec_edi_id
     *
     * @return int
     */
    public function getCautRecEdiId()
    {
        return $this->caut_rec_edi_id;
    }

    /**
     * Set caut_cert_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautCertEdiid($p_value)
    {
        $this->caut_cert_edi_id = $p_value;
        return $this;
    }

    /**
     * Get caut_cert_edi_id
     *
     * @return int
     */
    public function getCautCertEdiId()
    {
        return $this->caut_cert_edi_id;
    }

    /**
     * Set caut_ident_edi_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Base\CauseType
     */
    public function setCautIdentEdiid($p_value)
    {
        $this->caut_ident_edi_id = $p_value;
        return $this;
    }

    /**
     * Get caut_ident_edi_id
     *
     * @return int
     */
    public function getCautIdentEdiId()
    {
        return $this->caut_ident_edi_id;
    }
}
