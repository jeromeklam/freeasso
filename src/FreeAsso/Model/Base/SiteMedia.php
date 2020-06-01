<?php
namespace FreeAsso\Model\Base;

/**
 * SiteMedia
 *
 * @author jeromeklam
 */
abstract class SiteMedia extends \FreeAsso\Model\StorageModel\SiteMedia
{

    /**
     * sitm_id
     * @var int
     */
    protected $sitm_id = null;

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
     * sitm_code
     * @var string
     */
    protected $sitm_code = null;

    /**
     * sitm_type
     * @var string
     */
    protected $sitm_type = null;

    /**
     * sitm_ts
     * @var mixed
     */
    protected $sitm_ts = null;

    /**
     * sitm_from
     * @var mixed
     */
    protected $sitm_from = null;

    /**
     * sitm_to
     * @var mixed
     */
    protected $sitm_to = null;

    /**
     * sitm_text
     * @var mixed
     */
    protected $sitm_text = null;

    /**
     * sitm_short_text
     * @var mixed
     */
    protected $sitm_short_text = null;

    /**
     * sitm_blob
     * @var mixed
     */
    protected $sitm_blob = null;

    /**
     * sitm_short_blob
     * @var mixed
     */
    protected $sitm_short_blob = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * sitm_order
     * @var int
     */
    protected $sitm_order = null;

    /**
     * sitm_title
     * @var string
     */
    protected $sitm_title = null;

    /**
     * Set sitm_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmId($p_value)
    {
        $this->sitm_id = $p_value;
        return $this;
    }

    /**
     * Get sitm_id
     *
     * @return int
     */
    public function getSitmId()
    {
        return $this->sitm_id;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
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
     * @return \FreeAsso\Model\SiteMedia
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
     * Set sitm_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmCode($p_value)
    {
        $this->sitm_code = $p_value;
        return $this;
    }

    /**
     * Get sitm_code
     *
     * @return string
     */
    public function getSitmCode()
    {
        return $this->sitm_code;
    }

    /**
     * Set sitm_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmType($p_value)
    {
        $this->sitm_type = $p_value;
        return $this;
    }

    /**
     * Get sitm_type
     *
     * @return string
     */
    public function getSitmType()
    {
        return $this->sitm_type;
    }

    /**
     * Set sitm_ts
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmTs($p_value)
    {
        $this->sitm_ts = $p_value;
        return $this;
    }

    /**
     * Get sitm_ts
     *
     * @return mixed
     */
    public function getSitmTs()
    {
        return $this->sitm_ts;
    }

    /**
     * Set sitm_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmFrom($p_value)
    {
        $this->sitm_from = $p_value;
        return $this;
    }

    /**
     * Get sitm_from
     *
     * @return mixed
     */
    public function getSitmFrom()
    {
        return $this->sitm_from;
    }

    /**
     * Set sitm_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmTo($p_value)
    {
        $this->sitm_to = $p_value;
        return $this;
    }

    /**
     * Get sitm_to
     *
     * @return mixed
     */
    public function getSitmTo()
    {
        return $this->sitm_to;
    }

    /**
     * Set sitm_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmText($p_value)
    {
        $this->sitm_text = $p_value;
        return $this;
    }

    /**
     * Get sitm_text
     *
     * @return mixed
     */
    public function getSitmText()
    {
        return $this->sitm_text;
    }

    /**
     * Set sitm_short_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmShortText($p_value)
    {
        $this->sitm_short_text = $p_value;
        return $this;
    }

    /**
     * Get sitm_short_text
     *
     * @return mixed
     */
    public function getSitmShortText()
    {
        return $this->sitm_short_text;
    }

    /**
     * Set sitm_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmBlob($p_value)
    {
        $this->sitm_blob = $p_value;
        return $this;
    }

    /**
     * Get sitm_blob
     *
     * @return mixed
     */
    public function getSitmBlob()
    {
        return $this->sitm_blob;
    }

    /**
     * Set sitm_short_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmShortBlob($p_value)
    {
        $this->sitm_short_blob = $p_value;
        return $this;
    }

    /**
     * Get sitm_short_blob
     *
     * @return mixed
     */
    public function getSitmShortBlob()
    {
        return $this->sitm_short_blob;
    }

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
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
     * Set sitm_order
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmOrder($p_value)
    {
        $this->sitm_order = $p_value;
        return $this;
    }

    /**
     * Get sitm_order
     *
     * @return int
     */
    public function getSitmOrder()
    {
        return $this->sitm_order;
    }

    /**
     * Set sitm_title
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSitmTitle($p_value)
    {
        $this->sitm_title = $p_value;
        return $this;
    }

    /**
     * Get sitm_title
     *
     * @return string
     */
    public function getSitmTitle()
    {
        return $this->sitm_title;
    }
}
