<?php
namespace FreeFW\Storage;

use \FreeFW\Constants as FFCST;

/**
 *
 * @author jeromeklam
 *
 */
class PDOStorage extends \FreeFW\Storage\Storage
{

    /**
     * Provider
     * @var \FreeFW\Interfaces\StorageProviderInterface
     */
    protected $provider = null;

    /**
     * Models cache
     * @var array
     */
    protected static $models = [];

    /**
     * Uniqid
     * @var integer
     */
    protected static $uniqid = 187868;

    /**
     * Constructor
     *
     * @param \FreeFW\Interfaces\StorageProviderInterface $p_provider
     */
    public function __construct(\FreeFW\Interfaces\StorageProviderInterface $p_provider)
    {
        $this->provider = $p_provider;
        self::$uniqid   = rand(100000, 999999);
    }

    /**
     * Get standard members
     *
     * @param mixed $p_conditions
     *
     * @return array
     */
    protected function getConditionsRelations($p_conditions)
    {
        $relations = [];
        if ($p_conditions instanceof \FreeFW\Model\SimpleCondition) {
            $left = $p_conditions->getLeftMember();
            if ($left instanceof \FreeFW\Model\ConditionMember) {
                array_push($relations, $left->getValue());
            }
        } else {
            foreach ($p_conditions as $oneCondition) {
                $news = $this->getConditionsRelations($oneCondition);
                $relations = array_merge($relations, $news);
            }
        }
        return $relations;
    }


    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageStrategyInterface::create()
     */
    public function create(\FreeFW\Core\StorageModel &$p_model, bool $p_with_transaction = true, bool $p_raw = false) : bool
    {
        $fields     = [];
        $brkField   = '';
        $source     = $p_model::getSource();
        $properties = $p_model::getProperties();
        $sso        = \FreeFW\DI\DI::getShared('sso');
        $setter     = false;
        $archive    = !property_exists($p_model, 'no_history');
        // Next
        if ($p_with_transaction) {
            $this->provider->startTransaction();
        }
        if (!$p_raw && method_exists($p_model, 'beforeCreate')) {
            if (!$p_model->beforeCreate()) {
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
                return false;
            }
        }
        foreach ($properties as $name => $oneProperty) {
            $add = true;
            $pk  = false;
            $brk = false;
            $usr = false;
            $grp = false;
            $dtz = false;
            if (isset($oneProperty[FFCST::PROPERTY_OPTIONS])) {
                if (in_array(FFCST::OPTION_LOCAL, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $add = false;
                }
                if (in_array(FFCST::OPTION_FUNCTION, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $add = false;
                }
                if (in_array(FFCST::OPTION_PK, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $pk = true;
                }
                if (in_array(FFCST::OPTION_BROKER, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $brk = true;
                }
                if (in_array(FFCST::OPTION_USER, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $usr = true;
                }
                if (in_array(FFCST::OPTION_GROUP, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $grp = true;
                }
                if ($oneProperty[FFCST::PROPERTY_TYPE] == FFCST::TYPE_DATETIMETZ) {
                    $dtz = true;
                }
            }
            if ($add) {
                // Compute getter
                $getter = 'get' . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                // Get data
                $val = $p_model->$getter();
                // PK fields must be autoincrement...
                if ($pk) {
                    // setter for id
                    $setter = 'set' . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    if ($val) {
                        $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                    } else {
                        $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = null;
                    }
                } else {
                    if ($sso && ($brk || $usr || $grp)) {
                        if ($brk) {
                            $brkField = $oneProperty[FFCST::PROPERTY_PRIVATE];
                            $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $sso->getBrokerId();
                        }
                        if ($usr) {
                            if (!$val) {
                                $user = $sso->getUser();
                                if ($user) {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $user->getUserId();
                                } else {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = null;
                                }
                            } else {
                                $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                            }
                        }
                        if ($grp) {
                            if (!$val) {
                                $group = $sso->getUserGroup();
                                if ($group) {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $group->getGrpId();
                                } else {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = null;
                                }
                            } else {
                                $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                            }
                        }
                    } else {
                        if ($val === false) {
                            $val = 0;
                        }
                        if ($dtz && $val != '') {
                            $val = \FreeFW\Tools\Date::stringToMysql($val);
                        }
                        $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                    }
                }
            }
        }
        // Uniq fields...
        $next = true;
        $indexes = $p_model->getModelDescriptionIndexes();
        foreach ($indexes as $ixName => $oneIndex) {
            if (is_array($oneIndex['fields'])) {
                $cFields = $oneIndex['fields'];
            } else {
                $cFields = explode(',', $oneIndex['fields']);
            }
            $filters = [];
            $existF  = false;
            foreach ($cFields as $name) {
                if ($p_model->get($name) != '') {
                    $filters[$name] = $p_model->get($name);
                    $existF = true;
                } else {
                    $filters[$name] = [\FreeFW\Storage\Storage::COND_EQUAL_OR_NULL => ''];
                    $existF = true;
                }
            }
            if ($existF) {
                if ($brk) {
                    $filters[$brkField] = $sso->getBrokerId();
                }
                $others = $p_model->find($filters);
                if ($others->count() > 0) {
                    $code = \FreeFW\Constants::ERROR_UNIQINDEX;
                    if (isset($oneIndex['exists'])) {
                        $code = $oneIndex['exists'];
                    }
                    $p_model->addError(
                        $code,
                        $ixName . ' already exists !',
                        \FreeFW\Core\Error::TYPE_PRECONDITION,
                        $oneIndex['fields']
                    );
                    $next = false;
                }
            }
        }
        if (!$next) {
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            return false;
        }
        // Build query
        $sql = \FreeFW\Tools\Sql::makeInsertQuery($source, $fields);
        $this->logger->debug('PDOStorage.create : ' . $sql);
        $this->logger->debug('PDOStorage.create : ' . print_r($fields, true));
        //$this->logger->debug(print_r($fields, true));
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($fields)) {
                if ($setter) {
                    $lastId = $this->provider->lastInsertId();
                    $p_model->$setter($lastId);
                }
                if (!$p_raw && method_exists($p_model, 'afterCreate')) {
                    if (!$p_model->afterCreate()) {
                        if ($p_with_transaction) {
                            $this->provider->rollbackTransaction();
                        }
                        return false;
                    }
                }
                if ($archive) {
                    try {
                        if (APP_HISTORY) {
                            /**
                             * @var FreeFW\Model\History $history
                             */
                            $history = \FreeFW\DI\DI::get('FreeFW::Model::History');
                            $history
                                ->setHistMethod('C')
                                ->setHistObjectName($p_model->getApiType())
                                ->setHistObjectId($p_model->getApiId())
                                ->setHistTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->setHistObject($p_model->toHistory())
                            ;
                            if (method_exists($p_model, 'getGrpId')) {
                                $history->setGrpId($p_model->getGrpId());
                            }
                            $history->create();
                        }
                    } catch (\Exception $ex) {
                        // @todo
                    }
                }
                try {
                    $this->forwardRawEvent(FFCST::EVENT_STORAGE_CREATE, $p_model);
                } catch (\Exception $ex) {
                }
                if ($p_with_transaction) {
                    $this->provider->commitTransaction();
                }
            } else {
                $this->logger->debug('PDOStorage.create.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.create.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
            }
        } catch (\Exception $ex) {
            $this->logger->debug('PDOStorage.create.error : ' . print_r($ex->getMessage(), true));
            $p_model->addError($ex->getCode(), $ex->getMessage());
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
        }
        return !$p_model->hasErrors();
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageInterface::findFirst()
     */
    public function findFirst(\FreeFW\Core\StorageModel &$p_model, $p_filters = null)
    {
        $source     = $p_model->getSource();
        $properties = $p_model->getProperties();
        $fields     = [];
        if (is_int($p_filters)) {
            foreach ($properties as $name => $oneProperty) {
                if (isset($oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    if (in_array(FFCST::OPTION_PK, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                        $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $p_filters;
                        break;
                    }
                }
            }
        } else {
            if (is_array($p_filters)) {
                foreach ($p_filters as $field => $value) {
                    if (isset($properties[$field])) {
                        if ($value === false) {
                            $value = 0;
                        }
                        $fields[':' . $properties[$field][FFCST::PROPERTY_PRIVATE]] = $value;
                    } else {
                        throw new \FreeFW\Core\FreeFWStorageException(sprintf('Unkown %s field !', $field));
                    }
                }
            }
        }
        // Build query
        $sql = \FreeFW\Tools\Sql::makeSimpleSelect($source, $fields);
        $this->logger->debug('PDOStorage.create : ' . $sql);
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($fields)) {
                while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                    $p_model->setFromArray($row);
                    break;
                }
            } else {
                $this->logger->debug('PDOStorage.create.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.create.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
            }
        } catch (\Exception $ex) {
            var_dump($ex);
        }
        return $p_model->isValid();
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageStrategyInterface::remove()
     */
    public function remove(\FreeFW\Core\StorageModel &$p_model, bool $p_with_transaction = true, bool $p_raw = false) : bool
    {
        $fields     = [];
        $source     = $p_model::getSource();
        $properties = $p_model::getProperties();
        $getter     = '';
        $archive    = !property_exists($p_model, 'no_history');
        // Get PK and verify generic FK
        foreach ($properties as $name => $oneProperty) {
            if (isset($oneProperty[FFCST::PROPERTY_OPTIONS])) {
                if (in_array(FFCST::OPTION_PK, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    // Compute getter
                    $getter = 'get' . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    // Get data
                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $p_model->$getter();
                    break; // Only one PKField...
                }
            }
        }
        // @TODO : Error if no getter for PK
        if ($p_with_transaction) {
            $this->provider->startTransaction();
        }
        if (!$p_raw && method_exists($p_model, 'beforeRemove')) {
            if (!$p_model->beforeRemove()) {
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
                return false;
            }
        }
        $next = true;
        try {
            if (method_exists($p_model, 'getRelationships')) {
                $rels = $p_model->getRelationships();
                foreach ($rels as $oneRelation) {
                    if (isset($oneRelation['remove'])) {
                        $cascade = false;
                        if ($oneRelation['remove'] == 'cascade') {
                            $cascade = true;
                        }
                        /**
                         * @var \FreeFW\Core\StorageModel $class
                         */
                        $class = \FreeFW\DI\DI::get($oneRelation['model']);
                        $children = $class->find(
                            [
                                $oneRelation['field'] => $p_model->$getter()
                            ]
                        );
                        foreach ($children as $oneChild) {
                            if ($cascade) {
                                if (!$oneChild->remove(false)) {
                                    $next = false;
                                    break;
                                }
                            } else {
                                $next = false;
                                $code = \FreeFW\Constants::ERROR_FOREIGNKEY;
                                if (isset($oneRelation['exists'])) {
                                    $code = $oneRelation['exists'];
                                }
                                $p_model->addError(
                                    $code,
                                    'Used in ' . $oneRelation['model'] . '.' . $oneRelation['field'],
                                    \FreeFW\Core\Error::TYPE_PRECONDITION
                                );
                                break; // Or check All First ?? to get all errors in one call...
                            }
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            $p_model->addError($ex->getCode(), $ex->getMessage());
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            return false;
        }
        if (!$next) {
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            return false;
        }
        // Build query
        $ok  = false;
        $sql = \FreeFW\Tools\Sql::makeDeleteQuery($source, $fields);
        $this->logger->debug('PDOStorage.remove : ' . $sql);
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($fields)) {
                if (!$p_raw && method_exists($p_model, 'afterRemove')) {
                    if (!$p_model->afterRemove()) {
                        if ($p_with_transaction) {
                            $this->provider->rollbackTransaction();
                        }
                        return false;
                    }
                }
                if ($archive) {
                    try {
                        if (APP_HISTORY) {
                            $history = \FreeFW\DI\DI::get('FreeFW::Model::History');
                            $history
                                ->setHistMethod('D')
                                ->setHistObjectName($p_model->getApiType())
                                ->setHistObjectId($p_model->getApiId())
                                ->setHistTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->setHistObject($p_model->toHistory())
                            ;
                            if (method_exists($p_model, 'getGrpId')) {
                                $history->setGrpId($p_model->getGrpId());
                            }
                            $history->create();
                        }
                    } catch (\Exception $ex) {
                        // @todo
                    }
                }
                $code = '';
                $ok   = true;
                try {
                    $this->forwardRawEvent(FFCST::EVENT_STORAGE_DELETE, $p_model);
                } catch (\Exception $ex) {
                }
                if ($p_with_transaction) {
                    $this->provider->commitTransaction();
                }
            } else {
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
                $this->logger->debug('PDOStorage.remove.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.remove.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
            }
        } catch (\Exception $ex) {
            $p_model->addError($ex->getCode(), $ex->getMessage());
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            $ok = false;
        }
        return $ok;
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageInterface::save()
     */
    public function save(\FreeFW\Core\StorageModel &$p_model, bool $p_with_transaction = true, bool $p_raw = false) : bool
    {
        $brkField   = '';
        $pkField    = '';
        $pks        = [];
        $fields     = [];
        $source     = $p_model::getSource();
        $properties = $p_model::getProperties();
        $sso        = \FreeFW\DI\DI::getShared('sso');
        $archive    = !property_exists($p_model, 'no_history');
        if ($p_with_transaction) {
            $this->provider->startTransaction();
        }
        if (!$p_raw && method_exists($p_model, 'beforeSave')) {
            if (!$p_model->beforeSave()) {
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
                return false;
            }
        }
        foreach ($properties as $name => $oneProperty) {
            $add = true;
            $pk  = false;
            $brk = false;
            $usr = false;
            $grp = false;
            $dtz = false;
            $str = false;
            if (isset($oneProperty[FFCST::PROPERTY_OPTIONS])) {
                if (in_array(FFCST::OPTION_LOCAL, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $add = false;
                }
                if (in_array(FFCST::OPTION_FUNCTION, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $add = false;
                }
                if (in_array(FFCST::OPTION_PK, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $pk = true;
                }
                if (in_array(FFCST::OPTION_BROKER, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $brk = true;
                    $add = false;
                }
                if (in_array(FFCST::OPTION_USER, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $usr = true;
                    $add = false;
                }
                if (in_array(FFCST::OPTION_GROUP, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $grp = true;
                    $add = false;
                }
                if ($oneProperty[FFCST::PROPERTY_TYPE] == FFCST::TYPE_DATETIMETZ) {
                    $dtz = true;
                }
                if (in_array($oneProperty[FFCST::PROPERTY_TYPE], [FFCST::TYPE_STRING, FFCST::TYPE_TEXT])) {
                    $str = true;
                }
            }
            if ($add) {
                // PK fields must be autoincrement...
                $getter = 'get' . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                // Get data
                $val = $p_model->$getter();
                if ($pk) {
                    // Get data
                    $pkField = $oneProperty[FFCST::PROPERTY_PRIVATE];
                    $pks[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]]    = $p_model->$getter();
                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $p_model->$getter();
                } else {
                    if ($sso && ($brk || $usr || $grp)) {
                        if ($brk) {
                            $brkField = $oneProperty[FFCST::PROPERTY_PRIVATE];
                            $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $sso->getBrokerId();
                        }
                        if ($usr) {
                            if (!$val) {
                                $user = $sso->getUser();
                                if ($user) {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $user->getUserId();
                                } else {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = null;
                                }
                            } else {
                                $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                            }
                        }
                        if ($grp) {
                            if (!$val) {
                                $group = $sso->getBrokerGroup();
                                if ($group) {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $group->getGrpId();
                                } else {
                                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = null;
                                }
                            } else {
                                $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                            }
                        }
                    } else {
                        if ($val === false) {
                            $val = 0;
                        }
                        if ($dtz && $val != '') {
                            $val = \FreeFW\Tools\Date::stringToMysql($val);
                        } else {
                            if ($str && trim((string)$val) == '') {
                                $val = null;
                            }
                        }
                        $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                    }
                }
            }
        }
        // Uniq fields...
        $next = true;
        $indexes = $p_model->getModelDescriptionIndexes();
        foreach ($indexes as $ixName => $oneIndex) {
            if (is_array($oneIndex['fields'])) {
                $cFields = $oneIndex['fields'];
            } else {
                $cFields = explode(',', $oneIndex['fields']);
            }
            $filters = [];
            $existF = false;
            foreach ($cFields as $name) {
                if ($p_model->get($name) != '') {
                    $filters[$name] = $p_model->get($name);
                    $existF = true;
                }
            }
            if ($existF) {
                if ($brk) {
                    $filters[$brkField] = $sso->getBrokerId();
                }
                $filters[$pkField] = [\FreeFW\Storage\Storage::COND_NOT_EQUAL => $p_model->get($pkField)];
                $others = $p_model->find($filters);
                if ($others->count() > 0) {
                    $code = \FreeFW\Constants::ERROR_UNIQINDEX;
                    if (isset($oneIndex['exists'])) {
                        $code = $oneIndex['exists'];
                    }
                    $p_model->addError(
                        $code,
                        $ixName . ' already exists !',
                        \FreeFW\Core\Error::TYPE_PRECONDITION,
                        $oneIndex['fields']
                    );
                    $next = false;
                }
            }
        }
        if (!$next) {
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            return false;
        }
        // Build query
        $sql = \FreeFW\Tools\Sql::makeUpdateQuery($source, $fields, $pks);
        $this->logger->debug('PDOStorage.save : ' . $sql);
        //$this->logger->debug('PDOStorage.save : ' . print_r($fields, true));
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($fields)) {
                if (!$p_raw && method_exists($p_model, 'afterSave')) {
                    $this->logger->debug('PDOStorage.afterSave');
                    if (!$p_model->afterSave()) {
                        $this->logger->debug('PDOStorage.afterSave.error');
                        if ($p_with_transaction) {
                            $this->provider->rollbackTransaction();
                        }
                        return false;
                    }
                }
                if ($archive) {
                    try {
                        if (APP_HISTORY) {
                            $history = \FreeFW\DI\DI::get('FreeFW::Model::History');
                            $history
                                ->setHistMethod('U')
                                ->setHistObjectName($p_model->getApiType())
                                ->setHistObjectId($p_model->getApiId())
                                ->setHistTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->setHistObject($p_model->toHistory())
                            ;
                            if (method_exists($p_model, 'getGrpId')) {
                                $history->setGrpId($p_model->getGrpId());
                            }
                            $history->create();
                        }
                    } catch (\Exception $ex) {
                        // @todo
                    }
                }
                $code = '';
                try {
                    $this->forwardRawEvent(FFCST::EVENT_STORAGE_UPDATE, $p_model);
                } catch (\Exception $ex) {
                }
                if ($p_with_transaction) {
                    $this->provider->commitTransaction();
                }
            } else {
                if ($p_with_transaction) {
                    $this->provider->rollbackTransaction();
                }
                $this->logger->debug('PDOStorage.save.error : ' . $p_model->getSource() . ' ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.save.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
            }
        } catch (\Exception $ex) {
            if ($p_with_transaction) {
                $this->provider->rollbackTransaction();
            }
            $this->logger->debug('PDOStorage.save.error : ' . $p_model->getSource() . ' ' . print_r($query->errorInfo(), true));
            $this->logger->debug('PDOStorage.save.error : ' . $ex->getMessage());
            $localErr = $query->errorInfo();
            $code     = 0;
            $message  = 'PDOStorage.save.error : ' . print_r($query->errorInfo(), true);
            if (is_array($localErr) && count($localErr) > 1) {
                $code    = intval($localErr[0]);
                $message = $localErr[2];
            }
            $p_model->addError($code, $message);
        }
        return !$p_model->hasErrors();
    }

    /**
     * Select the model
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageInterface::select()
     */
    public function select(
        \FreeFW\Core\StorageModel &$p_model,
        \FreeFW\Model\Conditions $p_conditions = null,
        array $p_relations = [],
        int $p_from = 0,
        int $p_length = 0,
        array $p_sort = [],
        string $p_force_select = '',
        $p_function = null,
        array $p_fields = [],
        $p_special = 'SELECT',
        $p_parameters = [],
        $p_force_blob = false
    ) {
        $crtAlias     = 'A';
        $aliases      = [];
        $aliases['@'] = $crtAlias;
        $ids          = [];
        $select       = $p_model->getFieldsForSelect($crtAlias, $p_fields, $this->provider, !$p_force_blob);
        $group        = $p_model->getFieldsAliasForSelect($crtAlias, $p_fields, $this->provider);
        $from         = $p_model::getSource() . ' AS ' . $crtAlias;
        $properties   = $p_model::getProperties();
        $values       = [];
        $result       = new \FreeFW\Model\ResultSet();
        $fks          = [];
        $joins        = [];
        $sso          = \FreeFW\DI\DI::getShared('sso');
        $whereBroker  = '';
        /**
         * Check specific properties
         */
        foreach ($properties as $name => $property) {
            if (isset($property[FFCST::PROPERTY_OPTIONS])) {
                if (in_array(FFCST::OPTION_PK, $property[FFCST::PROPERTY_OPTIONS])) {
                    $ids['@'] = $name;
                }
            }
            if (isset($property[FFCST::PROPERTY_FK])) {
                foreach ($property[FFCST::PROPERTY_FK] as $fkname => $fkprops) {
                    $fks[$fkname] = [
                        'left'   => $name,
                        'right'  => $fkprops,
                        'select' => true,
                    ];
                }
            }
        }
        if (method_exists($p_model, 'getRelationships')) {
            foreach ($p_model->getRelationships() as $name => $rel) {
                if ($rel['type'] !== \FreeFW\Model\Query::JOIN_NONE) {
                    $fks[$name] = [
                        'left'   => $p_model->getFieldNameByOption(FFCST::OPTION_PK),
                        'right'  => $rel,
                        'select' => isset($rel[FFCST::REL_OPTIONS]) ? in_array(\FreeFW\JsonApi\V1\Model\RelationshipObject::ONE_TO_ONE, $rel[FFCST::REL_OPTIONS]) : false,
                    ];
                }
            }
        }
        $allRels = $p_relations;
        foreach ($this->getConditionsRelations($p_conditions) as $oneCondition) {
            if (strpos($oneCondition, '.') > 0 && strpos($oneCondition, ':') === false) {
                $parts = explode('.', $oneCondition);
                array_pop($parts);
                $newRel = implode('.', $parts);
                if (!in_array($newRel, $allRels)) {
                    $allRels[] = $newRel;
                }
            }
        }
        $selectTac = [];
        foreach ($allRels as $idx => $shortcut) {
            $parts     = explode('.', $shortcut);
            $onePart   = array_shift($parts);
            $crtFKs    = $fks;
            $baseAlias = '@';
            $newModel  = null;
            $canSelect = true;
            while ($onePart != '') {
                if (isset($crtFKs[$onePart]) && !isset($joins[$onePart])) {
                    $joins[$onePart] = $crtFKs[$onePart]['right'];
                    $newModel = \FreeFW\DI\DI::get($crtFKs[$onePart]['right']['model']);
                    self::$models[$onePart] = $newModel;
                    ++$crtAlias;
                    // Je ne dois jamais ajouter pour l'instant une table en 0,n
                    $selectTac[$onePart] = true;
                    if (!isset($crtFKs[$onePart]['select']) || $crtFKs[$onePart]['select']) {
                        $addSel = $newModel->getFieldsForSelect($crtAlias, $p_fields, $this->provider, $p_length != 1);
                        if ($canSelect && (in_array($shortcut, $p_relations) || array_search($shortcut, $p_relations))) {
                            $select = $select . ', ' . $addSel;
                        }
                        //$group = $group . ', ' . $addSel;
                        $group = $group . ', ' . $newModel->getFieldsAliasForSelect($crtAlias, $p_fields, $this->provider);
                    } else {
                        $canSelect = false;
                        $selectTac[$onePart] = false;
                    }
                    $aliases[$baseAlias . '.' . $onePart] = $crtAlias;
                    $ids[$baseAlias . '.' . $onePart] = $newModel->getFieldNameByOption(FFCST::OPTION_PK);
                    $alias1   = $aliases[$baseAlias];
                    switch ($crtFKs[$onePart]['right']['type']) {
                        case \FreeFW\Model\Query::JOIN_RIGHT:
                            $from = $from . ' RIGHT JOIN ' . $newModel::getSource() . ' AS ' . $crtAlias . ' ON ';
                            $from = $from . $crtAlias . '.' . $crtFKs[$onePart]['right']['field'] . ' = ';
                            $from = $from . $alias1 . '.' . $crtFKs[$onePart]['left'];
                            break;
                        case \FreeFW\Model\Query::JOIN_LEFT:
                            $from = $from . ' LEFT JOIN ' . $newModel::getSource() . ' AS ' . $crtAlias . ' ON ';
                            $from = $from . $crtAlias . '.' . $crtFKs[$onePart]['right']['field'] . ' = ';
                            $from = $from . $alias1 . '.' . $crtFKs[$onePart]['left'];
                            break;
                        default:
                            $from = $from . ' INNER JOIN ' . $newModel::getSource() . ' AS ' . $crtAlias . ' ON ';
                            $from = $from . $crtAlias . '.' . $crtFKs[$onePart]['right']['field'] . ' = ';
                            $from = $from . $alias1 . '.' . $crtFKs[$onePart]['left'];
                            break;
                    }
                } else {
                    if (isset(self::$models[$onePart])) {
                        $newModel = self::$models[$onePart];
                        $canSelect = $selectTac[$onePart];
                    } else {
                        $newModel = null;
                    }
                }
                $baseAlias = $baseAlias . '.' . $onePart;
                if ($newModel && count($parts) > 0) {
                    $onePart    = array_shift($parts);
                    $properties = $newModel::getProperties();
                    $crtFKs     = [];
                    foreach ($properties as $name => $property) {
                        if (isset($property[FFCST::PROPERTY_FK])) {
                            foreach ($property[FFCST::PROPERTY_FK] as $fkname => $fkprops) {
                                $crtFKs[$fkname] = [
                                    'left'  => $name,
                                    'right' => $fkprops
                                ];
                            }
                        }
                    }
                } else {
                    $onePart = '';
                }
            }
        }
        $parts  = $this->renderConditions($p_conditions, $p_model, $aliases, '@');
        $where  = $parts['sql'];
        $values = $parts['values'];
        // Build query
        if (trim($where) == '') {
            $where = ' 1 = 1';
        }
        $limit = '';
        if ($p_from > 0 || $p_length > 0) {
            $limit = ' LIMIT ' . $p_from;
            if ($p_length > 0) {
                $limit = $limit . ', ' . $p_length;
            }
        }
        if ($p_force_select !== '') {
            $select = $p_force_select;
        }
        if ($p_special == 'GROUPBY') {
            $group = ' GROUP BY ' . $group;
        } else {
            $group = '';
        }
        // Sort
        $sort = '';
        foreach ($p_sort as $column => $order) {
            $myColumn = '';
            if ($sort == '') {
                $sort = ' ORDER BY ';
            } else {
                $sort = $sort . ', ';
            }
            if (strpos($column, '.') !== false) {
                $parts = explode('.', $column);
                $col   = array_pop($parts);
                $find  = '@.' . implode('.', $parts);
                if (isset($aliases[$find])) {
                    if ($col === 'id' || $col === '+id' || $col === '-id') {
                        $col = str_replace('id',  $ids[$find], $col);
                    }
                    $myColumn = $aliases[$find] . '.' . $col;
                }
            } else {
                if ($column === 'id' || $column === '+id' || $column === '-id') {
                    $column = str_replace('id',  $ids['@'], $column);
                }
                $myColumn = $aliases['@'] . '.' . $column;
            }
            if ($myColumn != '') {
                if ($order == '+') {
                    $sort = $sort . $myColumn;
                } else {
                    $sort = $sort . $myColumn . ' DESC';
                }
            }
        }
        // Build query
        $sql = 'SELECT DISTINCT ' . $select . ' FROM ' . $from . ' WHERE ( ' . $where . ' ) ' . $whereBroker . ' ' . $group . ' ' . $sort . ' ' . $limit;
        $this->logger->debug('FreeFW.PDOStorage.select : ' . $sql);
        $this->logger->debug('FreeFW.PDOStorage.fields : ' . print_r($values, true));
        //var_export($sql);
        //echo PHP_EOL;
        // I got all, run query...
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($values)) {
                if ($p_force_select !== '') {
                    $result = [];
                    while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                        if ($p_function) {
                            if (!$p_function($row)) {
                                break;
                            }
                        } else {
                            $result[] = $row;
                        }
                    }
                } else {
                    $clName = str_replace('\\', '::', get_class($p_model));
                    $this->logger->debug('FreeFW.PDOStorage.select.beforeTotalCount');
                    $result->setTotalCount($this->provider->getTotalCount());
                    $this->logger->debug('FreeFW.PDOStorage.select.afterTotalCount');
                    while ($row = $query->fetch(\PDO::FETCH_OBJ)) {
                        $model = \FreeFW\DI\DI::get($clName, true);
                        $model
                            ->setFromArray($row, $aliases, '@')
                        ;
                        if ($p_function) {
                            if (is_string($p_function) && method_exists($model, $p_function)) {
                                call_user_func_array([$model, $p_function], $p_parameters);
                            } else {
                                if (!$p_function($model)) {
                                    break;
                                }
                            }
                        } else {
                            $result[] = $model;
                        }
                    }
                    $this->logger->debug('FreeFW.PDOStorage.select.afterLoaded');
                }
            } else {
                $this->logger->debug('FreeFW.PDOStorage.select.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.select.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $result->addError($code, $message);
            }
        } catch (\Exception $ex) {
            $this->logger->error('FreeFW.PDOStorage.select : ' . $ex->getMessage());
        }
        return $result;
    }

    /**
     * Count
     *
     * @param \FreeFW\Core\StorageModel $p_model
     * @param \FreeFW\Model\Conditions  $p_conditions
     *
     * @return \FreeFW\Model\ResultSet
     */
    public function count(
        \FreeFW\Core\StorageModel &$p_model,
        \FreeFW\Model\Conditions $p_conditions = null,
        array $p_relations = [],
        int $p_from = 0,
        int $p_length = 0,
        array $p_sort = []
    ) {
        $result = $this->select(
            $p_model,
            $p_conditions,
            $p_relations,
            $p_from,
            $p_length,
            $p_sort,
            'COUNT(*) AS MONTOT'
        );
        return new \FreeFW\Model\ResultSet($result);
    }

    /**
     * Update the model
     *
     * @param \FreeFW\Core\StorageModel $p_model
     * @param array                     $p_fields
     * @param \FreeFW\Model\Conditions  $p_conditions
     *
     * @return boolean
     */
    public function update(
        \FreeFW\Core\StorageModel &$p_model,
        array $p_fields,
        \FreeFW\Model\Conditions $p_conditions = null
    ) {
        $source     = $p_model::getSource();
        $properties = $p_model::getProperties();
        $values     = [];
        $ok         = false;
        //
        $parts  = $this->renderConditions($p_conditions, $p_model);
        $where  = $parts['sql'];
        $values = $parts['values'];
        // Build set
        $set = '';
        $fields = [];
        foreach ($p_fields as $name => $value) {
            $dtz = false;
            if (isset($properties[$name])) {
                $oneProperty = $properties[$name];
                if (!is_array($value)) {
                    if ($oneProperty[FFCST::PROPERTY_TYPE] == FFCST::TYPE_DATETIMETZ) {
                        $dtz = true;
                    }
                    // Get data
                    $val = $value;
                    if ($dtz && $value != '') {
                        $val = \FreeFW\Tools\Date::stringToMysql($value);
                    }
                    $fields[':' . $oneProperty[FFCST::PROPERTY_PRIVATE]] = $val;
                    if ($set != '') {
                        $set .= ', ';
                    }
                    $set = $set . $oneProperty[FFCST::PROPERTY_PRIVATE] . ' = :' . $oneProperty[FFCST::PROPERTY_PRIVATE];
                } else {
                    foreach ($value as $idx2 => $value2) {
                        if ($idx2 === 'noescape') {
                            if ($set != '') {
                                $set .= ', ';
                            }
                            $set = $set . $oneProperty[FFCST::PROPERTY_PRIVATE] . ' = ' . $value2;
                        }
                    }
                }
            } else {
                // @todo : exception
            }
        }
        // Build query
        $sql = 'UPDATE ' . $source . ' SET ' . $set . ' WHERE ' . $where;
        $this->logger->debug('PDOStorage.update : ' . $sql);
        $this->logger->debug('PDOStorage.update : ' . var_export(array_merge($values, $fields), true));
        // I got all, run query...
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute(array_merge($values, $fields))) {
                $ok = true;
            } else {
                $this->logger->debug('PDOStorage.update.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.update.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
            }
        } catch (\Exception $ex) {
            var_dump($ex);
        }
        return $ok;
    }

    /**
     * Remove the model
     *
     * @param \FreeFW\Core\StorageModel $p_model
     * @param array                     $p_conditions
     *
     * @return boolean
     */
    public function delete(
        \FreeFW\Core\StorageModel &$p_model,
        \FreeFW\Model\Conditions $p_conditions = null
    ) {
        $source     = $p_model::getSource();
        $properties = $p_model::getProperties();
        $values     = [];
        $ok         = false;
        //
        $parts  = $this->renderConditions($p_conditions, $p_model);
        $where  = $parts['sql'];
        $values = $parts['values'];
        // Build query
        $sql = 'DELETE FROM ' . $source . ' WHERE ' . $where;
        $this->logger->debug('PDOStorage.delete : ' . $sql);
        // I got all, run query...
        try {
            // Get PDO and execute
            $query = $this->provider->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
            if ($query->execute($values)) {
                $ok = true;
            } else {
                $this->logger->debug('PDOStorage.delete.error : ' . print_r($query->errorInfo(), true));
                $localErr = $query->errorInfo();
                $code     = 0;
                $message  = 'PDOStorage.delete.error : ' . print_r($query->errorInfo(), true);
                if (is_array($localErr) && count($localErr) > 1) {
                    $code    = intval($localErr[0]);
                    $message = $localErr[2];
                }
                $p_model->addError($code, $message);
            }
        } catch (\Exception $ex) {
            var_dump($ex);
        }
        return $ok;
    }

    /**
     * Render conditions
     *
     * @param \FreeFW\Model\Conditions   $p_conditions
     * @param  \FreeFW\Core\StorageModel $p_model
     */
    protected function renderConditions(
        \FreeFW\Model\Conditions $p_conditions,
        \FreeFW\Core\StorageModel $p_model,
        array $p_aliases = [],
        $p_crtAlias = '@'
    ) {
        $result = [
            'sql'    => '',
            'type'   => false,
            'values' => []
        ];
        $oper = ' AND ';
        if ($p_conditions->getOperator() == \FreeFW\Storage\Storage::COND_OR) {
            $oper = ' OR ';
        }
        foreach ($p_conditions as $oneCondition) {
            if ($oneCondition instanceof \FreeFW\Model\SimpleCondition) {
                $parts = $this->renderCondition($oneCondition, $p_model, $p_aliases, $p_crtAlias);
                if ($result['sql'] == '') {
                    $result['sql'] = $parts['sql'];
                    if (isset($parts['values']) && is_array($parts['values'])) {
                        $result['values'] = $parts['values'];
                    }
                } else {
                    $result['sql'] = ' ( ' . $result['sql'] . $oper . $parts['sql'] . ' ) ';
                    if (isset($parts['values']) && is_array($parts['values'])) {
                        $result['values'] = array_merge($result['values'], $parts['values']);
                    }
                }
            } else {
                $parts = $this->renderConditions($oneCondition, $p_model, $p_aliases, $p_crtAlias);
                if ($result['sql'] == '') {
                    $result['sql']    = $parts['sql'];
                    if (isset($parts['values']) && is_array($parts['values'])) {
                        $result['values'] = $parts['values'];
                    }
                } else {
                    $result['sql']    = ' ( ' . $result['sql'] . $oper . $parts['sql'] . ' ) ';
                    if (isset($parts['values']) && is_array($parts['values'])) {
                        $result['values'] = array_merge($result['values'], $parts['values']);
                    }
                }
            }
        }
        return $result;
    }

    /**
     * Render a condition
     *
     * @param \FreeFW\Interfaces\ConditionInterface $p_field
     * @param \FreeFW\Core\StorageModel             $p_model
     * @param array                                 $p_aliases
     * @param string                                $p_crtAlias
     * @param boolean                               $p_multi
     *
     * @throws \FreeFW\Core\FreeFWStorageException
     *
     * @return array
     */
    protected function renderConditionField(
        \FreeFW\Interfaces\ConditionInterface $p_field,
        \FreeFW\Core\StorageModel $p_model,
        array $p_aliases = [],
        $p_crtAlias = '@',
        $p_multi = false
    ) {
        if ($p_field instanceof \FreeFW\Model\ConditionMember) {
            $field = $p_field->getValue();
            return $this->renderModelField($field, $p_model, $p_aliases, $p_crtAlias);
        } else {
            if ($p_field instanceof \FreeFW\Model\ConditionValue) {
                $value = $p_field->getValue();
                return $this->renderValueField($value, $p_model, $p_multi);
            } else {
                throw new \FreeFW\Core\FreeFWStorageException(
                    sprintf('Unknown condition object !')
                );
            }
        }
    }

    /**
     * Render a full condition
     *
     * @param \FreeFW\Model\SimpleCondition $p_condition
     * @param \FreeFW\Core\StorageModel     $p_model
     *
     * @throws \FreeFW\Core\FreeFWStorageException
     */
    protected function renderCondition(
        \FreeFW\Model\SimpleCondition $p_condition,
        \FreeFW\Core\StorageModel $p_model,
        array $p_aliases = [],
        $p_crtAlias = '@'
    ) {
        $result   = [];
        $left     = $p_condition->getLeftMember();
        $right    = $p_condition->getRightMember();
        $oper     = $p_condition->getOperator();
        $provider = $this->getProvider();
        $addL     = '';
        $addR     = '';
        $realOper = '=';
        $nullable = false;
        $notnull  = false;
        $sql      = false;
        $multi    = false;
        $reverse  = false;
        $arrayMod = '()';
        $fctL     = '';
        $fctR     = '';
        switch ($oper) {
            case \FreeFW\Storage\Storage::COND_LOWER_OR_NULL:
                $nullable = true;
            case \FreeFW\Storage\Storage::COND_LOWER:
                $realOper = '<';
                break;
            case \FreeFW\Storage\Storage::COND_LOWER_EQUAL_OR_NULL:
                $nullable = true;
            case \FreeFW\Storage\Storage::COND_LOWER_EQUAL:
                $realOper = '<=';
                break;
            case \FreeFW\Storage\Storage::COND_GREATER_OR_NULL:
                $nullable = true;
            case \FreeFW\Storage\Storage::COND_GREATER:
                $realOper = '>';
                break;
            case \FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL:
                $nullable = true;
            case \FreeFW\Storage\Storage::COND_GREATER_EQUAL:
                $realOper = '>=';
                break;
            case \FreeFW\Storage\Storage::COND_EQUAL:
                $realOper = '=';
                if ($right === null) {
                    $nullable = true;
                }
                break;
            case \FreeFW\Storage\Storage::COND_NOT_EQUAL:
                $realOper = '!=';
                $reverse  = true;
                break;
            case \FreeFW\Storage\Storage::COND_NOT_EQUAL_OR_NULL:
                $realOper = '!=';
                $nullable = true;
                $reverse  = true;
                break;
            case \FreeFW\Storage\Storage::COND_SOUND_LIKE:
                $realOper = 'SOUNDEX';
                $fctL     = '';
                $fctR     = '';
                break;
            case \FreeFW\Storage\Storage::COND_BEGIN_WITH:
                $realOper = 'like';
                $addL     = '^';
                $addR     = '';
                break;
            case \FreeFW\Storage\Storage::COND_END_WITH:
                $realOper = 'like';
                $addL     = '';
                $addR     = '$';
                break;
            case \FreeFW\Storage\Storage::COND_LIKE:
                $realOper = 'like';
                $addL     = '';
                $addR     = '';
                break;
            case \FreeFW\Storage\Storage::COND_NOT_LIKE:
                $realOper = 'not like';
                $addL     = '';
                $addR     = '';
                break;
            case \FreeFW\Storage\Storage::COND_EQUAL_OR_NULL:
                $realOper = '=';
                $nullable = true;
                break;
            case \FreeFW\Storage\Storage::COND_BETWEEN:
                $realOper = ' BETWEEN ';
                $arrayMod = 'AND';
                $multi = true;
                break;
            case \FreeFW\Storage\Storage::COND_IN:
                $realOper = ' IN ';
                $multi = true;
                break;
            case \FreeFW\Storage\Storage::COND_NOT_IN:
                $realOper = ' NOT IN ';
                $multi    = true;
                $reverse  = true;
                break;
            case \FreeFW\Storage\Storage::COND_EMPTY:
                $realOper = '=';
                $nullable = true;
                break;
            case \FreeFW\Storage\Storage::COND_NOT_EMPTY:
                $realOper = '!=';
                $notnull  = true;
                $reverse  = true;
                break;
            case \FreeFW\Storage\Storage::COND_GLOBAL_MAX:
                $realOper = '=';
                $right    = null;
                $sql      = 'MAX';
                break;
        }
        if ($realOper == '=' && $nullable && $right === null) {
            $realOper = ' IS NULL';
        } else {
            if ($realOper == '!=' && $notnull && $right === null) {
                $realOper = ' IS NOT NULL';
            }
        }
        if ($left !== null ) {
            $leftDatas  = $this->renderConditionField($left, $p_model, $p_aliases, $p_crtAlias);
            if (isset($leftDatas['fct']) && $leftDatas['fct'] != '') {
                $leftDatas['id'] = $provider->convertFunction($leftDatas['fct'], $leftDatas['id']);
            }
            $leftId = $leftDatas['id'];
            if ($fctL != '') {
                $leftId = $fctL . '(' . $leftId . ')';
            }
            if ($right !== null) {
                $rightDatas = $this->renderConditionField($right, $p_model, $p_aliases, $p_crtAlias, $multi);
                $result     = [
                    'values' => [],
                    'type'   => false
                ];
                if (!is_array($rightDatas['id'])) {
                    if ($multi) {
                        $rightId = ' ( ' . $rightDatas['id'] . ' ) ';
                    } else {
                        $rightId = $rightDatas['id'];
                    }
                    if ($fctR != '') {
                        $rightId = $fctR . '(' . $rightId . ')';
                    }
                } else {
                    if ($arrayMod == '()') {
                        $rightId = ' ( ' . implode(', ', $rightDatas['id']) . ' ) ';
                    } else {
                        $rightId = $rightDatas['id'][0] . ' AND ' . $rightDatas['id'][1];
                    }
                }
                if ($nullable) {
                    $result['sql'] = '(' .
                        $leftId . $realOper . $rightId . ' OR ' .
                        $leftId . ' IS NULL)'
                    ;
                } else {
                    if ($notnull) {
                        $result['sql'] = '(' .
                            $leftId . $realOper . $rightId . ' AND ' .
                            $leftId . ' IS NOT NULL)'
                        ;
                    } else {
                        if ($realOper === 'like') {
                            $result['sql'] = $leftId . ' REGEXP ' . $rightId;
                        } else {
                            if ($realOper === 'not like') {
                                $result['sql'] = $leftId . ' NOT REGEXP ' . $rightId;
                            } else {
                                if ($realOper == 'SOUNDEX') {
                                    $result['sql'] = '(SOUNDEX(' . $leftId . ') = SOUNDEX(' . $rightId . ') OR ' .
                                                    $leftId . ' REGEXP ' . $rightDatas['id'] . '_2' . ')';
                                    $nData = $rightDatas['value'];
                                    $nData = \FreeFW\Tools\PBXString::toSqlRegexp($nData);
                                    $result['values'][$rightDatas['id'] . '_2'] = $addL . $nData . $addR;
                                } else {
                                    $result['sql'] = $leftId . ' ' . $realOper . ' ' . $rightId;
                                }
                            }
                        }
                    }
                }
                if ($leftDatas['type'] === false) {
                    $result['values'][$leftDatas['id']] = $leftDatas['value'];
                } else {
                    $result['type'] = $leftDatas['type'];
                }
                if (!is_array($rightDatas['id'])) {
                    if ($rightDatas['type'] === false) {
                        if ($leftDatas['type'] === \FreeFW\Constants::TYPE_DATETIMETZ) {
                            if (substr($rightDatas['value'], -1) === 'Z') {
                                $rightDatas['value'] = \FreeFW\Tools\Date::stringToMysql($rightDatas['value']);
                            }
                        } else {
                            if ($leftDatas['type'] === \FreeFW\Constants::TYPE_MONETARY || $leftDatas['type'] === \FreeFW\Constants::TYPE_DECIMAL) {
                                if (!is_numeric($rightDatas['value'])) {
                                    $rightDatas['value'] = 8989786756;
                                }
                            }
                        }
                        $nData = $rightDatas['value'];
                        if ($realOper === 'like') {
                            $nData = \FreeFW\Tools\PBXString::toSqlRegexp($nData);
                        }
                        $result['values'][$rightDatas['id']] = $addL . $nData . $addR;
                    } else {
                        $result['type'] = $rightDatas['type'];
                    }
                } else {
                    foreach ($rightDatas['id'] as $idx => $id) {
                        $result['values'][$id] = $addL . $rightDatas['value'][$idx];
                    }
                }
            } else {
                $result['sql'] = $leftDatas['id'] . ' ' . $realOper;
                if ($sql !== false) {
                    if ($sql === 'MAX') {
                        $result['sql'] .= ' ( SELECT MAX(' . $leftDatas['id'] . ') FROM ' . $p_model->getSource() . ' )';
                    }
                } else {
                    if ($leftDatas['type'] === false) {
                        $result['values'][$leftDatas['id']] = $leftDatas['value'];
                    } else {
                        if ($leftDatas['type'] !== 'STRING') {
                            $result['type'] = $leftDatas['type'];
                        }
                    }
                }
            }
        } else {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('Wrong fields for %s condition', $oper)
            );
        }
        return $result;
    }

    /**
     * Return getSource du modèle précédé de son dbname
     * @example `demo`.t_contrat
     *
     * @param \FreeFW\Core\StorageModel $p_model
     * @return string
     */
    public function getFrom(&$p_model)
    {
        return $p_model::getSource();
    }

    /**
     * Render a model field
     *
     * @param string                    $p_field
     * @param \FreeFW\Core\StorageModel $p_model
     *
     * @throws \FreeFW\Core\FreeFWStorageException
     */
    protected function renderModelField(
        string $p_field,
        \FreeFW\Core\StorageModel $p_model,
        array $p_aliases = [],
        $p_crtAlias = '@'
    ) {
        $alias = false;
        $parts = explode('.', $p_field);
        if (count($parts) > 1) {
            $field = array_pop($parts);
            $class = $parts[count($parts)-1];
            if (!isset(self::$models[$class])) {
                try {
                    self::$models[$class] = \FreeFW\DI\DI::get($class);
                } catch (\Exception $e) {
                    var_dump($p_field, $class, $p_aliases);die;
                    throw new \FreeFW\Core\FreeFWStorageException(sprintf('Unknown model : %s !', $class));
                }
            }
            $aliasKey = $p_crtAlias . (count($parts)>0 ? '.' . implode('.', $parts) : '');
            if (isset($p_aliases[$aliasKey])) {
                $alias = $p_aliases[$aliasKey];
            }
            $model      = self::$models[$class];
            $source     = $model::getSource();
            $properties = $model::getProperties();
            // Convert id to ApiId
            if ($field == 'id') {
                $field = $model->getFieldNameByOption(FFCST::OPTION_PK);
            }
        } else {
            $source     = $this->getFrom($p_model);
            $properties = $p_model::getProperties();
            $field      = $parts[0];
            // Convert id to ApiId
            if ($field === 'id') {
                $field = $p_model->getFieldNameByOption(FFCST::OPTION_PK);
            }
        }
        if ($alias === false) {
            if (isset($p_aliases[$p_crtAlias])) {
                $alias = $p_aliases[$p_crtAlias]; // correspond à l'alias de la table dite 'principal'
            } else {
                $alias = $source;
            }
        }
        $type     = \FreeFW\Constants::TYPE_STRING;
        $function = null;
        if (isset($properties[$field])) {
            $fieldProperties = $properties[$field];
            $type            = $properties[$field][FFCST::PROPERTY_TYPE];
            if (isset($fieldProperties[FFCST::PROPERTY_FUNCTION])) {
                foreach ($fieldProperties[FFCST::PROPERTY_FUNCTION] as $fct => $orig) {
                    $fieldProperties2 = $properties[$orig];
                    $real             = $alias . '.' . $fieldProperties2[FFCST::PROPERTY_PRIVATE];
                    $type             = $fieldProperties2[FFCST::PROPERTY_TYPE];
                    $function         = $fct;
                    break;
                }
            } else {
                $real = $alias . '.' . $fieldProperties[FFCST::PROPERTY_PRIVATE];
                $type = $fieldProperties[FFCST::PROPERTY_TYPE];
            }
        } else {
            throw new \FreeFW\Core\FreeFWStorageException(sprintf('Unknown field : %s !', $p_field));
        }
        return [
            'id'    => $real,
            'value' => $p_field,
            'type'  => $type,
            'fct'   => $function
        ];
    }

    /**
     * Render a value
     *
     * @param mixed                     $p_value
     * @param \FreeFW\Core\StorageModel $p_model
     * @param boolean                   $p_multi
     *
     * @return []
     */
    protected function renderValueField($p_value, \FreeFW\Core\StorageModel $p_model, $p_multi = false)
    {
        $value = $p_value;
        if (!is_array($value) && $p_multi) {
            $value = explode(',', str_replace(['[', ']'], '', $value));
        }
        if (!is_array($value)) {
            self::$uniqid = self::$uniqid + 1;
            return [
                'id'    => ':i' . rand(10, 99) . '_' . self::$uniqid,
                'value' => $value,
                'type'  => false
            ];
        } else {
            $ii  = 0;
            $ret = [
                'id'    => [],
                'value' => [],
                'type'  => false
            ];
            foreach ($value as $oneValue) {
                $ii++;
                $ret['id'][]    = ':i' . $ii . rand(10, 99) . '_' . self::$uniqid;
                $ret['value'][] = $oneValue;
            }
            return $ret;
        }
    }

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Interfaces\StorageInterface::getFields()
     */
    public function getFields(string $p_object): array
    {
        $fields = [];
        if ($this->provider) {
            $rs = $this->provider->query('SELECT * FROM ' . $p_object . ' LIMIT 0');
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $fields[] = \FreeFW\Model\Field::getFromPDO($rs->getColumnMeta($i));
            }
        }
        return $fields;
    }

    /**
     * Get provider
     *
     * @return \FreeFW\Interfaces\StorageProviderInterface
     */
    public function getProvider() : \FreeFW\Interfaces\StorageProviderInterface
    {
        return $this->provider;
    }
}
