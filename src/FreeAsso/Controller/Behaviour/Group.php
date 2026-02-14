<?php
namespace FreeAsso\Controller\Behavior;

/**
 *
 * @author jerome.klam
 *
 */
trait Group {

    /**
     * Add options to api_params if needed
     *
     * @param \FreeFW\Http\ApiParams $p_api_params
     * @param string                 $p_method
     *
     * @return \FreeFW\Http\ApiParams
     */
    public function adaptApiParams(\FreeFW\Http\ApiParams $p_api_params, $p_method='')
    {
        $options = $p_api_params->getOption();
        if (!is_array($options)) {
            $options = explode(',', $options);
        }
        $addFilter = true;
        if (is_array($options) && isset($options['nogroup'])) {
            $addFilter = false;
        }
        if ($addFilter) {
            /**
             * @var \FreeSSO\Server $sso
             */
            $sso = \FreeFW\DI\DI::getShared('sso');
            $grpId = $sso->getUserGroup()->getGrpId();
            $defaultConditions = new \FreeFW\Model\Conditions();
            $grpCondition = new \FreeFW\Model\SimpleCondition();
            $aField = new \FreeFW\Model\ConditionMember();
            $aField->setValue('grp_id');
            $aValue = new \FreeFW\Model\ConditionValue();
            $aValue->setValue($grpId);
            $grpCondition
                ->setLeftMember($aField)
                ->setOperator(\FreeFW\Storage\Storage::COND_EQUAL)
                ->setRightMember($aValue)
            ;
            $defaultConditions
                ->setOperator(\FreeFW\Storage\Storage::COND_AND)
                ->add($grpCondition)
            ;
            $filters = $p_api_params->getFilters();
            if ($filters) {
                $defaultConditions->add($filters);
            }
            $p_api_params->setFilters($defaultConditions);
        }
        return $p_api_params;
    }
}