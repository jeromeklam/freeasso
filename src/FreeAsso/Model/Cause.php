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
    use \FreeFW\Behaviour\EventManagerAwareTrait;
    use \FreeFW\Behaviour\AutomateAwareTrait;
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
     * Previous to
     * @var string
     */
    protected $previous_to = null;

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
     * @param \FreeAsso\Model\Client $p_client
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
        /**
         * @var \FreeAsso\Service\Cause $causeService
         */
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $result = true;
        if ($causeService->updateMnt($this)) {
            $result = $this->save(true, true);
        } else {
            $this->addError(\FreeAsso\Constants::ERROR_CAUSE_UPDATEMNT, "Erreur de mise à jour des monstants sur le bénéficiaire !");
        }
        return $result;
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
        $causeType = $this->getCauseType();
        if ($causeType && $causeType->getCautMntType() === \FreeAsso\Model\CauseType::MNT_TYPE_ANNUAL) {
            return $this->updateMnt();
        }
        return true;
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
    public function getSpecificEditionFields($p_tmp_dir = '/tmp/', $p_keep_binary = true, $p_lang_code = null)
    {
        $fields  = [];
        $picture = 0;
        $news    = '';
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query   = \FreeAsso\Model\CauseMedia::getQuery();
        $query
            ->addFromFilters(['cau_id' => $this->getCauId()])
            ->setSort('caum_order')
        ;
        $query->execute();
        $medias = $query->getResult();
        //$medias  = \FreeAsso\Model\CauseMedia::find(['cau_id' => $this->getCauId()]);
        foreach ($medias as $oneMedia) {
            switch ($oneMedia->getCaumType()) {
                case \FreeAsso\Model\CauseMedia::TYPE_HTML:
                case \FreeAsso\Model\CauseMedia::TYPE_NEWS:
                    if ($p_lang_code == '') {
                        $p_lang_code = 'fr';
                    }
                    /**
                     * @var \FreeAsso\Model\CauseMediaLang $mediaLang
                     */
                    $mediaLang = \FreeAsso\Model\CauseMediaLang::findFirst(
                        [
                            'caum_id'        => $oneMedia->getCaumId(),
                            'lang.lang_code' => $p_lang_code,
                        ]
                    );
                    if ($mediaLang) {
                        $news .= \FreeFW\Tools\PBXString::htmlToText($mediaLang->getCamlText());
                    }
                    break;
                case \FreeAsso\Model\CauseMedia::TYPE_PHOTO:
                    if ($oneMedia->getCaumBlob() !== null && $p_keep_binary) {
                        $picture++;
                        $name = 'cau_picture_' . $picture;
                        $fields[$name] = [
                            'name'    => $name,
                            'type'    => \FreeFW\Constants::TYPE_IMAGE,
                            'title'   => 'Image ' . $picture,
                            'content' => $p_tmp_dir . 'edi_' . uniqid(true) . '_' . $picture . '.png'
                        ];
                        file_put_contents($fields[$name]['content'], $oneMedia->getCaumBlob());
                        $name = 'cau_picture_rect_' . $picture;
                        $fields[$name] = [
                            'name'    => $name,
                            'type'    => \FreeFW\Constants::TYPE_IMAGE,
                            'title'   => 'Image R. ' . $picture,
                            'content' => $p_tmp_dir . 'edi_' . uniqid(true) . '_rect_' . $picture . '.png'
                        ];
                        try {
                            $image = \Gregwar\Image\Image::fromData($oneMedia->getCaumBlob());
                            $image->zoomCrop(200, 200, 0x000000, 'center', 'center');
                            $image->save($fields[$name]['content']);
                        } catch (\Exception $ex) {

                        }
                    }
                    break;
            }
        }
        if ($p_keep_binary) {
            @file_put_contents($p_tmp_dir . 'empty.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='));
            for ($i=$picture+1; $i<=5; $i++) {
                $name = 'cau_picture_' . $i;
                $fields[$name] = [
                    'name'    => $name,
                    'title'   => 'Image ' . $i,
                    'type'    => \FreeFW\Constants::TYPE_IMAGE,
                    'content' => $p_tmp_dir . 'empty.png'
                ];
                $name = 'cau_picture_rect_' . $i;
                $fields[$name] = [
                    'name'    => $name,
                    'title'   => 'Image ' . $i,
                    'type'    => \FreeFW\Constants::TYPE_IMAGE,
                    'content' => $p_tmp_dir . 'empty.png'
                ];
            }
        }
        $fields['cau_news'] = [
            'name'    => 'cau_news',
            'title'   => 'necau_newsws',
            'type'    => \FreeFW\Tools\PBXString::truncString(\FreeFW\Constants::TYPE_TEXT, 512),
            'content' => $news
        ];
        return $fields;
    }

    /**
     * Before merge
     *
     * @param \FreeFW\Model\MergeModel $p_datas
     * @param string                   $p_block
     *
     * @return \FreeFW\Model\MergeModel
     */
    public function beforeMerge($p_datas, $p_block)
    {
        $medias = \FreeAsso\Model\CauseMedia::find(['cau_id' => $this->getCauId()]);
        $news   = [];
        foreach ($medias as $oneMedia) {
            if ($oneMedia->getCaumType() == \FreeAsso\Model\CauseMedia::TYPE_HTML ||
                $oneMedia->getCaumType() == \FreeAsso\Model\CauseMedia::TYPE_NEWS) {
                $mediaLang = \FreeAsso\Model\CauseMediaLang::findFirst(
                    [
                        'caum_id' => $oneMedia->getCaumId(),
                        'lang_id' => 366,
                    ]
                );
                if ($mediaLang) {
                    $datas  = $mediaLang->__toArray();
                    $datas['caml_text_brut'] = \FreeFW\Tools\PBXString::htmlToText($datas['caml_text']);
                    $news[] = $datas;
                }
            }
        }
        $p_datas->addBlock($p_block . '_news', true);
        $p_datas->addData($news, $p_block . '_news', true);
        return $p_datas;
    }

    /**
     *
     * @return mixed
     */
    public function getCauMntRaised()
    {
        return $this->cau_mnt;
    }

    /**
     * Before save
     *
     * @return boolean
     */
    public function beforeSave()
    {
        if ($this->getCauTo()) {
            $old = \FreeAsso\Model\Cause::findFirst(['cau_id' => $this->getCauId()]);
            $this->previous_to = $old->getCauTo();
        }
        return true;
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        if (!$this->previous_to && $this->previous_to == '' && $this->getCauTo()) {
            /**
             * @var \FreeAsso\Service\Cause $causeService
             */
            $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
            $causeService->notification($this, "remove", false);
        }
        return true;
    }

    /**
     * Before remove
     *
     * @return boolean
     */
    public function beforeRemove()
    {
        $this->previous_to = $this->getCauTo();
        $this
            ->setCaumBlobId(null)
            ->setCaumTextId(null)
        ;
        return $this->save(false, true);
    }

    /**
     * Get full text
     *
     * @return string
     */
    public function getFulltext()
    {
        $text  = '';
        $lang  = \FreeFW\DI\DI::getShared('lang');
        if (!$lang) {
            $lang = 'fr';
        } else {
            $lang = \strtolower(substr($lang, 0, 2));
        }
        $query = \FreeAsso\Model\CauseMediaLang::getQuery();
        $query
            ->addFromFilters(
                [
                    'cause_media.cau_id'    => $this->getCauId(),
                    'cause_media.caum_code' => \FreeAsso\Model\CauseMedia::TYPE_NEWS,
                    'lang.lang_code'        => $lang,
                ]
            )
            ->addRelations(['cause_media', 'lang'])
            ->setSort('-cause_media.caum_order')
        ;
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                foreach ($results as $oneMedia) {
                    $text .= '<p class="text-title">' . $oneMedia->getCamlSubject() . '</p>';
                    $text .= '<div class="text-content">' . $oneMedia->getCamlText() . '</div>';
                }
            }
        }
        return $text;
    }

    /**
     * Liste des sponsors
     * 
     * @return array
     */
    public function getSponsors()
    {
        $sponsors = [];
        /**
         * @var \FreeAsso\Service\Cause $causeService
         */
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $data  = $causeService->getSponsors($this->getCauId());
        $added = [];
        /**
         * @var \FreeAsso\Model\Sponsor $oneSponsor
         */
        foreach ($data as $oneSponsor) {
            $sponsor = [
                'name'  => $oneSponsor->getSponName(),
                'email' => $oneSponsor->getSponEmail()
            ];
            $key = md5(json_encode($sponsor));
            if ($oneSponsor->getSponSite() && !in_array($key, $added)) {
                $sponsors[] = $sponsor;
                $added[]    = $key;
            }
        }
        return $sponsors;
    }

    /**
     * Get vignettes
     *
     * @return string
     */
    public function getVignettes()
    {
        $conf  = \FreeFW\DI\DI::getShared('config');
        $ged   = $conf->get('ged:dir', '');
        $path  = [];
        $query = \FreeAsso\Model\CauseMedia::getQuery();
        $query
            ->addFromFilters(
                [
                    'cau_id'    => $this->getCauId(),
                    'caum_type' => \FreeAsso\Model\CauseMedia::TYPE_PHOTO,
                ]
            )
            ->setSort('-caum_order')
        ;
        if ($query->execute()) {
            /**
             * @var \FreeFW\Model\ResultSet $results
             */
            $results = $query->getResult();
            if ($results->count() > 0) {
                foreach ($results as $oneMedia) {
                    $file   = '/images/photos/gibbon_' . $oneMedia->getCaumId() . '.jpg';
                    if (!is_file($ged . '/public' . $file)) {
                        \FreeFW\Tools\Dir::mkpath($ged . '/public/images/photos/');
                        file_put_contents($ged . '/public' . $file, $oneMedia->getCaumBlob());
                    }
                    $file   = '/images/vignettes/gibbon_' . $oneMedia->getCaumId() . '.jpg';
                    if (!is_file($ged . '/public' . $file)) {
                        \FreeFW\Tools\Dir::mkpath($ged . '/public/images/vignettes/');
                        /**
                         * @var \FreeFW\Tools\ImageResizer $crop
                         */
                        $crop = \FreeFW\Tools\ImageResizer::createFromString($oneMedia->getCaumBlob());
                        $crop->resizeToBestFit(200, 200);
                        $crop->save($ged . '/public' . $file);
                    }
                    $path[] = 'gibbon_' . $oneMedia->getCaumId() . '.jpg';
                }
            }
        }
        return $path;
    }
}
