<?php
namespace FreeSSO\Controller\Behaviour;

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
            ->setOperator(\FreeFW\Storage\Storage::COND_EQUAL_OR_NULL)
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
        return $p_api_params;
    }
}