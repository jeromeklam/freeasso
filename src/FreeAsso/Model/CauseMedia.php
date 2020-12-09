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
     * Behaviour
     */
    use \FreeAsso\Model\Behaviour\Cause;
    use \FreeSSO\Model\Behaviour\Group;

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
                ->addRelations(['lang'])
            ;
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
            if (intval($newVersion->getCamlId()) == 0) {
                $newVersion->setCaumId($this->getCaumId());
                if (!$newVersion->create()) {
                    $this->addErrors($newVersion->getErrors());
                    return false;
                }
            }
        }
        return true;
    }
}
