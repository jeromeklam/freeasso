<?php

namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * CauseMedia
 *
 * @author jeromeklam
 */
class CauseMedia extends \FreeAsso\Model\Base\CauseMedia
{

    /**
     * Type de media
     * @var string
     */
    const TYPE_PHOTO = 'PHOTO';
    const TYPE_HTML  = 'HTML';
    const TYPE_NEWS  = 'NEWS';
    const TYPE_OTHER = 'OTHER';

    /**
     * Behavior
     */
    use \FreeAsso\Model\Behavior\Cause;
    use \FreeSSO\Model\Behavior\Group;

    /**
     * Versions
     * @var [\FreeAsso\Model\CauseMediaLang]
     */
    protected $versions = null;

    /**
     * Temp versions for storage
     * @var [\FreeAsso\Model\CauseMediaLang]
     */
    protected $tmp_versions = null;

    /**
     * Get versions from sb
     *
     * @return array
     */
    protected function hGetVersions()
    {
        $versions = null;
        if ($this->getCaumType() != self::TYPE_PHOTO) {
            $model  = \FreeFW\DI\DI::get('FreeAsso::Model::CauseMediaLang');
            $query  = $model->getQuery();
            $query
                ->addFromFilters(['caum_id' => $this->getCaumId()])
                ->addRelations(['lang']);
            if ($query->execute()) {
                $versions = $query->getResult();
            }
        }
        return $versions;
    }

    /**
     * Set versions
     *
     * @param array $p_value
     *
     * @return \FreeAsso\Model\CauseMedia
     */
    public function setVersions($p_value)
    {
        $this->versions = $p_value;
        return $this;
    }

    /**
     * Get versions
     *
     * @return [\FreeAsso\Model\CauseMediaLang]
     */
    public function getVersions()
    {
        if ($this->versions === null) {
            $this->versions = $this->hGetVersions();
        }
        return $this->versions;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function beforeCreate()
    {
        $this->setCaumOrder(0);
        $query = \FreeAsso\Model\CauseMedia::getQuery();
        $query->addFromFilters(['cau_id' => $this->getCauId()]);
        if ($query-> execute()) {
            $results = $query->getResult();
            foreach ($results as $oneCauseMedia) {
                if ($oneCauseMedia->getCaumOrder() > $this->getCaumOrder()) {
                    $this->setCaumOrder($oneCauseMedia->getCaumOrder());
                }
            }
        }
        $this->setCaumOrder($this->getCaumOrder() + 1);
        return true;
    }

    /**
     * After create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        $versions = $this->getVersions();
        if ($versions) {
            foreach ($this->getVersions() as $idx => $oneVersion) {
                $oneVersion->setCamlId(0);
                $oneVersion->setCauseMedia($this);
                if (!$oneVersion->create()) {
                    $this->addErrors($oneVersion->getErrors());
                    return false;
                }
            }
        }
        if ($this->getCaumCode() == 'NEWS') {
            /**
             * @var \FreeAsso\Model\Cause $cause
             */
            $cause = \FreeAsso\Model\Cause::findFirst(['cau_id' => $this->getCauId()]);
            $cause->setCauLastNews(\FreeFW\Tools\Date::getCurrentTimestamp());
            return $cause->save(true, true);
        }
        return true;
    }

    /**
     * Before save
     *
     * @return boolean
     */
    public function beforeSave()
    {
        $this->tmp_versions = $this->hGetVersions();
        return true;
    }

    /**
     * After save
     *
     * @return boolean
     */
    public function afterSave()
    {
        $tmpVersions = $this->tmp_versions;
        if (!$tmpVersions) {
            $tmpVersions = [];
        }
        $versions = $this->versions;
        if (!$versions) {
            $versions = [];
        }
        foreach ($tmpVersions as $oldVersion) {
            $found = false;
            foreach ($versions as $newVersion) {
                if ($oldVersion->getCamlId() == $newVersion->getCamlId()) {
                    if (!$newVersion->save()) {
                        $this->addErrors($newVersion->getErrors());
                        return false;
                    }
                    $found = true;
                }
            }
            if (!$found) {
                if (!$oldVersion->remove()) {
                    $this->addErrors($oldVersion->getErrors());
                    return false;
                }
            }
        }
        foreach ($versions as $newVersion) {
            if (intval($newVersion->getCamlId()) <= 0) {
                $newVersion->setCamlId(null);
                $newVersion->setCaumId($this->getCaumId());
                if (!$newVersion->create()) {
                    $this->addErrors($newVersion->getErrors());
                    return false;
                }
            }
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
        /**
         * Cas particulier des photos, la dernière est liée sur la table asso_cause, donc à gérer
         */
        $query = \FreeAsso\Model\Cause::getQuery();
        $query->addFromFilters(['caum_blob_id' => $this->getCaumId()]);
        if ($query->execute()) {
            $causes = $query->getResult();
            /**
             * @var \FreeAsso\Model\Cause $oneCause
             */
            foreach ($causes as $oneCause) {
                $newId = null;
                $query2 = \FreeAsso\Model\CauseMedia::getQuery();
                $query2->addFromFilters(
                    [
                        'cau_id'    => $oneCause->getCauId(),
                        'caum_id'   => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => $this->getCaumId()],
                        'caum_type' => \FreeAsso\Model\CauseMedia::TYPE_PHOTO,
                    ]
                );
                if ($query2->execute()) {
                    $otherMedias = $query2->getResult();
                    foreach ($otherMedias as $oneCauseMedia) {
                        $newId = $oneCauseMedia->getCaumId();
                        break;
                    }
                }
                $oneCause->setCaumBlobId($newId);
                $oneCause->save();
                break;
            }
        }
        $query  = \FreeAsso\Model\CauseMediaLang::getQuery();
        $query->addFromFilters(['caum_id' => $this->getCaumId()]);
        if ($query->execute()) {
            $mLang = $query->getResult();
            foreach ($mLang as $oneMLang) {
                if (!$oneMLang->remove()) {
                    $this->addErrors($oneMLang->getErrors());
                    return false;
                }
            }
        }
        return true;
    }
}
