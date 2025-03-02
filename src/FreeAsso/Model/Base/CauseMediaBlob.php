<?php
namespace FreeAsso\Model\Base;

/**
 * CauseMediaBlob
 *
 * @author jeromeklam
 */
abstract class CauseMediaBlob extends \FreeAsso\Model\StorageModel\CauseMediaBlob
{

    /**
     * cau_id
     * @var int
     */
    protected $cau_id = null;

    /**
     * blob
     * @var mixed
     */
    protected $blob = null;

    /**
     * title
     * @var string
     */
    protected $title = null;

    /**
     * desc
     * @var string
     */
    protected $desc = null;

    /**
     * Set cau_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\CauseMediaBlob
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
     * Set blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\CauseMediaBlob
     */
    public function setBlob($p_value)
    {
        $this->blob = $p_value;
        return $this;
    }

    /**
     * Get blob
     *
     * @return mixed
     */
    public function getBlob()
    {
        return $this->blob;
    }

    /**
     * Set title
     *
     * @param string $p_title
     *
     * @return \FreeAsso\Model\CauseMediaBlob
     */
    public function setTitle($p_title)
    {
        $this->title = $p_title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set desc
     *
     * @param string $p_title
     *
     * @return \FreeAsso\Model\CauseMediaBlob
     */
    public function setDesc($p_desc)
    {
        $this->desc = $p_desc;
        return $this;
    }

    /**
     * Get desc
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->desc;
    }
}
