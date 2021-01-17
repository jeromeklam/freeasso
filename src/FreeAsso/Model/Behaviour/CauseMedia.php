<?php
namespace FreeAsso\Model\Behaviour;

/**
 *
 * @author jeromeklam
 *
 */
trait CauseMedia
{

    /**
     * CauseMedia
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $cause_media = null;

    /**
     * Set cause_media
     *
     * @param \FreeAsso\Model\CauseMedia $p_cause_media
     *
     * @return \FreeFW\Core\Model
     */
    public function setCauseMedia($p_cause_media)
    {
        $this->cause_media = $p_cause_media;
        if ($this->cause_media instanceof \FreeAsso\Model\CauseMedia) {
            $this->caum_id = $this->cause_media->getCaumId();
        } else {
            $this->caum_id = null;
        }
        return $this;
    }

    /**
     * Get cause_media
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getCauseMedia()
    {
        if ($this->cause_media === null) {
            if ($this->caum_id > 0) {
                $this->cause_media = \FreeAsso\Model\CauseMedia::findFirst(['caum_id' => $this->caum_id]);
            }
        }
        return $this->cause_media;
    }
}
