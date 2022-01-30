<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Cause extends \FreeFW\Core\ApiController
{

    /**
     * Get all active sponsors
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     * @param mixed                                    $p_id
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCurrentSponsors(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        /**
         * @var \FreeAsso\Service\Cause $causeService
         */
        $causeService = \FreeFW\DI\DI::get('FreeAsso::Service::Cause');
        $this->logger->debug('FreeFW.CauseController.getCurrentSponsors.start');
        $data = $causeService->getSponsors($p_id);
        $this->logger->debug('FreeFW.CauseController.getCurrentSponsors.end');
        return $this->createResponse(200, $data);
    }

    /**
     * Specific filters from site....
     *
     * @param \FreeFW\Http\ApiParams $p_api_params
     * @param string                 $p_method
     *
     * @return \FreeFW\Http\ApiParams
     */
    public function adaptApiParams(\FreeFW\Http\ApiParams $p_api_params, $p_method='')
    {
        $money = \FreeFW\DI\DI::getShared('money', 'EUR');
        if ($money != 'EUR') {
            $conditions = $p_api_params->getFilters();
            $conditions->__callback(function (&$p_condition) use ($money) {
                $left = $p_condition->getLeftMember();
                if ($left instanceof \FreeFW\Model\ConditionMember) {
                    if ($left->getValue() == 'cau_mnt_left') {
                        $right = $p_condition->getRightMember();
                        if (is_array($right->getValue())) {
                            $newRight = [];
                            foreach ($right->getValue() as $val) {
                                $newRight[] = \FreeFW\Model\Rate::convert('EUR', $money, $val);
                            }
                        } else {
                            $newRight = \FreeFW\Model\Rate::convert('EUR', $money, $right->getValue());
                        }
                        $right->setValue($newRight);
                        $p_condition->setRightMember($right);
                    }
                }
            });
        }
        return $p_api_params;
    }
}
