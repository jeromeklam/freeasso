<?php
namespace FreeAsso\Controller;

use \FreeFW\Constants as FFCST;

/**
 * Model controller
 *
 * @author jeromeklam
 */
class Member extends \FreeFW\Core\Controller
{
    /**
     * Errors
     */
    const ERROR_DUPLICATE_EMAIL = 6650001;
    const ERROR_EMAIL_NOT_FOUND = 6650002;

    /**
     * Client to Member
     *
     * @param \FreeAsso\Model\Client $p_client
     * 
     * @return \FreeAsso\Model\Member
     */
    protected function clientToMember($p_client)
    {
        $member = new \FreeAsso\Model\Member();
        $member->mbr_id = $p_client->getCliId();
        $member->mbr_lastname = $p_client->getCliLastname();
        $member->mbr_firstname = $p_client->getCliFirstname();
        $member->mbr_address1 = $p_client->getCliAddress1();
        $member->mbr_address2 = $p_client->getCliAddress2();
        $member->mbr_address3 = $p_client->getCliAddress3();
        $member->mbr_zipcode = $p_client->getCliCp();
        $member->mbr_city = $p_client->getCliTown();
        $member->mbr_country = 'FR';
        if ($p_client->getCountry()) {
            $member->mbr_country = strtoupper($p_client->getCountry()->getCntyCode());
        }
        if ($member->mbr_country == '') {
            $member->mbr_country = 'FR';
        }
        $member->mbr_email = $p_client->getCliEmail();
        $member->mbr_phone = $p_client->getCliPhoneHome();
        $member->mbr_langage = 'FR';
        if ($p_client->getLang()) {
            $member->mbr_langage = strtoupper($p_client->getLang()->getLangCode());
        }
        if ($member->mbr_langage == '') {
            $member->mbr_langage = 'FR';
        }
        $member->mbr_send_receipt = $p_client->getCliReceipt();
        $member->mbr_category = 'PARTICULIER';
        if ($p_client->getClientCategory()) {
            $member->mbr_category = strtoupper($p_client->getClientCategory()->getClicCode());
        }
        if ($member->mbr_category == '') {
            $member->mbr_category = 'PARTICULIER';
        }
        return $member;
    }

    /**
     * Member verification
     *
     * @param string $p_email
     * 
     * @return mixed
     */
    protected function verifyMember($p_email)
    {
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = \FreeAsso\Model\Client::getQuery();
        $query
            ->addFromFilters(['cli_email' => $p_email])
            ->addRelations(['country','category'])
        ;
        if ($query->execute()) {
            $clients = $query->getResult();
            if ($clients->count() > 1) {
                throw new \Exception("Multiple emails", self::ERROR_DUPLICATE_EMAIL);
            } else {
                if ($clients->count() <= 0) {
                    throw new \Exception("Member not found", self::ERROR_EMAIL_NOT_FOUND);
                }
            }
            return $this->clientToMember($clients[0]);
        }
        return null;
    }

