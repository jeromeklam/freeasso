<?php
namespace FreeAsso\Controller;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Donation extends \FreeFW\Core\ApiController
{

    /**
     * Get all year
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function getDonationYears(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeAsso.Donation.getDonationYears.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if (!isset($p_request->default_model)) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        $default = $p_request->default_model;
        $model = \FreeFW\DI\DI::get($default);
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = $model->getQuery();
        $query
            ->setType(\FreeFW\Model\Query::QUERY_GROUP)
            ->addField('don_real_ts_year')
            ->addConditions($apiParams->getFilters())
            ->addRelations($apiParams->getInclude())
            ->setLimit($apiParams->getStart(), $apiParams->getlength())
            ->setSort($apiParams->getSort())
        ;
        $data = new \FreeFW\Model\ResultSet();
        if ($query->execute()) {
            foreach($query->getResult() as $oneResult) {
                $oneDY = new \FreeAsso\Model\DonationYear();
                $oneDY
                    ->setDonyId($oneResult->getDonRealTsYear())
                    ->setDonRealTsYear($oneResult->getDonRealTsYear())
                ;
                $data->add($oneDY);
            }
        }
        // data can be empty, but it's a 2*
        $this->logger->debug('FreeAsso.Donation.getDonationYears.end');
        return $this->createSuccessOkResponse($data); // 200
    }
}
