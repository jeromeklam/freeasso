<?php
namespace FreeAsso\Model\Base;

/**
 * SiteAlert
 *
 * @author jeromeklam
 */
abstract class SiteAlert extends \FreeAsso\Model\StorageModel\SiteAlert
{

    /**
     * sita_id
     * @var int
     */
    protected $sita_id = null;

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
     * sita_from
     * @var string
     */
    protected $sita_from = null;

    /**
     * sita_to
     * @var string
     */
    protected $sita_to = null;

    /**
     * sita_text
     * @var mixed
     */
    protected $sita_text = null;

    /**
     * sita_activ
     * @var int
     */
    protected $sita_activ = null;

    /**
     * Set sita_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
     */
    public function setSitaId($p_value)
    {
        $this->sita_id = $p_value;
        return $this;
    }

    /**
     * Get sita_id
     *
     * @return int
     */
    public function getSitaId()
    {
        return $this->sita_id;
    }

    /**
     * Set site_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
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
     * @return \FreeAsso\Model\SiteAlert
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
     * Set sita_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
     */
    public function setSitaFrom($p_value)
    {
        $this->sita_from = $p_value;
        return $this;
    }

    /**
     * Get sita_from
     *
     * @return string
     */
    public function getSitaFrom()
    {
        return $this->sita_from;
    }

    /**
     * Set sita_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
     */
    public function setSitaTo($p_value)
    {
        $this->sita_to = $p_value;
        return $this;
    }

    /**
     * Get sita_to
     *
     * @return string
     */
    public function getSitaTo()
    {
        return $this->sita_to;
    }

    /**
     * Set sita_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
     */
    public function setSitaText($p_value)
    {
        $this->sita_text = $p_value;
        return $this;
    }

    /**
     * Get sita_text
     *
     * @return mixed
     */
    public function getSitaText()
    {
        return $this->sita_text;
    }

    /**
     * Set sita_activ
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\SiteAlert
     */
    public function setSitaActiv($p_value)
    {
        $this->sita_activ = $p_value;
        return $this;
    }

    /**
     * Get sita_activ
     *
     * @return int
     */
    public function getSitaActiv()
    {
        return $this->sita_activ;
    }
}
