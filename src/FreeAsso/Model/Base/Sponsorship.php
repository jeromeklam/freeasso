<?php
namespace FreeAsso\Model\Base;

/**
 * Sponsorship
 *
 * @author jeromeklam
 */
abstract class Sponsorship extends \FreeAsso\Model\StorageModel\Sponsorship
{

    /**
     * spo_id
     * @var int
     */
    protected $spo_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * cli_id
     * @var int
     */
    protected $cli_id = null;

    /**
     * spo_from
     * @var string
     */
    protected $spo_from = null;

    /**
     * spo_to
     * @var string
     */
    protected $spo_to = null;

    /**
     * spo_mnt
     * @var string
     */
    protected $spo_mnt = null;

    /**
     * spo_freq
     * @var string
     */
    protected $spo_freq = null;

    /**
     * spo_freq_when
     * @var number
     */
    protected $spo_freq_when = null;

    /**
     * spo_freq_detail
     * @var string
     */
    protected $spo_freq_detail = null;

    /**
     * ptyp_id
     * @var int
     */
    protected $ptyp_id = null;

    /**
     * spo_sponsors
     * @var mixed
     */
    protected $spo_sponsors = null;

    /**
     * spo_display_site
     * @var int
     */
    protected $spo_display_site = null;

    /**
     * spo_send_news
     * @var int
     */
    protected $spo_send_news = null;

    /**
     * Set spo_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoId($p_value)
    {
        $this->spo_id = $p_value;
        return $this;
    }

    /**
     * Get spo_id
     *
     * @return int
     */
    public function getSpoId()
    {
        return $this->spo_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
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
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
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
     * Set cli_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setCliId($p_value)
    {
        $this->cli_id = $p_value;
        return $this;
    }

    /**
     * Get cli_id
     *
     * @return int
     */
    public function getCliId()
    {
        return $this->cli_id;
    }

    /**
     * Set spo_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoFrom($p_value)
    {
        $this->spo_from = $p_value;
        return $this;
    }

    /**
     * Get spo_from
     *
     * @return string
     */
    public function getSpoFrom()
    {
        return $this->spo_from;
    }

    /**
     * Set spo_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoTo($p_value)
    {
        $this->spo_to = $p_value;
        return $this;
    }

    /**
     * Get spo_to
     *
     * @return string
     */
    public function getSpoTo()
    {
        return $this->spo_to;
    }

    /**
     * Set spo_mnt
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoMnt($p_value)
    {
        $this->spo_mnt = $p_value;
        return $this;
    }

    /**
     * Get spo_mnt
     *
     * @return string
     */
    public function getSpoMnt()
    {
        return $this->spo_mnt;
    }

    /**
     * Set spo_freq
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoFreq($p_value)
    {
        $this->spo_freq = $p_value;
        return $this;
    }

    /**
     * Get spo_freq
     *
     * @return string
     */
    public function getSpoFreq()
    {
        return $this->spo_freq;
    }

    /**
     * Set spo_freq_when
     *
     * @param number $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoFreqWhen($p_value)
    {
        $this->spo_freq_when = $p_value;
        return $this;
    }
    
    /**
     * Get spo_freq_when
     *
     * @return string
     */
    public function getSpoFreqWhen()
    {
        return $this->spo_freq_when;
    }

    /**
     * Set spo_freq_detail
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoFreqDetail($p_value)
    {
        $this->spo_freq_detail = $p_value;
        return $this;
    }

    /**
     * Get spo_freq_detail
     *
     * @return string
     */
    public function getSpoFreqDetail()
    {
        return $this->spo_freq_detail;
    }

    /**
     * Set ptyp_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setPtypId($p_value)
    {
        $this->ptyp_id = $p_value;
        return $this;
    }

    /**
     * Get ptyp_id
     *
     * @return int
     */
    public function getPtypId()
    {
        return $this->ptyp_id;
    }

    /**
     * Set spo_sponsors
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoSponsors($p_value)
    {
        $this->spo_sponsors = $p_value;
        return $this;
    }

    /**
     * Get spo_sponsors
     *
     * @return mixed
     */
    public function getSpoSponsors()
    {
        return $this->spo_sponsors;
    }

    /**
     * Set spo_display_site
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoDisplaySite($p_value)
    {
        $this->spo_display_site = $p_value;
        return $this;
    }

    /**
     * Get spo_display_site
     *
     * @return int
     */
    public function getSpoDisplaySite()
    {
        return $this->spo_display_site;
    }

    /**
     * Set spo_send_news
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Sponsorship
     */
    public function setSpoSendNews($p_value)
    {
        $this->spo_send_news = $p_value;
        return $this;
    }

    /**
     * Get spo_send_news
     *
     * @return int
     */
    public function getSpoSendNews()
    {
        return $this->spo_send_news;
    }
}
