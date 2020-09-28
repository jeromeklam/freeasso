<?php
namespace FreeAsso\Model\Base;

/**
 * ContractMedia
 *
 * @author jeromeklam
 */
abstract class ContractMedia extends \FreeAsso\Model\StorageModel\ContractMedia
{

    /**
     * ctm_id
     * @var int
     */
    protected $ctm_id = null;

    /**
     * ct_id
     * @var int
     */
    protected $ct_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * ctm_code
     * @var string
     */
    protected $ctm_code = null;

    /**
     * ctm_type
     * @var string
     */
    protected $ctm_type = null;

    /**
     * ctm_ts
     * @var mixed
     */
    protected $ctm_ts = null;

    /**
     * ctm_from
     * @var mixed
     */
    protected $ctm_from = null;

    /**
     * ctm_to
     * @var mixed
     */
    protected $ctm_to = null;

    /**
     * ctm_text
     * @var mixed
     */
    protected $ctm_text = null;

    /**
     * ctm_short_text
     * @var mixed
     */
    protected $ctm_short_text = null;

    /**
     * ctm_blob
     * @var mixed
     */
    protected $ctm_blob = null;

    /**
     * ctm_short_blob
     * @var mixed
     */
    protected $ctm_short_blob = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * ctm_order
     * @var int
     */
    protected $ctm_order = null;

    /**
     * ctm_title
     * @var string
     */
    protected $ctm_title = null;

    /**
     * ctm_public
     * @var bool
     */
    protected $ctm_public = null;

    /**
     * ctm_desc
     * @var mixed
     */
    protected $ctm_desc = null;

    /**
     * Set ctm_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmId($p_value)
    {
        $this->ctm_id = $p_value;
        return $this;
    }

    /**
     * Get ctm_id
     *
     * @return int
     */
    public function getCtmId()
    {
        return $this->ctm_id;
    }

    /**
     * Set ct_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtId($p_value)
    {
        $this->ct_id = $p_value;
        return $this;
    }

    /**
     * Get ct_id
     *
     * @return int
     */
    public function getCtId()
    {
        return $this->ct_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
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
     * Set ctm_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmCode($p_value)
    {
        $this->ctm_code = $p_value;
        return $this;
    }

    /**
     * Get ctm_code
     *
     * @return string
     */
    public function getCtmCode()
    {
        return $this->ctm_code;
    }

    /**
     * Set ctm_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmType($p_value)
    {
        $this->ctm_type = $p_value;
        return $this;
    }

    /**
     * Get ctm_type
     *
     * @return string
     */
    public function getCtmType()
    {
        return $this->ctm_type;
    }

    /**
     * Set ctm_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmTs($p_value)
    {
        $this->ctm_ts = $p_value;
        return $this;
    }

    /**
     * Get ctm_ts
     *
     * @return mixed
     */
    public function getCtmTs()
    {
        return $this->ctm_ts;
    }

    /**
     * Set ctm_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmFrom($p_value)
    {
        $this->ctm_from = $p_value;
        return $this;
    }

    /**
     * Get ctm_from
     *
     * @return mixed
     */
    public function getCtmFrom()
    {
        return $this->ctm_from;
    }

    /**
     * Set ctm_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmTo($p_value)
    {
        $this->ctm_to = $p_value;
        return $this;
    }

    /**
     * Get ctm_to
     *
     * @return mixed
     */
    public function getCtmTo()
    {
        return $this->ctm_to;
    }

    /**
     * Set ctm_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmText($p_value)
    {
        $this->ctm_text = $p_value;
        return $this;
    }

    /**
     * Get ctm_text
     *
     * @return mixed
     */
    public function getCtmText()
    {
        return $this->ctm_text;
    }

    /**
     * Set ctm_short_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmShortText($p_value)
    {
        $this->ctm_short_text = $p_value;
        return $this;
    }

    /**
     * Get ctm_short_text
     *
     * @return mixed
     */
    public function getCtmShortText()
    {
        return $this->ctm_short_text;
    }

    /**
     * Set ctm_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmBlob($p_value)
    {
        $this->ctm_blob = $p_value;
        return $this;
    }

    /**
     * Get ctm_blob
     *
     * @return mixed
     */
    public function getCtmBlob()
    {
        return $this->ctm_blob;
    }

    /**
     * Set ctm_short_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmShortBlob($p_value)
    {
        $this->ctm_short_blob = $p_value;
        return $this;
    }

    /**
     * Get ctm_short_blob
     *
     * @return mixed
     */
    public function getCtmShortBlob()
    {
        return $this->ctm_short_blob;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setLangId($p_value)
    {
        $this->lang_id = $p_value;
        return $this;
    }

    /**
     * Get lang_id
     *
     * @return int
     */
    public function getLangId()
    {
        return $this->lang_id;
    }

    /**
     * Set ctm_order
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmOrder($p_value)
    {
        $this->ctm_order = $p_value;
        return $this;
    }

    /**
     * Get ctm_order
     *
     * @return int
     */
    public function getCtmOrder()
    {
        return $this->ctm_order;
    }

    /**
     * Set ctm_title
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmTitle($p_value)
    {
        $this->ctm_title = $p_value;
        return $this;
    }

    /**
     * Get ctm_title
     *
     * @return string
     */
    public function getCtmTitle()
    {
        return $this->ctm_title;
    }

    /**
     * Set ctm_public
     *
     * @param bool $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmPublic($p_value)
    {
        $this->ctm_public = $p_value;
        return $this;
    }

    /**
     * Get ctm_public
     *
     * @return bool
     */
    public function getCtmPublic()
    {
        return $this->ctm_public;
    }

    /**
     * Set ctm_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\ContractMedia
     */
    public function setCtmDesc($p_value)
    {
        $this->ctm_desc = $p_value;
        return $this;
    }

    /**
     * Get ctm_desc
     *
     * @return mixed
     */
    public function getCtmDesc()
    {
        return $this->ctm_desc;
    }
}
