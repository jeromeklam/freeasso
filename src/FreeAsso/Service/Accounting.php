<?php

namespace FreeAsso\Service;

/**
 *
 * @author jeromeklam
 *
 */
class Accounting extends \FreeFW\Core\Service
{

    /**
     * Generate lines
     *
     * @return void
     */
    public function generateLines($p_params = [])
    {
        $accoutings = \FreeAsso\Model\AccountingHeader::find(
            [
                'acch_status' => \FreeAsso\Model\AccountingHeader::STATUS_WAITING
            ]
        );
        /**
         * @var \FreeAsso\Model\AccountingHeader $oneAccounting
         */
        foreach ($accoutings as $oneAccounting) {
            $content = $oneAccounting->getAcchContent();
            $lines   = explode("\n", $content);
            foreach ($lines as $oneLine) {
                $cells = explode(';', $oneLine);
                $oneLine = new \FreeAsso\Model\AccountingLine();
                $oneLine
                    ->setAcchId($oneAccounting->getAcchId())
                    ->setAcclAmount(str_replace(',', '.', $cells[5]))
                    ->setAcclLabel($cells[4])
                    ->setAcclPtypName($cells[1])
                    ->setAcclTs(\FreeFW\Tools\Date::ddmmyyyyToMysql($cells[0]))
                ;
                $oneLine->create();
            }
            $oneAccounting
                ->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_IMPORTED)
                ->save()
            ;
        }
        return $p_params;
    }

    /**
     * Generate lines
     *
     * @return void
     */
    public function verifyLines($p_params = [])
    {
        $accoutings = \FreeAsso\Model\AccountingHeader::find(
            [
                'acch_status' => \FreeAsso\Model\AccountingHeader::STATUS_IMPORTED,
                'acch_year'   => $p_params['year'],
                'acch_month'  => $p_params['month'],
            ]
        );
        $testing = [];
        /**
         * @var \FreeAsso\Model\AccountingHeader $oneAccounting
         */
        foreach ($accoutings as $oneAccounting) {
            $lines     = \FreeAsso\Model\AccountingLine::find(['acch_id' => $oneAccounting->getAcchId()]);
            foreach ($lines as $oneLine) {
                $temp = $oneLine->__toArray();
                $temp['accl_label'] = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($temp['accl_label']));
                $testing[] = $temp;
            }
        }
        if (count($testing) > 0) {
            $from = new \DateTime();
            $from->setDate($p_params['year'], $p_params['month'], 1);
            $from->setTime(0, 0, 1);
            $to = clone($from);
            $to->add(new \DateInterval('P1M'));
            $query = \FreeAsso\Model\Donation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'don_real_ts'   => [ \FreeFW\Storage\Storage::COND_BETWEEN => [
                            \FreeFW\Tools\Date::datetimeToMysql($from),
                            \FreeFW\Tools\Date::datetimeToMysql($to)
                        ]],
                        'don_mnt_input' => [ \FreeFW\Storage\Storage::COND_GREATER => 0 ],
                        'don_status'    => [ \FreeFW\Storage\Storage::COND_NOT_EQUAL => 'NOK' ],
                    ]
                )
                ->addRelations(['client','payment_type'])
            ;
            if ($query->execute()) {
                $donations = $query->getResult();
                /**
                 * @var \FreeAsso\Model\Donation $oneDonation
                 */
                foreach ($donations as $oneDonation) {
                    /**
                     * @var \FreeAsso\Model\Client $client
                     */
                    $client    = $oneDonation->getClient();
                    $ptyp      = $oneDonation->getPaymentType();
                    $firstname = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($client->getCliFirstname()));
                    $lastname  = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($client->getCliLastname()));
                    foreach ($testing as $idx => $oneTest) {
                        $comment  = null;
                        $full1    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $oneTest['accl_label']));
                        $full2    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliLastname() . $client->getCliFirstname()));
                        $full3    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliFirstname() . $client->getCliLastname()));
                        $full4    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliAccounting()));
                        $words    = explode(' ', $oneTest['accl_label']);
                        $matching = 0;
                        if ($full1 == $full2 || $full1 == $full3 || $full1 == $full4) {
                            $matching = 100;
                        } else {
                            if (\FreeFW\Tools\PBXString::soundLike($full1, $full2) || 
                                ($full4 != '' && strpos($full1, $full4) !== false)) {
                                $matching = 70;
                            } else {
                                foreach ($words as $oneWord) {
                                    if (strlen($oneWord) > 2) {
                                        if ($oneWord == $lastname) {
                                            $matching += 40;
                                        } else {
                                            if ($oneWord == $firstname) {
                                                $matching += 30;
                                            } else {
                                                if ($lastname != '' && preg_match("#\b" . $oneWord . "\b#", $lastname) > 0) {
                                                    $matching += 30;
                                                } else {
                                                    if ($firstname != '' && preg_match("#\b" . $oneWord . "\b#", $firstname) > 0) {
                                                        $matching += 20;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($matching <= 0 && (strpos($full1, $full2) !== false || strpos($full1, $full3) !== false)) {
                                    $matching += 70;
                                }
                            }
                        }
                        if ($matching > 0) {
                            if ($oneDonation->getDonMntInput() == $oneTest['accl_amount'] && $matching > 80) {
                                $matching += 10; // Pour le = montant
                                $comment = $oneTest['accl_label'];
                                if (strpos($ptyp->getPtypAccounting(), $oneTest['accl_ptyp_name']) === false) {
                                    $comment .= ' !! : ' . $oneTest['accl_ptyp_name'];
                                    $matching -= 10;
                                }
                                if ($matching > 100) {
                                    $matching = 100;
                                }
                                // Matched...
                                $oneDonation
                                    ->setAcclId($oneTest['accl_id'])
                                    ->setDonVerif(\FreeAsso\Model\Donation::VERIF_AUTO)
                                    ->setDonDesc($oneTest['accl_label'])
                                    ->setDonVerifComment($comment)
                                    ->setDonVerifMatch(intval($matching / 10))
                                ;
                                if (!$oneDonation->save(true, false)) {
                                    var_dump($oneDonation->getErrors());
                                    die;
                                }
                                unset($testing[$idx]);
                                break;
                            }
                        }
                    }
                }
            }
        }
        if (count($testing) > 0) {
            $from = new \DateTime();
            $from->setDate($p_params['year'], $p_params['month'], 1);
            $from->setTime(0, 0, 1);
            $to = clone($from);
            $to->add(new \DateInterval('P1M'));
            $query = \FreeAsso\Model\Donation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'don_real_ts'   => [ \FreeFW\Storage\Storage::COND_BETWEEN => [
                            \FreeFW\Tools\Date::datetimeToMysql($from),
                            \FreeFW\Tools\Date::datetimeToMysql($to)
                        ]],
                        'don_mnt_input' => [ \FreeFW\Storage\Storage::COND_GREATER => 0 ],
                        'accl_id'       => \FreeFW\Storage\Storage::COND_EMPTY,
                        'don_status'    => [ \FreeFW\Storage\Storage::COND_NOT_EQUAL => 'NOK' ],
                    ]
                )
                ->addRelations(['client','payment_type'])
            ;
            if ($query->execute()) {
                $donations = $query->getResult();
                /**
                 * @var \FreeAsso\Model\Donation $oneDonation
                 */
                foreach ($donations as $oneDonation) {
                    /**
                     * @var \FreeAsso\Model\Client $client
                     */
                    $client    = $oneDonation->getClient();
                    $ptyp      = $oneDonation->getPaymentType();
                    $firstname = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($client->getCliFirstname()));
                    $lastname  = strtoupper(\FreeFW\Tools\PBXString::withoutAccent($client->getCliLastname()));
                    foreach ($testing as $idx => $oneTest) {
                        $comment  = null;
                        $full1    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $oneTest['accl_label']));
                        $full2    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliLastname() . $client->getCliFirstname()));
                        $full3    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliFirstname() . $client->getCliLastname()));
                        $full4    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliAccounting()));
                        $words    = explode(' ', $oneTest['accl_label']);
                        $matching = 0;
                        if ($full1 == $full2 || $full1 == $full3 || $full1 == $full4) {
                            $matching = 100;
                        } else {
                            if (\FreeFW\Tools\PBXString::soundLike($full1, $full2) || 
                                ($full4 != '' && strpos($full1, $full4) !== false)) {
                                $matching = 70;
                            } else {
                                foreach ($words as $oneWord) {
                                    if (strlen($oneWord) > 2) {
                                        if ($oneWord == $lastname) {
                                            $matching += 40;
                                        } else {
                                            if ($oneWord == $firstname) {
                                                $matching += 30;
                                            } else {
                                                if ($lastname != '' && preg_match("#\b" . $oneWord . "\b#", $lastname) > 0) {
                                                    $matching += 30;
                                                } else {
                                                    if ($firstname != '' && preg_match("#\b" . $oneWord . "\b#", $firstname) > 0) {
                                                        $matching += 20;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($matching <= 0 && (strpos($full1, $full2) !== false || strpos($full1, $full3) !== false)) {
                                    $matching += 70;
                                }
                            }
                        }
                        if ($matching > 0) {
                            $comment = $oneTest['accl_label'];
                            if ($oneDonation->getDonMntInput() == $oneTest['accl_amount']) {
                                $matching += 10; // Pour le = montant
                            } else {
                                $comment .= ' !! : ' . $oneTest['accl_amount'];
                            }
                            if (strpos($ptyp->getPtypAccounting(), $oneTest['accl_ptyp_name']) === false) {
                                $comment .= ' !! : ' . $oneTest['accl_ptyp_name'];
                                $matching -= 10;
                            }
                            if ($matching >= 40) {
                                
                                // Matched...
                                $oneDonation
                                    ->setAcclId($oneTest['accl_id'])
                                    ->setDonVerif(\FreeAsso\Model\Donation::VERIF_AUTO)
                                    ->setDonDesc($oneTest['accl_label'])
                                    ->setDonVerifComment($comment)
                                    ->setDonVerifMatch(intval($matching / 10))
                                ;
                                if (!$oneDonation->save(true, false)) {
                                    var_dump($oneDonation->getErrors());
                                    die;
                                }
                                unset($testing[$idx]);
                                break;
                            }
                        }
                    }
                }
            }
        }
        foreach ($accoutings as $oneAccounting) {
            $oneAccounting
                ->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_DONE)
                ->save()
            ;
        }
    }
}
