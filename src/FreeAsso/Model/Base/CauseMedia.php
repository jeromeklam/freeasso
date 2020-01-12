<?php
namespace FreeAsso\Model\Base;

/**
 * CauseMedia
 *
 * @author jeromeklam
 */
abstract class CauseMedia extends \FreeAsso\Model\StorageModel\CauseMedia
{

    /**
     * caum_id
     * @var int
     */
    protected $caum_id = null;

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
     * caum_code
     * @var string
     */
    protected $caum_code = null;

    /**
     * caum_type
     * @var string
     */
    protected $caum_type = null;

    /**
     * caum_ts
     * @var string
     */
    protected $caum_ts = null;

    /**
     * caum_from
     * @var string
     */
    protected $caum_from = null;

    /**
     * caum_to
     * @var string
     */
    protected $caum_to = null;

    /**
     * caum_text
     * @var mixed
     */
    protected $caum_text = null;

    /**
     * caum_short_text
     * @var mixed
     */
    protected $caum_short_text = null;

    /**
     * caum_blob
     * @var mixed
     */
    protected $caum_blob = null;

    /**
     * caum_short_blob
     * @var mixed
     */
    protected $caum_short_blob = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * caum_order
     * @var string
     */
    protected $caum_order = null;

    /**
     * caum_title
     * @var string
     */
    protected $caum_title = null;

    /**
     * Set caum_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumId($p_value)
    {
        $this->caum_id = $p_value;
        return $this;
    }

    /**
     * Get caum_id
     *
     * @return int
     */
    public function getCaumId()
    {
        return $this->caum_id;
    }

    /**
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
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
     * @return \FreeAsso\Model\CauseMedia
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
     * Set caum_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumCode($p_value)
    {
        $this->caum_code = $p_value;
        return $this;
    }

    /**
     * Get caum_code
     *
     * @return string
     */
    public function getCaumCode()
    {
        return $this->caum_code;
    }

    /**
     * Set caum_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumType($p_value)
    {
        $this->caum_type = $p_value;
        return $this;
    }

    /**
     * Get caum_type
     *
     * @return string
     */
    public function getCaumType()
    {
        return $this->caum_type;
    }

    /**
     * Set caum_ts
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumTs($p_value)
    {
        $this->caum_ts = $p_value;
        return $this;
    }

    /**
     * Get caum_ts
     *
     * @return string
     */
    public function getCaumTs()
    {
        return $this->caum_ts;
    }

    /**
     * Set caum_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumFrom($p_value)
    {
        $this->caum_from = $p_value;
        return $this;
    }

    /**
     * Get caum_from
     *
     * @return string
     */
    public function getCaumFrom()
    {
        return $this->caum_from;
    }

    /**
     * Set caum_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumTo($p_value)
    {
        $this->caum_to = $p_value;
        return $this;
    }

    /**
     * Get caum_to
     *
     * @return string
     */
    public function getCaumTo()
    {
        return $this->caum_to;
    }

    /**
     * Set caum_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumText($p_value)
    {
        $this->caum_text = $p_value;
        return $this;
    }

    /**
     * Get caum_text
     *
     * @return mixed
     */
    public function getCaumText()
    {
        return $this->caum_text;
    }

    /**
     * Set caum_short_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumShortText($p_value)
    {
        $this->caum_short_text = $p_value;
        return $this;
    }
    
    /**
     * Get caum_short_text
     *
     * @return mixed
     */
    public function getCaumShortText()
    {
        return $this->caum_short_text;
    }

    /**
     * Set caum_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumBlob($p_value)
    {
        $this->caum_blob = $p_value;
        return $this;
    }

    /**
     * Get caum_blob
     *
     * @return mixed
     */
    public function getCaumBlob()
    {
        return $this->caum_blob;
    }

    /**
     * Set caum_short_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumShortBlob($p_value)
    {
        $this->caum_short_blob = $p_value;
        return $this;
    }
    
    /**
     * Get caum_short_blob
     *
     * @return mixed
     */
    public function getCaumShortBlob()
    {
        return $this->caum_short_blob;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
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
     * Set caum_order
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumOrder($p_value)
    {
        $this->caum_order = $p_value;
        return $this;
    }

    /**
     * Get caum_order
     *
     * @return string
     */
    public function getCaumOrder()
    {
        return $this->caum_order;
    }

    /**
     * Set caum_title
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setCaumTitle($p_value)
    {
        $this->caum_title = $p_value;
        return $this;
    }

    /**
     * Get caum_title
     *
     * @return string
     */
    public function getCaumTitle()
    {
        return $this->caum_title;
    }
}
