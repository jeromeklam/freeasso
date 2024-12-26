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
     * Comportement
     */
    use \FreeAsso\Controller\Behaviour\Group;

    /**
     * Set manual matched
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function setManualMatched(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.DonationController.setManualMatched.start');
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $p_id]);
        if ($donation) {
            $donation
                ->setDonVerif(\FreeAsso\Model\Donation::VERIF_MANUAL)
                ->setDonDesc('validé manuellement')
                ->setDonVerifComment('Validé le ' . \FreeFW\Tools\Date::mysqlToddmmyyyy(\FreeFW\Tools\Date::getCurrentTimestamp()));
            if ($donation->save()) {
                return $this->createSuccessOkResponse($donation);
            }
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $donation);
        }
        $this->logger->debug('FreeAsso.DonationController.setManualMatched.end');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
    }

    /**
     * Set unmatched
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function setUnmatched(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.DonationController.setUnmatched.start');
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $p_id]);
        if ($donation) {
            $donation
                ->setAcclId(null)
                ->setDonVerif(\FreeAsso\Model\Donation::VERIF_NONE)
                ->setDonDesc('contrôle dévalidé')
                ->setDonVerifComment('Dévalidé le ' . \FreeFW\Tools\Date::mysqlToddmmyyyy(\FreeFW\Tools\Date::getCurrentTimestamp()));
            if ($donation->save()) {
                return $this->createSuccessOkResponse($donation);
            }
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $donation);
        }
        $this->logger->debug('FreeAsso.DonationController.setUnmatched.end');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
    }

    /**
     * Set paid
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function setPaid(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.DonationController.setPaid.start');
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $p_id]);
        if ($donation) {
            $donation
                ->setDonStatus(\FreeAsso\Model\Donation::STATUS_OK)
                ->setDonDesc('payé');
            if ($donation->save()) {
                return $this->createSuccessOkResponse($donation);
            }
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $donation);
        }
        $this->logger->debug('FreeAsso.DonationController.setPaid.end');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
    }

    /**
     * Set unpaid
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function setUnpaid(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.DonationController.setUnpaid.start');
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $p_id]);
        if ($donation) {
            $donation
                ->setDonStatus(\FreeAsso\Model\Donation::STATUS_NOK)
                ->setDonDesc('impayé');
            if ($donation->save()) {
                return $this->createSuccessOkResponse($donation);
            }
            return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_UPDATE, $donation);
        }
        $this->logger->debug('FreeAsso.DonationController.setUnpaid.end');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
    }

    /**
     * Send by email
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function sendOne(\Psr\Http\Message\ServerRequestInterface $p_request, $p_id = null)
    {
        $this->logger->debug('FreeAsso.DonationController.sendOne.start');
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeAsso\Model\Donation::findFirst(['don_id' => $p_id]);
        if ($donation) {
            /**
             * @var \FreeAsso\Service\Donation $donationService
             */
            $donationService = \FreeFW\DI\DI::get('FreeAsso::Service::Donation');
            if ($donationService->notification($donation, 'create', true)) {
                return $this->createSuccessEmptyResponse();
            }
        }
        $this->logger->debug('FreeAsso.DonationController.sendOne.end');
        return $this->createErrorResponse(\FreeFW\Constants::ERROR_NOT_FOUND, null);
    }

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
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'getDonationYears');
        }
        $default = $p_request->getAttribute('default_model');
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
            ->setSort($apiParams->getSort());
        $data = new \FreeFW\Model\ResultSet();
        if ($query->execute()) {
            foreach ($query->getResult() as $oneResult) {
                $oneDY = new \FreeAsso\Model\DonationYear();
                $oneDY
                    ->setDonyId($oneResult->getDonRealTsYear())
                    ->setDonRealTsYear($oneResult->getDonRealTsYear());
                $data->add($oneDY);
            }
        }
        // data can be empty, but it's a 2*
        $this->logger->debug('FreeAsso.Donation.getDonationYears.end');
        return $this->createSuccessOkResponse($data); // 200
    }

    /**
     * Get statistics
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     */
    public function getStatistics(\Psr\Http\Message\ServerRequestInterface $p_request)
    {
        $this->logger->debug('FreeFW.ApiController.getStatistics.start');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        if ($p_request->getAttribute('default_model') === null) {
            throw new \FreeFW\Core\FreeFWStorageException(
                sprintf('No default model for route !')
            );
        }
        if (method_exists($this, 'adaptApiParams')) {
            $apiParams = $this->adaptApiParams($apiParams, 'getAll');
        }
        $default = $p_request->getAttribute('default_model');
        $model = \FreeFW\DI\DI::get($default);
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = $model->getQuery();
        $query
            ->addConditions($apiParams->getFilters())
            ->addRelations($apiParams->getInclude());

        // Create new PHPExcel object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator("Administration Kalaweit")
            ->setLastModifiedBy("Administration Kalaweitw")
            ->setTitle("Statistiques Kalaweit")
            ->setSubject("Statistiques Kalaweit")
            ->setDescription("Statistiques Kalaweit")
            ->setKeywords("KALAWEIT STATISTIC")
            ->setCategory("KALAWEIT STATISTIC");

        $stats = [];
        $query->execute([], 'computeStatistics', [&$stats]);
        $objWorksheet = $spreadsheet->getActiveSheet();
        $objWorksheet->setTitle('Statistiques');
        $cols  = [];
        $rows  = [];
        $first = 'B';
        foreach ($stats as $key => $oneStat) {
            if (!isset($cols[$key])) {
                $cols[$key] = $first;
                $first++;
                $objWorksheet->setCellValue($cols[$key] . '1', $key);
            }
            $r = '2';
            $objWorksheet->setCellValue($cols[$key] . '2', $oneStat['total']);
        }

        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $tmp = '/tmp/stats_' . uniqid() . '.xslx';
        $content = $objWriter->save($tmp);

        // data can be empty, but it's a 2*
        $this->logger->debug('FreeFW.ApiController.getStatistics.end');
        return $this->createMimeTypeResponse('statistics.xlsx', file_get_contents($tmp)); // 200
    }
}
