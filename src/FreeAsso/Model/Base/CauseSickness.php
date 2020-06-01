<?php
namespace FreeAsso\Model\Base;

/**
 * CauseSickness
 *
 * @author jeromeklam
 */
abstract class CauseSickness extends \FreeAsso\Model\StorageModel\CauseSickness
{

    /**
     * caus_id
     * @var int
     */
    protected $caus_id = null;

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
     * sick_id
     * @var int
     */
    protected $sick_id = null;

    /**
     * caus_from
     * @var mixed
     */
    protected $caus_from = null;

    /**
     * caus_to
     * @var mixed
     */
    protected $caus_to = null;

    /**
     * sanitary_id
     * @var int
     */
    protected $sanitary_id = null;

    /**
     * caus_desc
     * @var mixed
     */
    protected $caus_desc = null;

    /**
     * caus_where
     * @var string
     */
    protected $caus_where = null;

    /**
     * caus_care
     * @var string
     */
    protected $caus_care = null;

    /**
     * caus_care_desc
     * @var mixed
     */
    protected $caus_care_desc = null;

    /**
     * Set caus_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausId($p_value)
    {
        $this->caus_id = $p_value;
        return $this;
    }

    /**
     * Get caus_id
     *
     * @return int
     */
    public function getCausId()
    {
        return $this->caus_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
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
     * @return \FreeAsso\Model\CauseSickness
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
     * Set sick_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSickId($p_value)
    {
        $this->sick_id = $p_value;
        return $this;
    }

    /**
     * Get sick_id
     *
     * @return int
     */
    public function getSickId()
    {
        return $this->sick_id;
    }

    /**
     * Set caus_from
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausFrom($p_value)
    {
        $this->caus_from = $p_value;
        return $this;
    }

    /**
     * Get caus_from
     *
     * @return mixed
     */
    public function getCausFrom()
    {
        return $this->caus_from;
    }

    /**
     * Set caus_to
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausTo($p_value)
    {
        $this->caus_to = $p_value;
        return $this;
    }

    /**
     * Get caus_to
     *
     * @return mixed
     */
    public function getCausTo()
    {
        return $this->caus_to;
    }

    /**
     * Set sanitary_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSanitaryId($p_value)
    {
        $this->sanitary_id = $p_value;
        return $this;
    }

    /**
     * Get sanitary_id
     *
     * @return int
     */
    public function getSanitaryId()
    {
        return $this->sanitary_id;
    }

    /**
     * Set caus_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausDesc($p_value)
    {
        $this->caus_desc = $p_value;
        return $this;
    }

    /**
     * Get caus_desc
     *
     * @return mixed
     */
    public function getCausDesc()
    {
        return $this->caus_desc;
    }

    /**
     * Set caus_where
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausWhere($p_value)
    {
        $this->caus_where = $p_value;
        return $this;
    }

    /**
     * Get caus_where
     *
     * @return string
     */
    public function getCausWhere()
    {
        return $this->caus_where;
    }

    /**
     * Set caus_care
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausCare($p_value)
    {
        $this->caus_care = $p_value;
        return $this;
    }

    /**
     * Get caus_care
     *
     * @return string
     */
    public function getCausCare()
    {
        return $this->caus_care;
    }

    /**
     * Set caus_care_desc
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setCausCareDesc($p_value)
    {
        $this->caus_care_desc = $p_value;
        return $this;
    }

    /**
     * Get caus_care_desc
     *
     * @return mixed
     */
    public function getCausCareDesc()
    {
        return $this->caus_care_desc;
    }
}
