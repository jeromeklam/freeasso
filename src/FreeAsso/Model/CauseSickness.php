<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseSickness
 *
 * @author jeromeklam
 */
class CauseSickness extends \FreeAsso\Model\Base\CauseSickness
{

    /**
     * Behavior
     */
    use \FreeAsso\Model\Behavior\Cause;
    use \FreeSSO\Model\Behavior\Group;
    use \FreeFW\Behavior\LlmAwareTrait;

    /**
     * Sickness
     * @var \FreeAsso\Model\Sickness
     */
    protected $sickness = null;

    /**
     * Sanitary
     * @var \FreeAsso\Model\Client
     */
    protected $sanitary = null;

    /**
     * Set sickness
     *
     * @param \FreeAsso\Model\Sickness $p_sickness
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSickness($p_sickness)
    {
        $this->sickness = $p_sickness;
        return $this;
    }

    /**
     * Get sickness
     *
     * @return \FreeAsso\Model\Sickness
     */
    public function getSickness()
    {
        return $this->sickness;
    }

    /**
     * Set sanitary
     *
     * @param \FreeAsso\Model\Client $p_sanitary
     *
     * @return \FreeAsso\Model\CauseSickness
     */
    public function setSanitary($p_sanitary)
    {
        $this->sanitary = $p_sanitary;
        return $this;
    }

    /**
     * Get sanitary
     *
     * @return \FreeAsso\Model\Client
     */
    public function getSanitary()
    {
        return $this->sanitary;
    }
}
