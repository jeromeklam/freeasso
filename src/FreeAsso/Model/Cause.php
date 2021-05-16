<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;
use FreeFW\Tools\Number;

/**
 * Cause
 *
 * @author jeromeklam
 */
class Cause extends \FreeAsso\Model\Base\Cause implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\CauseType;
    use \FreeAsso\Model\Behaviour\Site;
    use \FreeAsso\Model\Behaviour\Subspecies;
    use \FreeSSO\Model\Behaviour\Group;

    /**
     * Constantes
     * @var string
     */
    const FAMILY_NONE          = 'NONE';
    const FAMILY_ANIMAL        = 'ANIMAL';
    const FAMILY_OTHER         = 'OTHER';
    const FAMILY_NATURE        = 'NATURE';
    const FAMILY_ADMINISTRATIV = 'ADMINISTRATIV';

    /**
     * Raiser
     * @var \FreeAsso\Model\Client
     */
    protected $raiser = null;

    /**
     * Parent 1
     * @var \FreeAsso\Model\Cause
     */
    protected $parent1 = null;

    /**
     * Parent 2
     * @var \FreeAsso\Model\Cause
     */
    protected $parent2 = null;

    /**
     * Default text
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_text = null;

    /**
     * Default blob
     * @var \FreeAsso\Model\CauseMedia
     */
    protected $default_blob = null;

    /**
     * Come from
     * @var \FreeAsso\Model\Client
     */
    protected $origin = null;

    /**
     * Montant récolté
     * @var Number
     */
    protected $cau_mnt_raised = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->cau_family = self::FAMILY_ANIMAL;
        $this->cau_year   = intval(date('Y'));
        return $this;
    }

    /**
     * Set parent1
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent1($p_cause)
    {
        $this->parent1 = $p_cause;
        if ($this->parent1) {
            $this->setParent1CauId($this->parent1->getCauId());
        } else {
            $this->setParent1CauId(null);
        }
        return $this;
    }

    /**
     * Get parent1
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent1()
    {
        return $this->parent1;
    }

    /**
     * Set parent2
     *
     * @param \FreeAsso\Model\Cause $p_cause
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setParent2($p_cause)
    {
        $this->parent2 = $p_cause;
        if ($this->parent2) {
            $this->setParent2CauId($this->parent2->getCauId());
        } else {
            $this->setParent2CauId(null);
        }
        return $this;
    }

    /**
     * Get parent2
     *
     * @return \FreeAsso\Model\Cause
     */
    public function getParent2()
    {
        return $this->parent2;
    }

    /**
     * Set raiser
     *
     * @param \FreeAsso\Model\Client $p_raiser
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setRaiser($p_raiser)
    {
        $this->raiser = $p_raiser;
        return $this;
    }

    /**
     * Get raiser
     *
     * @return \FreeAsso\Model\Client
     */
    public function getRaiser()
    {
        return $this->raiser;
    }

    /**
     * Set proprietary
     *
     * @param \FreeFW\Model\Client $p_client
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setOrigin($p_client)
    {
        $this->origin =$p_client;
        return $this;
    }

    /**
     * Get proprietary
     *
     * @return \FreeAsso\Model\Client
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set default text
     *
     * @param \FreeAsso\Model\CauseMedia $p_media
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultText($p_media)
    {
        $this->default_text = $p_media;
        return $this;
    }

    /**
     * get default text
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultText()
    {
        return $this->default_text;
    }

    /**
     * Set default blob
     *
     * @param \FreeAsso\Model\CauseMedia $p_media
     *
     * @return \FreeAsso\Model\Cause
     */
    public function setDefaultBlob($p_media)
    {
        $this->default_blob = $p_media;
        return $this;
    }

    /**
     * get default blob
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function getDefaultBlob()
    {
        return $this->default_blob;
    }

    /**
     * Update mnt and mnt_left
     *
     * @return boolean
     */
    public function updateMnt()
    {
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $causeService->updateMnt($this);
        return $this->save();
    }

    /**
     * Handle donation CRUD
     * Update Mnt, reaised, left, ...
     *
     * @param \FreeAsso\Model\Donation $p_added_donation
     * @param \FreeAsso\Model\Donation $p_removed_donation
     *
     * @return boolean
     */
    public function handleDonation($p_added_donation = null, $p_removed_donation = null)
    {
        return $this->updateMnt();
    }

    /**
     * Cause is active ?
     *
     * @param \DateTime $p_date
     *
     * @return string
     */
    public function isActive(\DateTime $p_date = null)
    {
        if ($p_date === null) {
            $p_date = \FreeFW\Tools\Date::getServerDatetime();
        }
        $from = $this->getCauFrom();
        $to   = $this->getCauTo();
        if (($from && $from > $p_date) || ($to && $to < $p_date)) {
            return false;
        }
        return true;
    }

    /**
     * Specific fields for editions, ...
     *
     * @return \StdClass
     */
    public function getSpecificEditionFields($p_tmp_dir = '/tmp/', $p_keep_binary = true)
    {
        $fields  = [];
        $picture = 0;
        $medias  = \FreeAsso\Model\CauseMedia::find(['cau_id' => $this->getCauId()]);
        foreach ($medias as $oneMedia) {
            switch ($oneMedia->getCaumType()) {
                case \FreeAsso\Model\CauseMedia::TYPE_HTML:
                    break;
                case \FreeAsso\Model\CauseMedia::TYPE_NEWS:
                    break;
                case \FreeAsso\Model\CauseMedia::TYPE_PHOTO:
                    if ($oneMedia->getCaumBlob() !== null && $p_keep_binary) {
                        $picture++;
                        $name = 'cau_picture_' . $picture;
                        $fields[$name] = $p_tmp_dir . 'edi_' . uniqid(true) . '_' . $picture . '.png';
                        file_put_contents($fields[$name], $oneMedia->getCaumBlob());
                        $name = 'cau_picture_rect_' . $picture;
                        $fields[$name] = $p_tmp_dir . 'edi_' . uniqid(true) . '_rect_' . $picture . '.png';
                        $image = \Gregwar\Image\Image::fromData($oneMedia->getCaumBlob());
                        $image->zoomCrop(200, 200, 0x000000, 'center', 'center');
                        $image->save($fields[$name]);
                    }
                    break;
            }
        }
        if ($p_keep_binary) {
            file_put_contents($p_tmp_dir . 'empty.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='));
            for ($i=$picture+1; $i<=5; $i++) {
                $name = 'cau_picture_' . $i;
                $fields[$name] = $p_tmp_dir . 'empty.png';
            }
        }
        return $fields;
    }

    /**
     *
     * @return mixed
     */
    public function getCauMntRaised()
    {
        return $this->cau_mnt;
    }
}
