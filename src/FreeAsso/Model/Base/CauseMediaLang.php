<?php
namespace FreeAsso\Model\Base;

/**
 * CauseMediaLang
 *
 * @author jeromeklam
 */
abstract class CauseMediaLang extends \FreeAsso\Model\StorageModel\CauseMediaLang
{

    /**
     * caml_id
     * @var int
     */
    protected $caml_id = null;

    /**
     * caum_id
     * @var int
     */
    protected $caum_id = null;

    /**
     * lang_id
     * @var int
     */
    protected $lang_id = null;

    /**
     * caml_subject
     * @var string
     */
    protected $caml_subject = null;

    /**
     * caml_blob
     * @var mixed
     */
    protected $caml_blob = null;

    /**
     * caml_text
     * @var mixed
     */
    protected $caml_text = null;

    /**
     * Set caml_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
     */
    public function setCamlId($p_value)
    {
        $this->caml_id = $p_value;
        return $this;
    }

    /**
     * Get caml_id
     *
     * @return int
     */
    public function getCamlId()
    {
        return $this->caml_id;
    }

    /**
     * Set caum_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
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
     * Set lang_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
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
     * Set caml_subject
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
     */
    public function setCamlSubject($p_value)
    {
        $this->caml_subject = $p_value;
        return $this;
    }

    /**
     * Get caml_subject
     *
     * @return string
     */
    public function getCamlSubject()
    {
        return $this->caml_subject;
    }

    /**
     * Set caml_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
     */
    public function setCamlBlob($p_value)
    {
        $this->caml_blob = $p_value;
        return $this;
    }

    /**
     * Get caml_blob
     *
     * @return mixed
     */
    public function getCamlBlob()
    {
        return $this->caml_blob;
    }

    /**
     * Set caml_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMediaLang
     */
    public function setCamlText($p_value)
    {
        $this->caml_text = $p_value;
        return $this;
    }

    /**
     * Get caml_text
     *
     * @return mixed
     */
    public function getCamlText()
    {
        return $this->caml_text;
    }
}
