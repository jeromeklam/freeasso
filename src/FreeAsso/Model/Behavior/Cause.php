<?php
namespace FreeAsso\Model\Behavior;

/**
 *
 * @author jeromeklam
 *
 */
trait Cause
{

    /**
     * Cause
     * @var \FreeAsso\Model\Cause
     */
    protected $cause = null;

    /**
     * Set cause
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeFW\Core\Model
     */
    public function setCause($p_cause)
    {
        $this->cause = $p_cause;
        return $this;
    }

    /**
     * Get cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getCause()
    {
        if ($this->cause === null) {
            if ($this->cau_id > 0) {
                $this->cause = \FreeAsso\Model\Cause::findFirst(['cau_id' => $this->cau_id]);
            }
        }
        return $this->cause;
    }
}