    /**
     * Member informations
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function infos(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $data    = [];
        $sso     = \FreeFW\DI\DI::getShared('sso');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        $member  = null;
        try {
            $member = $this->verifyMember($p_email);
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, serialize($member));
    }

    /**
     * Member gibbons
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function gibbons(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $data    = [];
        $sso     = \FreeFW\DI\DI::getShared('sso');
        $storage = \FreeFW\DI\DI::getShared('Storage::default');
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        $causes    = null;
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Cause::getQuery();
            $query
                ->addFromFilters(
                    [
                        'donations.cli_id' => $member->mbr_id,
                        'cause_type.caut_family' => \FreeAsso\Model\CauseType::FAMILY_ANIMAL,
                        'cau_to' => null
                    ]
                )
                ->addRelations($apiParams->getInclude())
                ->setSort($apiParams->getSort())
            ;
            if ($query->execute()) {
                $causes = new \FreeFW\Model\ResultSet();
                foreach ($query->getResult() as $oneCause) {
                    $donation = \FreeAsso\Model\Donation::findFirst(
                        [
                            'cau_id' => $oneCause->getCauId(),
                            'cli_id' => $member->mbr_id
                        ],
                        [
                            'don_ts' => \FreeFW\Storage\Storage::SORT_DESC
                        ]
                    );
                    if ($donation) {
                        // Hook temporaire pour passer la date du dernier don du membre
                        $oneCause->setCauDate_1($donation->getDonTs());
                    }
                    $causes[] = $oneCause;
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, $causes);
    }

    /**
     * Member donations
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function donations(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $donations  = [];
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Donation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id' => $member->mbr_id,
                    ]
                )
                ->addRelations(
                    ['cause']
                )
                ->setSort('-don_real_ts')
                ->setLimit($apiParams->getStart(), $apiParams->getlength())
            ;
            if ($query->execute()) {
                $tmp = $query->getResult();
                foreach ($tmp as $oneDonation) {
                    $newDon = new \FreeAsso\Model\MemberDonation();
                    $newDon->don_id = $oneDonation->getDonId();
                    $newDon->don_ts = $oneDonation->getDonRealTs();
                    $newDon->don_mnt = $oneDonation->getDonMntInput();
                    $newDon->don_money = $oneDonation->getDonMoneyInput();
                    $newDon->don_status = $oneDonation->getDonStatus();
                    $newDon->cau_id = $oneDonation->getCauId();
                    $newDon->cau_name = $oneDonation->getCause()->getCauName();
                    $donations[] = $newDon;
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, serialize($donations));
    }

    /**
     * Member sponsorships
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sponsorships(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $sponsorships = [];
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Sponsorship::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id' => $member->mbr_id,
                    ]
                )
                ->addRelations(
                    ['cause']
                )
                ->setSort('-spo_from')
                ->setLimit($apiParams->getStart(), $apiParams->getlength())
            ;
            if ($query->execute()) {
                $tmp = $query->getResult();
                foreach ($tmp as $oneSponsorship) {
                    $newSpo = new \FreeAsso\Model\MemberSponsorship();
                    $newSpo->spo_id = $oneSponsorship->getSpoId();
                    $newSpo->spo_from = $oneSponsorship->getSpoFrom();
                    $newSpo->spo_to = $oneSponsorship->getSpoTo();
                    $newSpo->spo_mnt = $oneSponsorship->getSpoMntInput();
                    $newSpo->spo_money = $oneSponsorship->getSpoMoneyInput();
                    $newSpo->cau_id = $oneSponsorship->getCauId();
                    $newSpo->cau_name = $oneSponsorship->getCause()->getCauName();
                    $sponsorships[] = $newSpo;
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, serialize($sponsorships));
    }

    /**
     * Member receipts
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function receipts(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $receipts = [];
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Receipt::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id' => $member->mbr_id,
                    ]
                )
                ->setLimit($apiParams->getStart(), $apiParams->getlength())
                ->setSort('-rec_ts')
            ;
            if ($query->execute()) {
                $tmpRecs  = $query->getResult();
                foreach ($tmpRecs as $oneReceipt) {
                    $receipt             = new \FreeAsso\Model\MemberReceipt();
                    $receipt->rec_id     = $oneReceipt->getRecId();
                    $receipt->rec_ts     = $oneReceipt->getRecTs();
                    $receipt->rec_mnt    = $oneReceipt->getRecMnt();
                    $receipt->rec_money  = $oneReceipt->getRecMoney();
                    $receipt->rec_year   = $oneReceipt->getRecYear();
                    $receipt->rec_number = $oneReceipt->getRecNumber();
                    $receipt->file_id    = $oneReceipt->getFileId();
                    $receipts[]          = $receipt;
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, serialize($receipts));
    }

    /**
     * Member download receipt
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadReceipt(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email, $p_rec_id)
    {
        $receipt = null;
        $code = FFCST::ERROR_NOT_FOUND;
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Receipt::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id' => $member->mbr_id,
                        'rec_id' => $p_rec_id
                    ]
                )
            ;
            if ($query->execute()) {
                $receipts = $query->getResult();
                if ($receipts->count() == 1) {
                    $receipt = $receipts[0];
                    if ($receipt) {
                        /**
                         * @var \FreeFW\Model\File $file
                         */
                        $file = \FreeFW\Model\File::findFirst(['file_id' => $receipt->getFileId()]);
                        if ($file) {
                            $this->logger->info('FreeAsso.ReceiptController.printOne.end');
                            return $this->createMimeTypeResponse($receipt->getRecNumber() . '.pdf', $file->getFileBlob());
                        } else {
                            $data = null;
                            $code = FFCST::ERROR_NOT_FOUND;
                        }
                    } else {
                        $data = null;
                        $code = FFCST::ERROR_NOT_FOUND;
                    }
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createErrorResponse($code);
    }

    /**
     * Member certificates
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function certificates(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email)
    {
        $certificates = [];
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Certificate::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id' => $member->mbr_id,
                    ]
                )
                ->addRelations(
                    ['cause']
                )
                ->setLimit($apiParams->getStart(), $apiParams->getlength())
                ->setSort('-cert_ts')
            ;
            if ($query->execute()) {
                $tmpCerts = $query->getResult();
                foreach ($tmpCerts as $oneCert) {
                    $cert             = new \FreeAsso\Model\MemberCertificate();
                    $cert->cert_id    = $oneCert->getCertId();
                    $cert->cert_ts    = $oneCert->getCertTs();
                    $cert->cert_mnt   = $oneCert->getCertInputMnt();
                    $cert->cert_money = $oneCert->getCertInputMoney();
                    $cert->cert_data  = $oneCert->getCertData1();
                    $cert->cau_id     = $oneCert->getCauId();
                    $cert->cau_name   = $oneCert->getCause()->getCauName();
                    $cert->file_id    = $oneCert->getFileId();
                    $certificates[]   = $cert;
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createResponse(200, serialize($certificates));
    }

    /**
     * Member download certificate
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadCertificate(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email, $p_cert_id)
    {
        $certificate = null;
        $code = FFCST::ERROR_NOT_FOUND;
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $query = \FreeAsso\Model\Certificate::getQuery();
            $query
                ->addFromFilters(
                    [
                        'cli_id'  => $member->mbr_id,
                        'cert_id' => $p_cert_id
                    ]
                )
            ;
            if ($query->execute()) {
                $certificates = $query->getResult();
                if ($certificates->count() == 1) {
                    $certificate = $certificates[0];
                    if ($certificate) {
                        /**
                         * @var \FreeFW\Model\File $file
                         */
                        $file = \FreeFW\Model\File::findFirst(['file_id' => $certificate->getFileId()]);
                        if ($file) {
                            $this->logger->info('FreeAsso.ReceiptController.printOne.end');
                            return $this->createMimeTypeResponse($certificate->getCertId() . '.pdf', $file->getFileBlob());
                        } else {
                            $data = null;
                            $code = FFCST::ERROR_NOT_FOUND;
                        }
                    } else {
                        $data = null;
                        $code = FFCST::ERROR_NOT_FOUND;
                    }
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createErrorResponse($code);
    }

    /**
     * Cause edition
     *
     * @param \Psr\Http\Message\ServerRequestInterface $p_request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function downloadCauseEdition(\Psr\Http\Message\ServerRequestInterface $p_request, $p_email, $p_cau_id)
    {
        $code = FFCST::ERROR_NOT_FOUND;
        /**
         * @var \FreeFW\Http\ApiParams $apiParams
         */
        $apiParams = $p_request->getAttribute('api_params', false);
        try {
            $member = $this->verifyMember($p_email);
            $cause  = \FreeAsso\Model\Cause::findFirst(['cau_id' => $p_cau_id]);
            if ($cause) {
                $client = \FreeAsso\Model\Client::findFirst(['cli_email' => $p_email]);
                if ($client) {
                    $editionService = \FreeFW\DI\DI::get('FreeFW::Service::Edition');
                    if ($editionService) {
                        $edit = $editionService->printEdition(4, $client->getLangId(), $cause);
                        if ($edit) {
                            return $this->createMimeTypeResponse($cause->getCauName() . '.pdf', file_get_contents($edit['filename']));
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            switch ($ex->getCode()) {
                case self::ERROR_DUPLICATE_EMAIL:
                    return $this->createResponse(412);
                    break;
                case self::ERROR_EMAIL_NOT_FOUND:
                    return $this->createResponse(404);
                default:
                    return $this->createResponse(412);
            }
        }
        return $this->createErrorResponse($code);
    }
}
