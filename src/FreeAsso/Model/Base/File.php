<?php
namespace FreeAsso\Model\Base;

/**
 * File
 *
 * @author jeromeklam
 */
abstract class File extends \FreeAsso\Model\StorageModel\File
{

    /**
     * file_id
     * @var int
     */
    protected $file_id = null;

    /**
     * brk_id
     * @var int
     */
    protected $brk_id = null;

    /**
     * file_name
     * @var string
     */
    protected $file_name = null;

    /**
     * file_blob
     * @var mixed
     */
    protected $file_blob = null;

    /**
     * file_type
     * @var string
     */
    protected $file_type = null;

    /**
     * Set file_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\File
     */
    public function setFileId($p_value)
    {
        $this->file_id = $p_value;
        return $this;
    }

    /**
     * Get file_id
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->file_id;
    }

    /**
     * Set brk_id
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\File
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
     * Set file_name
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\File
     */
    public function setFileName($p_value)
    {
        $this->file_name = $p_value;
        return $this;
    }

    /**
     * Get file_name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Set file_blob
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\File
     */
    public function setFileBlob($p_value)
    {
        $this->file_blob = $p_value;
        return $this;
    }

    /**
     * Get file_blob
     *
     * @return mixed
     */
    public function getFileBlob()
    {
        return $this->file_blob;
    }

    /**
     * Set file_type
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\File
     */
    public function setFileType($p_value)
    {
        $this->file_type = $p_value;
        return $this;
    }

    /**
     * Get file_type
     *
     * @return string
     */
    public function getFileType()
    {
        return $this->file_type;
    }
}
