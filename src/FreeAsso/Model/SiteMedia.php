<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * SiteMedia
 *
 * @author jeromeklam
 */
class SiteMedia extends \FreeAsso\Model\Base\SiteMedia
{

    /**
     * Langue
     * @var \FreeFW\Model\Lang
     */
    protected $lang = null;

    /**
     * Cause
     * @var \FreeAsso\Model\Site
     */
    protected $site = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->sitm_id = 0;
        $this->brk_id  = 0;
        $this->site_id = 0;
        $this->lang_id = null;
        return $this;
    }

    /**
     * Set lang
     *
     * @param \FreeFW\Model\Lang $p_lang
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setLang($p_lang)
    {
        $this->lang = $p_lang;
        return $this;
    }

    /**
     * Get lang
     *
     * @return \FreeFW\Model\Lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set site
     *
     * @param \FreeAsso\Model\Site $p_site
     *
     * @return \FreeAsso\Model\SiteMedia
     */
    public function setSite($p_site)
    {
        $this->site = $p_site;
        return $this;
    }

    /**
     * Get site
     *
     * @return \FreeAsso\Model\Site
     */
    public function getSite()
    {
        return $this->site;
    }
}
