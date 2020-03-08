<?php
namespace FreeAsso\Model;

use \FreeFW\Constants as FFCST;

/**
 * Family
 *
 * @author jeromeklam
 */
class Family extends \FreeAsso\Model\Base\Family
{

    /**
     * Codes internes
     * @var string
     */
    const CODE_OTHER = 'OTHER';

    /**
     * Parent
     * @var \FreeAsso\Model\Family
     */
    protected $parent = null;

    /**
     *
     * {@inheritDoc}
     * @see \FreeFW\Core\Model::init()
     */
    public function init()
    {
        $this->fam_id       = 0;
        $this->brk_id       = 0;
        $this->fam_code_int = self::CODE_OTHER;
        return $this;
    }

    /**
     * Set parent
     * 
     * @param \FreeAsso\Model\Family $p_parent
     * 
     * @return \FreeAsso\Model\Family
     */
    public function setParent($p_parent)
    {
        $this->parent = $p_parent;
        return $this;
    }

    /**
     * Get Parent
     * 
     * @return \FreeAsso\Model\Family
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * 
     * @return boolean
     */
    public function beforeRemove()
    {
        $properties       = $this->getProperties();
        $parentProperty   = false;
        $positionProperty = false;
        $levelProperty    = false;
        $leftProperty     = false;
        $rightProperty    = false;
        $foreignKey       = false;
        $parentGetter     = false;
        $levelGetter      = false;
        $levelSetter      = false;
        $leftGetter       = false;
        $leftSetter       = false;
        $rightGetter      = false;
        $rightSetter      = false;
        $positionGetter   = false;
        $positionSetter   = false;
        $parentId         = false;
        $parentModel      = false;
        $parentIdField    = false;
        $sibling          = false;
        try {
            foreach ($properties as $name => $oneProperty) {
                if (in_array(FFCST::OPTION_NESTED_PARENT_ID, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $parentProperty = $oneProperty;
                    if (array_key_exists(FFCST::PROPERTY_FK, $oneProperty)) {
                        $foreignKey = $oneProperty[FFCST::PROPERTY_FK];
                        foreach ($foreignKey as $idx => $value) {
                            $parentGetter  = 'get' . \FreeFW\Tools\PBXString::toCamelCase($idx, true);
                            $parentModel   = $value['model'];
                            $parentIdField = $value['field'];
                        }
                    }
                }
                if (in_array(FFCST::OPTION_NESTED_POSITION, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $positionProperty = $oneProperty;
                    $positionSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $positionGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_LEVEL, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $levelProperty = $oneProperty;
                    $levelSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $levelGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_LEFT, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $leftProperty = $oneProperty;
                    $leftSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $leftGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_RIGHT, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $rightProperty = $oneProperty;
                    $rightSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $rightGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
            }
            $width = $this->{$rightGetter}() - $this->{$leftGetter}() + 1;
            $model = \FreeFw\DI\DI::get($parentModel);
            /*
            $model::delete(
                [
                    $leftProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER => $this->{$leftGetter}()],
                    $rightProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_LOWER => $this->{$rightGetter}()]
                ]
            );
            // Done via constraint on parent_id
            */
            $model::update(
                [
                    $leftProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $leftProperty[FFCST::PROPERTY_PRIVATE] . ' - ' . $width]
                ],
                [
                    $leftProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER => $this->{$rightGetter}()]
                ]
            );
            $model::update(
                [
                    $rightProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $rightProperty[FFCST::PROPERTY_PRIVATE] . ' - ' . $width]
                ],
                [
                    $rightProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER => $this->{$rightGetter}()]
                ]
            );
            return true;
        } catch (\Exception $ex) {
            // @todo
        }
        return false;
    }

    /**
     * Before create
     * 
     * @return boolean
     */
    public function beforeCreate()
    {
        // I've got the parent
        // Need to setup nested fields
        $properties       = $this->getProperties();
        $parentProperty   = false;
        $positionProperty = false;
        $levelProperty    = false;
        $leftProperty     = false;
        $rightProperty    = false;
        $foreignKey       = false;
        $parentGetter     = false;
        $levelGetter      = false;
        $levelSetter      = false;
        $leftGetter       = false;
        $leftSetter       = false;
        $rightGetter      = false;
        $rightSetter      = false;
        $positionGetter   = false;
        $positionSetter   = false;
        $parentId         = false;
        $parentModel      = false;
        $parentIdField    = false;
        $sibling          = false;
        try {
            foreach ($properties as $name => $oneProperty) {
                if (in_array(FFCST::OPTION_NESTED_PARENT_ID, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $parentProperty = $oneProperty;
                    if (array_key_exists(FFCST::PROPERTY_FK, $oneProperty)) {
                        $foreignKey = $oneProperty[FFCST::PROPERTY_FK];
                        foreach ($foreignKey as $idx => $value) {
                            $parentGetter  = 'get' . \FreeFW\Tools\PBXString::toCamelCase($idx, true);
                            $parentModel   = $value['model'];
                            $parentIdField = $value['field'];
                        }
                    }
                }
                if (in_array(FFCST::OPTION_NESTED_POSITION, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $positionProperty = $oneProperty;
                    $positionSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $positionGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_LEVEL, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $levelProperty = $oneProperty;
                    $levelSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $levelGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_LEFT, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $leftProperty = $oneProperty;
                    $leftSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $leftGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
                if (in_array(FFCST::OPTION_NESTED_RIGHT, $oneProperty[FFCST::PROPERTY_OPTIONS])) {
                    $rightProperty = $oneProperty;
                    $rightSetter = set . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                    $rightGetter = get . \FreeFW\Tools\PBXString::toCamelCase($name, true);
                }
            }
            if ($parentGetter) {
                $parent   = $this->{$parentGetter}();
                if ($parent) {
                    $parentId = $parent->getApiId();
                }
                if ($parentId) {
                    $model   = \FreeFw\DI\DI::get($parentModel);
                    $sibling = $model::findFirst(
                        [
                            $parentProperty[FFCST::PROPERTY_PRIVATE] => $parentId
                        ]
                    );
                }
            }
            if (!$sibling) {
                $parent = $model::findFirst(
                    [
                        $parentIdField => $parentId
                    ]
                );
                $level = $parent->{$levelGetter}() + 1;
                $this->{$levelSetter}($level);
                $this->{$leftSetter}($parent->{$leftGetter}() + 1);
                $this->{$rightSetter}($parent->{$leftGetter}() + 2);
                $this->{$positionSetter}(1);
                $model::update(
                    [
                        $rightProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $rightProperty[FFCST::PROPERTY_PRIVATE] . ' + 2']
                    ],
                    [
                        $rightProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER_EQUAL => $parent->{$leftGetter}()]
                    ]
                );
                $model::update(
                    [
                        $leftProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $leftProperty[FFCST::PROPERTY_PRIVATE] . ' + 2']
                    ],
                    [
                        $leftProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER => $parent->{$leftGetter}()]
                    ]
                );
            } else {
                $this->{$levelSetter}($sibling->{$levelGetter}());
                $this->{$leftSetter}($sibling->{$rightGetter}() + 1);
                $this->{$rightSetter}($sibling->{$rightGetter}() + 2);
                $this->{$positionSetter}($sibling->{$positionGetter}() + 1);
                $model::update(
                    [
                        $rightProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $rightProperty[FFCST::PROPERTY_PRIVATE] . ' + 2']
                    ],
                    [
                        $rightProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER_EQUAL => $parent->{$leftGetter}()]
                    ]
                );
                $model::update(
                    [
                        $leftProperty[FFCST::PROPERTY_PRIVATE] => [ 'noescape' => $leftProperty[FFCST::PROPERTY_PRIVATE] . ' + 2']
                    ],
                    [
                        $leftProperty[FFCST::PROPERTY_PRIVATE] => [ \FreeFW\Storage\Storage::COND_GREATER => $parent->{$leftGetter}()]
                    ]
                );
            }
            return true;
        } catch (\Exception $ex) {
            // @todo
        }
        return false;
    }
}
