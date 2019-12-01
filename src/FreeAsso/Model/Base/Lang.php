<?php
namespace FreeAsso\Model\Base;

/**
 * Lang
 *
 * @author jeromeklam
 */
abstract class Lang extends \FreeAsso\Model\StorageModel\Lang
{

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * lang_name
     * @var string
     */
    protected $lang_name = null;

    /**
     * lang_code
     * @var string
     */
    protected $lang_code = null;

    /**
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\Lang
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
     * Set lang_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Lang
     */
    public function setLangName($p_value)
    {
        $this->lang_name = $p_value;
        return $this;
    }

    /**
     * Get lang_name
     *
     * @return string
     */
    public function getLangName()
    {
        return $this->lang_name;
    }

    /**
     * Set lang_code
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\Lang
     */
    public function setLangCode($p_value)
    {
        $this->lang_code = $p_value;
        return $this;
    }

    /**
     * Get lang_code
     *
     * @return string
     */
    public function getLangCode()
    {
        return $this->lang_code;
    }
}
