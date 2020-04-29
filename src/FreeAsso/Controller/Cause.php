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
        $data = new \FreeFW\Model\ResultSet();
        /**
         * @var \FreeAsso\Model\Donation $donation
         */
        $donation = \FreeFW\DI\DI::get('FreeAsso::Model::Donation');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = $donation->getQuery();
        $query
            ->addFromFilters(
                [
                    'cau_id'      => $p_id,
                    'don_real_ts' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()],
                    'don_end_ts'  => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::getCurrentTimestamp()]
                ]
            )
            ->addRelations(['client'])
        ;
        if ($query->execute()) {
            $results = $query->getResult();
            foreach ($results as $donation) {
                /**
                 * @var \FreeAsso\Model\Sponsor $sponsor
                 */
                $sponsor = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                $sponsor
                    ->setSponId($donation->getCliId())
                    ->setSponName($donation->getClient()->getFullName())
                    ->setSponEmail($donation->getClient()->getCliEmail())
                    ->setSponSite($donation->getDonDisplaySite())
                    ->setSponNews(false)
                    ->setCliId($donation->getCliId())
                    ->setSponDonator(true)
                ;
                $data->add($sponsor);
                $sponsors = json_decode($donation->getDonSponsors(), true);
                if (is_array($sponsors)) {
                    $i = 0;
                    foreach ($sponsors as $oneSponsor) {
                        $i++;
                        $site = $donation->getDonDisplaySite();
                        if (array_key_exists('site', $oneSponsor)) {
                            $site = (bool)$oneSponsor['site'];
                        }
                        $news = true;
                        if (array_key_exists('news', $oneSponsor)) {
                            $news = (bool)$oneSponsor['news'];
                        }
                        /**
                         * @var \FreeAsso\Model\Sponsor $sponsor2
                         */
                        $sponsor2 = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                        $sponsor2
                            ->setSponId($donation->getCliId() . '_' . $i)
                            ->setSponName($oneSponsor['name'])
                            ->setSponEmail($oneSponsor['email'])
                            ->setSponSite($site)
                            ->setSponNews($news)
                            ->setCliId($donation->getCliId())
                            ->setSponDonator(false)
                        ;
                        $data->add($sponsor2);
                    }
                }
            }
        }
        /**
         * @var \FreeAsso\Model\Sponsorship $sponsorship
         */
        $sponsorship = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsorship');
        /**
         * @var \FreeFW\Model\Query $query
         */
        $query = $sponsorship->getQuery();
        $query
            ->addFromFilters(
                [
                    'cau_id'   => $p_id,
                    'spo_from' => [\FreeFW\Storage\Storage::COND_LOWER_EQUAL => \FreeFW\Tools\Date::getCurrentTimestamp()],
                    'spo_to'   => [\FreeFW\Storage\Storage::COND_GREATER_EQUAL_OR_NULL => \FreeFW\Tools\Date::getCurrentTimestamp()]
                ]
            )
            ->addRelations(['client'])
        ;
        if ($query->execute()) {
            $results = $query->getResult();
            foreach ($results as $sponsorship) {
                /**
                 * @var \FreeAsso\Model\Sponsor $sponsor
                 */
                $sponsor = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                $sponsor
                    ->setSponId($sponsorship->getCliId())
                    ->setSponName($sponsorship->getClient()->getFullName())
                    ->setSponEmail($sponsorship->getClient()->getCliEmail())
                    ->setSponSite($sponsorship->getSpoDisplaySite())
                    ->setSponNews($sponsorship->getSpoSendNews())
                    ->setCliId($sponsorship->getCliId())
                    ->setSponDonator(true)
                ;
                $data->add($sponsor);
                $sponsors = json_decode($sponsorship->getSpoSponsors(), true);
                if (is_array($sponsors)) {
                    $i = 0;
                    foreach ($sponsors as $oneSponsor) {
                        $i++;
                        $site = $sponsorship->getSpoDisplaySite();
                        if (array_key_exists('site', $oneSponsor)) {
                            $site = (bool)$oneSponsor['site'];
                        }
                        $news = $sponsorship->getSpoSendNews();
                        if (array_key_exists('news', $oneSponsor)) {
                            $news = (bool)$oneSponsor['news'];
                        }
                        /**
                         * @var \FreeAsso\Model\Sponsor $sponsor2
                         */
                        $sponsor2 = \FreeFW\DI\DI::get('FreeAsso::Model::Sponsor');
                        $sponsor2
                            ->setSponId($sponsorship->getCliId() . '_' . $i)
                            ->setSponName($oneSponsor['name'])
                            ->setSponEmail($oneSponsor['email'])
                            ->setSponSite($site)
                            ->setSponNews($news)
                            ->setCliId($sponsorship->getCliId())
                            ->setSponDonator(false)
                        ;
                        $data->add($sponsor2);
                    }
                }
            }
        }
        $this->logger->debug('FreeFW.ApiController.getAll.end');
        return $this->createResponse(200, $data);
    }
}
