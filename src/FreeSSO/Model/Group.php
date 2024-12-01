<?php
namespace FreeSSO\Model;

use \FreeFW\Constants as FFCST;

/**
 * Group
 *
 * @author jeromeklam
 */
class Group extends \FreeSSO\Model\Base\Group
{

    /**
     * Behaviours
     */
    use \FreeFW\Model\Behaviour\Country;
    use \FreeFW\Model\Behaviour\Lang;

    /**
     * GroupType
     * @var \FreeSSO\Model\GroupType
     */
    protected $group_type = null;

    /**
     * Parent group
     * @var \FreeSSO\Model\Group
     */
    protected $parent = null;

    /**
     * Parent realm
     * @var \FreeSSO\Model\Group
     */
    protected $realm = null;

    /**
     * Set group type
     *
     * @param \FreeSSO\Model\GroupType $p_group_type
     *
     * @return \FreeSSO\Model\Group
     */
    public function setGroupType($p_group_type)
    {
        $this->group_type = $p_group_type;
        return $this;
    }

    /**
     * Get group_type
     *
     * @return \FreeSSO\Model\GroupType
     */
    public function getGroupType()
    {
        return $this->group_type;
    }

    /**
     * Set parent
     *
     * @param \FreeSSO\Model\Group $p_group
     *
     * @return \FreeSSO\Model\Group
     */
    public function setParent($p_group)
    {
        $this->parent = $p_group;
        return $this;
    }

    /**
     * Get group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set realm
     *
     * @param \FreeSSO\Model\Group $p_realm
     *
     * @return \FreeSSO\Model\Group
     */
    public function setRealm($p_realm)
    {
        $this->realm = $p_realm;
        return $this;
    }

    /**
     * Get group
     *
     * @return \FreeSSO\Model\Group
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * On create
     *
     * @return boolean
     */
    public function afterCreate()
    {
        if ($this->getGrpParentId() === null || $this->getGrpParentId() <= 0) {
            $this->setGrpRealmId($this->getGrpId());
        } else {
            $this->setGrpRealmId($this->getGrpParentId());
        }
        return $this->save();
    }

    /**
     * Set line address
     *
     * @return void
     */
    public function setGrpLineAddress()
    {
        return $this;
    }

    /**
     * Get line address
     *
     * @return string
     */
    public function getGrpLineAddress()
    {
        return trim($this->getGrpAddress1()) . ' - ' . trim($this->getGrpCp()) . ' ' . trim($this->getGrpTown());
    }

    /**
     * Specific fields for editions, ...
     *
     * @return \StdClass
     */
    public function getSpecificEditionFields($p_tmp_dir = '/tmp/', $p_keep_binary = true, $p_lang_code = null)
    {
        $fields = [];
        $file = $p_tmp_dir . 'edi_' . uniqid(true) . '_logo' . '.png';
        file_put_contents($file, $this->getGrpLogo());
        $fields['grp_logo_file'] = [
            'name'    => 'grp_logo_file',
            'title'   => 'logo',
            'type'    => \FreeFW\Constants::TYPE_IMAGE,
            'content' => $file
        ];
        $file = $p_tmp_dir . 'edi_' . uniqid(true) . '_sign' . '.png';
        file_put_contents($file, $this->getGrpDigSign());
        $fields['grp_sign_file'] = [
            'name'    => 'grp_sign_file',
            'title'   => 'sign',
            'type'    => \FreeFW\Constants::TYPE_IMAGE,
            'content' => $file
        ];
        $file = $p_tmp_dir . 'edi_' . uniqid(true) . '_sign2' . '.png';
        file_put_contents($file, $this->getGrpDigSign2());
        $fields['grp_sign_file2'] = [
            'name'    => 'grp_sign_file2',
            'title'   => 'sign2',
            'type'    => \FreeFW\Constants::TYPE_IMAGE,
            'content' => $file
        ];
        $langCode = 'fr';
        if ($p_lang_code) {
            $langCode = $p_lang_code;
        }
        $taxos = \FreeFW\Model\Taxonomy::getAsFieldsByObjectAndLang(
            'FreeFW_Group',
            $this->getGrpId(),
            $langCode
        );
        return array_merge($fields, $taxos);
    }
}
