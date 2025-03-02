<?php
namespace FreeSSO\Model;

/**
 * User
 *
 * @author jeromeklam
 */
class User extends \FreeSSO\Model\Base\User implements
    \FreeFW\Interfaces\ApiResponseInterface
{

    /**
     * Behaviours
     */
    use \FreeFW\Model\Behaviour\Lang;
    use \FreeFW\Behaviour\AutomateAwareTrait;
    use \FreeFW\Behaviour\EventManagerAwareTrait;

    /**
     * Titles
     * @var string
     */
    const TITLE_MISTER = 'MISTER';
    const TITLE_MADAM  = 'MADAM';
    const TITLE_MISS   = 'MISS';
    const TITLE_OTHER  = 'OTHER';

    /**
     *
     * @var string
     */
    const TYPE_USER      = 'USER';
    const TYPE_IP        = 'IP';
    const TYPE_UUID      = 'UUID';
    const TYPE_ANONYMOUS = 'ANONYMOUS';
    const TYPE_REST      = 'REST';

    /**
     * Groups
     * @var [\FreeSSO\Model\Group]
     */
    protected $groups = null;

    /**
     * Brokers
     * @var [\FreeSSO\Model\Broker]
     */
    protected $brokers = null;

    /**
     * Config
     * @var \FreeSSO\Model\UserBroker
     */
    protected $config = null;

    /**
     *
     * @var [\FreeSSO\Model\Group]
     */
    protected $realms = null;

    /**
     * User permissions, from sso
     * @var string / json
     */
    protected $permissions = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->user_salt   = md5(uniqid('test', true));
        $this->createNewPassword($this->user_salt);
        return $this;
    }

    /**
     * Verify user password
     *
     * @param string $p_password
     *
     * @return boolean
     */
    public function verifyPassword($p_password)
    {
        $testPassword = md5($this->getUserSalt() . $p_password);
        if ($testPassword == $this->getUserPassword()) {
            return true;
        }
        return false;
    }

    /**
     * Create new password with new salt
     *
     * @param string $p_password
     *
     * @return \FreeSSO\Model\User
     */
    public function createNewPassword($p_password)
    {
        $this->setUserSalt(md5(uniqid()));
        $this->setUserPassword(md5($this->getUserSalt() . $p_password));
        return $this;
    }

    /**
     * Is active ?
     *
     * @return boolean
     */
    public function isActive()
    {
        if (isset($this->user_active) && ($this->user_active == 1 ||
            in_array(strtoupper($this->user_active), array('O', 'Y', '1')))) {
            return true;
        }
        return false;
    }

    /**
     * Get Groups
     *
     * @return [\FreeSSO\Model\Group]
     */
    public function getGroups()
    {
        if ($this->groups === null && $this->getUserId() > 0) {
            $this->groups = new \FreeFW\Model\ResultSet();
            $conditions   = new \FreeFW\Model\Conditions();
            $conditions->initFromArray(['user_id' => $this->getUserId()]);
            $model  = \FreeFW\DI\DI::get('FreeSSO::Model::GroupUser');
            $query  = $model->getQuery();
            $rels   = [];
            $rels[] = 'group';
            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;
            if ($query->execute()) {
                $this->groups = $query->getResult();
            }
        }
        return $this->groups;
    }

    /**
     * Get Brokers
     *
     * @return \[\FreeSSO\Model\Broker]
     */
    public function getBrokers()
    {
        if ($this->brokers === null && $this->getUserId() > 0) {
            $this->brokers = new \FreeFW\Model\ResultSet();
            $conditions    = new \FreeFW\Model\Conditions();
            $conditions->initFromArray(['user_id' => $this->getUserId()]);
            $model  = \FreeFW\DI\DI::get('FreeSSO::Model::UserBroker');
            $query  = $model->getQuery();
            $rels   = [];
            $rels[] = 'broker';
            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;
            if ($query->execute()) {
                $this->brokers = $query->getResult();
            }
        }
        return $this->brokers;
    }

    /**
     * Get config
     *
     * @return \FreeSSO\Model\UserBroker
     */
    public function getConfig()
    {
        if ($this->config === null) {
            $sso    = \FreeFW\DI\DI::getShared('sso');
            $broker = $sso->getBrokerId();
            // First config for current user and broker
            $this->config = \FreeSSO\Model\UserBroker::findFirst(
                [
                    'brk_id'  => $broker,
                    'user_id' => $this->getUserId()
                ]
            );
            if ($this->config === false) {
                $this->config = \FreeFW\DI\DI::get('FreeSSO::Model::UserBroker');
                $this->config->setBrkId($broker);
                $this->config->setUserId($this->getUserId());
                $this->config->setUbrkTs(\FreeFW\Tools\Date::getCurrentTimestamp());
                $this->config->setUbrkAuthMethod(\FreeSSO\Model\UserBroker::METHOD_AUTO);
                $this->config->setUbrkPartnerType(\FreeSSO\Model\UserBroker::TYPE_APP);
                $this->config->setUbrkPartnerId(0);
                $this->config->create();
                $this->config = \FreeSSO\Model\UserBroker::findFirst(
                    [
                        'brk_id'  => $broker,
                        'user_id' => $this->getUserId()
                    ]
                );
            }
        }
        return $this->config;
    }

    /**
     * Get user realms for current broker
     *
     * @return [\FreeSSO\Model\Group]
     */
    public function getRealms()
    {
        $sso   = \FreeFW\DI\DI::getShared('sso');
        $group = $sso->getBrokerGroup();
        if ($group && $this->realms === null) {
            $this->realms = new \FreeFW\Model\ResultSet();
            $conditions   = new \FreeFW\Model\Conditions();
            $conditions->initFromArray(
                [
                    'users.user_id' => $this->getUserId(),
                    'grp_realm_id' => $group->getGrpId()
                ]
            );
            $model  = \FreeFW\DI\DI::get('FreeSSO::Model::Group');
            $query  = $model->getQuery();
            $rels   = [];
            $rels[] = 'users';
            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;
            if ($query->execute()) {
                $this->realms = $query->getResult();
            }
        }
        return $this->realms;
    }

    /**
     * Get user default group for current broker
     *
     * @return \FreeSSO\Model\Group
     */
    public function getDefaultGroup()
    {
        $defaultGroup = null;
        /**
         * @var \FreeSSO\Server $sso
         */
        $sso   = \FreeFW\DI\DI::getShared('sso');
        if ($this->brokers === null && $this->getUserId() > 0) {
            $this->brokers = new \FreeFW\Model\ResultSet();
            $conditions    = new \FreeFW\Model\Conditions();
            $conditions->initFromArray(
                [
                    'user_id' => $this->getUserId(),
                    'brk_id' => $sso->getBrokerId()
                ]
            );
            $model  = \FreeFW\DI\DI::get('FreeSSO::Model::UserBroker');
            $query  = $model->getQuery();
            $rels   = [];
            $rels[] = 'group';
            $query
                ->addConditions($conditions)
                ->addRelations($rels)
            ;
            if ($query->execute()) {
                foreach ($query->getResult() as $line) {
                    $defaultGroup = $line->getGroup();
                    break;
                }
            }
        }
        return $defaultGroup;
    }

    /**
     * Return permissions
     *
     * @return string
     */
    public function getPermissions()
    {
        $sso = \FreeFW\DI\DI::getShared('sso');
        $permissions = $sso->getPermissions();
        if ($permissions) {
            return json_encode($permissions);
        }
        return '';
    }
}
