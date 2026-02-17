<?php
namespace FreeAsso\Model\Base;

/**
 * LlmQuery
 *
 * @author jeromeklam
 */
abstract class LlmQuery extends \FreeAsso\Model\StorageModel\LlmQuery
{

    /**
     * llmq_query
     * @var string
     */
    protected $llmq_query = null;

    /**
     * llmq_resource
     * @var string
     */
    protected $llmq_resource = null;

    /**
     * llmq_filter
     * @var mixed
     */
    protected $llmq_filter = null;

    /**
     * llmq_sort
     * @var mixed
     */
    protected $llmq_sort = null;

    /**
     * llmq_limit
     * @var int
     */
    protected $llmq_limit = null;

    /**
     * Set llmq_query
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\LlmQuery
     */
    public function setLlmqQuery($p_value)
    {
        $this->llmq_query = $p_value;
        return $this;
    }

    /**
     * Get llmq_query
     *
     * @return string
     */
    public function getLlmqQuery()
    {
        return $this->llmq_query;
    }

    /**
     * Set llmq_resource
     *
     * @param string $p_value
     *
     * @return \FreeAsso\Model\LlmQuery
     */
    public function setLlmqResource($p_value)
    {
        $this->llmq_resource = $p_value;
        return $this;
    }

    /**
     * Get llmq_resource
     *
     * @return string
     */
    public function getLlmqResource()
    {
        return $this->llmq_resource;
    }

    /**
     * Set llmq_filter
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\LlmQuery
     */
    public function setLlmqFilter($p_value)
    {
        $this->llmq_filter = $p_value;
        return $this;
    }

    /**
     * Get llmq_filter
     *
     * @return mixed
     */
    public function getLlmqFilter()
    {
        return $this->llmq_filter;
    }

    /**
     * Set llmq_sort
     *
     * @param mixed $p_value
     *
     * @return \FreeAsso\Model\LlmQuery
     */
    public function setLlmqSort($p_value)
    {
        $this->llmq_sort = $p_value;
        return $this;
    }

    /**
     * Get llmq_sort
     *
     * @return mixed
     */
    public function getLlmqSort()
    {
        return $this->llmq_sort;
    }

    /**
     * Set llmq_limit
     *
     * @param int $p_value
     *
     * @return \FreeAsso\Model\LlmQuery
     */
    public function setLlmqLimit($p_value)
    {
        $this->llmq_limit = $p_value;
        return $this;
    }

    /**
     * Get llmq_limit
     *
     * @return int
     */
    public function getLlmqLimit()
    {
        return $this->llmq_limit;
    }
}
