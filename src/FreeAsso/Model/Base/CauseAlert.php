<?php
namespace FreeAsso\Model\Base;

/**
 * CauseAlert
 *
 * @author jeromeklam
 */
abstract class CauseAlert extends \FreeAsso\Model\StorageModel\CauseAlert
{

    /**
     * caua_id
     * @var int
     */
    protected $caua_id = null;

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
     * caua_from
     * @var string
     */
    protected $caua_from = null;

    /**
     * caua_to
     * @var string
     */
    protected $caua_to = null;

    /**
     * caua_text
     * @var mixed
     */
    protected $caua_text = null;

    /**
     * caua_activ
     * @var int
     */
    protected $caua_activ = null;

    /**
     * Set caua_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
     */
    public function setCauaId($p_value)
    {
        $this->caua_id = $p_value;
        return $this;
    }

    /**
     * Get caua_id
     *
     * @return int
     */
    public function getCauaId()
    {
        return $this->caua_id;
    }

    /**
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
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
     * @return \FreeAsso\Model\CauseAlert
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
     * Set caua_from
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
     */
    public function setCauaFrom($p_value)
    {
        $this->caua_from = $p_value;
        return $this;
    }

    /**
     * Get caua_from
     *
     * @return string
     */
    public function getCauaFrom()
    {
        return $this->caua_from;
    }

    /**
     * Set caua_to
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
     */
    public function setCauaTo($p_value)
    {
        $this->caua_to = $p_value;
        return $this;
    }

    /**
     * Get caua_to
     *
     * @return string
     */
    public function getCauaTo()
    {
        return $this->caua_to;
    }

    /**
     * Set caua_text
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
     */
    public function setCauaText($p_value)
    {
        $this->caua_text = $p_value;
        return $this;
    }

    /**
     * Get caua_text
     *
     * @return mixed
     */
    public function getCauaText()
    {
        return $this->caua_text;
    }

    /**
     * Set caua_activ
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseAlert
     */
    public function setCauaActiv($p_value)
    {
        $this->caua_activ = $p_value;
        return $this;
    }

    /**
     * Get caua_activ
     *
     * @return int
     */
    public function getCauaActiv()
    {
        return $this->caua_activ;
    }
}
