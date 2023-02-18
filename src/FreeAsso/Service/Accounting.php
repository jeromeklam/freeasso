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
     * Headers
     *
     * @var [\FreeAsso\Model\AccountingHeader]
     */
    protected static $headers = [];

    /**
     * Load All headers
     *
     * @return void
     */
    public function loadHeaders()
    {
        self::$headers = [];
        $results = \FreeAsso\Model\AccountingHeader::find();
        /**
         * @var \FreeAsso\Model\AccountingHeader $oneHeader
         */
        foreach ($results as $oneHeader) {
            $key = $oneHeader->getAcchYear() . '_' . $oneHeader->getAcchMonth() . '_' . $oneHeader->getAcchCode();
            self::$headers[$key] = $oneHeader;
        }
    }

    /**
     * Get code
     *
     * @param string $p_code
     * 
     * @return string
     */
    public function getCode($p_code)
    {
        if (strpos($p_code, 'PAY') === 0) {
            return 'PAY';
        } else {
            if (strpos($p_code, 'BQ') === 0) {
                return 'BQ';
            } else {
                if (strpos($p_code, 'REMCHQ') === 0) {
                    return 'REMCHQ';
                } else {
                    if (strpos($p_code, 'ALV') === 0) {
                        return 'ALV';
                    } else {
                        if (strpos($p_code, 'STR') === 0) {
                            return 'STR';
                        } else {
                            if (strpos($p_code, 'MLFG') === 0) {
                                return 'MLFG';
                            }
                        }
                    }
                }
            }
        }
        return 'UNKNOWN';
    }

    /**
     * Import headers
     * 
     * 
     */
    public function handleWaiting($p_params = [])
    {
        $accoutings = \FreeAsso\Model\AccountingHeader::find(
            [
                'acch_year'   => $p_params['year'],
                'acch_month'  => $p_params['month'],
                'acch_status' => \FreeAsso\Model\AccountingHeader::STATUS_WAITING
            ]
        );
        /**
         * @var \FreeAsso\Model\AccountingHeader $oneAccounting
         */
        foreach ($accoutings as $oneAccounting) {
            \FreeAsso\Model\AccountingLine::delete(['acch_id' => $oneAccounting->getAcchId()]);
            switch (strtoupper($oneAccounting->getAcchFormat())) {
                case 'PAYPAL':
                    $content = $oneAccounting->getAcchContent();
                    $file = '/tmp/acc_' . uniqid() . '.csv';
                    file_put_contents($file, $content);
                    if (($handle = fopen($file, "r")) !== false) {
                        $first = true;
                        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                            if (!$first && trim($data[16]) == '' && $data[0] != '') {
                                $nbCols = count($data);
                                $wDate = \FreeFW\Tools\Date::ddmmyyyyToDateTime($data[0]);
                                $wMonth = intval($wDate->format('m'));
                                if ($wMonth == $oneAccounting->getAcchMonth()) {
                                    $label = strtoupper($data[3]);
                                    $mnt01 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[7]));
                                    $oneLine = new \FreeAsso\Model\AccountingLine();
                                    $oneLine
                                        ->setAcchId($oneAccounting->getAcchId())
                                        ->setAcclLabel($label)
                                        ->setAcclPtypName('PAY')
                                        ->setAcclTs(\FreeFW\Tools\Date::datetimeToMysql($wDate))
                                        ->setAcclAmount($mnt01)
                                        ->setAcclComplement($data[10]);
                                    if (!$oneLine->create()) {
                                        var_dump($oneLine->getErrors());
                                    }
                                }
                            }
                            $first = false;
                        }
                        fclose($handle);
                    }
                    @unlink($file);
                    break;
                case 'HELLOASSO':
                    $content = $oneAccounting->getAcchContent();
                    $file = '/tmp/acc_' . uniqid() . '.csv';
                    file_put_contents($file, $content);
                    if (($handle = fopen($file, "r")) !== false) {
                        $first = true;
                        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                            $nbCols = count($data);
                            if (!$first && $data[4] != '') {
                                $wDate = \FreeFW\Tools\Date::ddmmyyyyToDateTime($data[4]);
                                $wMonth = intval($wDate->format('m'));
                                if ($wMonth == $oneAccounting->getAcchMonth()) {
                                    $label = strtoupper($data[12] . ' ' . $data[13]);
                                    $mnt01 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[5]));
                                    $oneLine = new \FreeAsso\Model\AccountingLine();
                                    $oneLine
                                        ->setAcchId($oneAccounting->getAcchId())
                                        ->setAcclLabel($label)
                                        ->setAcclPtypName('HELLO')
                                        ->setAcclTs(\FreeFW\Tools\Date::datetimeToMysql($wDate))
                                        ->setAcclAmount($mnt01)
                                        ->setAcclComplement($data[19]);
                                    if (!$oneLine->create()) {
                                        var_dump($oneLine->getErrors());
                                    }
                                }
                            }
                            $first = false;
                        }
                    }
                    @unlink($file);
                    break;
                case 'STRIPE':
                    $content = $oneAccounting->getAcchContent();
                    $file = '/tmp/acc_' . uniqid() . '.csv';
                    file_put_contents($file, $content);
                    if (($handle = fopen($file, "r")) !== false) {
                        $first = true;
                        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                            $nbCols = count($data);
                            if (!$first && $data[1] != '') {
                                $wDate = \FreeFW\Tools\Date::ddmmyyyyToDateTime($data[1]);
                                $wMonth = intval($wDate->format('m'));
                                if ($wMonth == $oneAccounting->getAcchMonth()) {
                                    $label = strtoupper($data[9]);
                                    $mnt01 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[2]));
                                    $oneLine = new \FreeAsso\Model\AccountingLine();
                                    $oneLine
                                        ->setAcchId($oneAccounting->getAcchId())
                                        ->setAcclLabel($label)
                                        ->setAcclPtypName('STR')
                                        ->setAcclTs(\FreeFW\Tools\Date::datetimeToMysql($wDate))
                                        ->setAcclAmount($mnt01)
                                        ->setAcclComplement($data[10]);
                                    if (!$oneLine->create()) {
                                        var_dump($oneLine->getErrors());
                                    }
                                }
                            }
                            $first = false;
                        }
                    }
                    @unlink($file);
                    break;
                case 'LIVRE':
                    $content = $oneAccounting->getAcchContent();
                    $file = '/tmp/acc_' . uniqid() . '.csv';
                    file_put_contents($file, $content);
                    if (($handle = fopen($file, "r")) !== false) {
                        $first = true;
                        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                            $nbCols = count($data);
                            if ($data[4] != '') {
                                $wDate = \FreeFW\Tools\Date::ddmmyyyyToDateTime($data[1]);
                                $wMonth = intval($wDate->format('m'));
                                if ($wMonth == $oneAccounting->getAcchMonth()) {
                                    $label = strtoupper($data[4]);
                                    $list  = ['VIR', 'M', 'MME', 'M.', 'OU', 'ET', 'MR'];
                                    $cont  = true;
                                    while ($cont) {
                                        $cont = false;
                                        foreach ($list as $rem) {
                                            $pos = strpos($label, $rem . ' ');
                                            if ($pos === 0) {
                                                $label = trim(substr($label, strlen($rem)));
                                                $cont  = true;
                                            }
                                        }
                                    }
                                    $mnt01 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[5]));
                                    $mnt02 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[6]));
                                    $oneLine = new \FreeAsso\Model\AccountingLine();
                                    $oneLine
                                        ->setAcchId($oneAccounting->getAcchId())
                                        ->setAcclLabel($label)
                                        ->setAcclPtypName($this->getCode($data[2]))
                                        ->setAcclTs(\FreeFW\Tools\Date::datetimeToMysql($wDate))
                                        ->setAcclAmount($mnt01 > 0 ? 0 - $mnt01 : $mnt02);
                                    if (!$oneLine->create()) {
                                        var_dump($oneLine->getErrors());
                                    }
                                }
                            }
                        }
                    }
                    @unlink($file);
                    break;
            }
            $oneAccounting->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_IMPORTED);
            if (!$oneAccounting->save()) {
                var_dump($oneAccounting->getErrors());
            }
        }
        return $p_params;
    }

    /**
     * Import account file
     *
     * @param string $p_filename
     * 
     * @return void
     */
    public function importFile($p_filename)
    {
        $row = 1;
        if (($handle = fopen($p_filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $nbCols = count($data);
                if ($nbCols > 5 && $data[0] != '') {
                    $cptr  = $data[0];
                    $date  = $data[1];
                    $code  = $this->getCode($data[2]);
                    $label = $data[4];
                    $list  = ['VIR', 'M', 'MME', 'M.', 'OU', 'ET', 'MR'];
                    $cont  = true;
                    while ($cont) {
                        $cont = false;
                        foreach ($list as $rem) {
                            $pos = strpos($label, $rem . ' ');
                            if ($pos === 0) {
                                $label = trim(substr($label, strlen($rem)));
                                $cont  = true;
                            }
                        }
                    }
                    $mnt01 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[5]));
                    $mnt02 = preg_replace("/[^0-9.]/", "", str_replace(',', '.', $data[6]));
                    /**
                     * @var \DateTime $wDate
                     */
                    $wDate = \FreeFW\Tools\Date::ddmmyyyyToDateTime($date);
                    if ($wDate instanceof \DateTime) {
                        $key = $wDate->format('Y') . '_' . $wDate->format('m') . '_' . $code;
                        if (!isset(self::$headers[$key])) {
                            $oneHeader = new \FreeAsso\Model\AccountingHeader();
                            $oneHeader
                                ->setAcchYear($wDate->format('Y'))
                                ->setAcchMonth($wDate->format('m'))
                                ->setAcchCode($this->getCode($code))
                                ->setAcchName($this->getCode($code) . ' ' . $wDate->format('m/Y'))
                                ->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_IMPORTED)
                                ->setAcchStatusTs(\FreeFW\Tools\Date::getCurrentTimestamp())
                                ->initContent();
                            if (!$oneHeader->create()) {
                                var_dump($oneHeader->getErrors());
                                die;
                            }
                            self::$headers[$key] = $oneHeader;
                        }
                        self::$headers[$key]->addLineToContent(implode(',', $data));
                        $oneLine = new \FreeAsso\Model\AccountingLine();
                        $oneLine
                            ->setAcchId(self::$headers[$key]->getAcchId())
                            ->setAcclLabel($label)
                            ->setAcclPtypName($code)
                            ->setAcclTs(\FreeFW\Tools\Date::datetimeToMysql($wDate))
                            ->setAcclAmount($mnt01 > 0 ? $mnt01 : $mnt02);
                        if (!$oneLine->create()) {
                            var_dump($oneLine->getErrors());
                        }
                    } else {
                        echo "Erreur de date..." . PHP_EOL;
                    }
                }
            }
            fclose($handle);
            foreach (self::$headers as $oneHeader) {
                $oneHeader->save();
            }
        }
        return false;
    }

    /**
     * Cleaning
     *
     * @param array $p_params
     * @return void
     */
    public function cleanLines($p_params = [])
    {
        $accoutings = \FreeAsso\Model\AccountingHeader::find(
            [
                'acch_year'   => $p_params['year'],
                'acch_month'  => $p_params['month'],
            ]
        );
        foreach ($accoutings as $oneAccounting) {
            $lines = \FreeAsso\Model\AccountingLine::find(['acch_id' => $oneAccounting->getAcchId()]);
            foreach ($lines as $oneLine) {
                $oneLine
                    ->setDonId(null)
                    ->save(false, true);
            }
            $oneAccounting
                ->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_IMPORTED)
                ->save();
        }
        $query = \FreeAsso\Model\Donation::getQuery();
        $query
            ->addFromFilters(
                [
                    'session.sess_year'  => $p_params['year'],
                    'session.sess_month' => $p_params['month'],
                    'don_verif'          => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => 'NONE'],
                ]
            )
            ->addRelations(['client', 'payment_type', 'session']);
        if ($query->execute()) {
            $donations = $query->getResult();
            /**
             * @var \FreeAsso\Model\Donation $oneDonation
             */
            foreach ($donations as $oneDonation) {
                $oneDonation
                    ->setDonVerif(\FreeAsso\Model\Donation::VERIF_NONE)
                    ->setDonVerifMatch(0)
                    ->setDonVerifComment(null)
                    ->setAcclId(null)
                    ->save(false, true);
            }
        }
        $sessions = \FreeAsso\Model\Session::find(
            [
                'sess_year'   => $p_params['year'],
                'sess_month'  => $p_params['month'],
            ]
        );
        foreach ($sessions as $oneSession) {
            $oneSession
                ->setSessVerif(\FreeAsso\Model\Session::VERIF_NONE)
                ->setSessVerifText(null)
                ->save();
        }
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
            $query = \FreeAsso\Model\Donation::getQuery();
            $filters = [
                'session.sess_year'  => $p_params['year'],
                'don_mnt_input'      => [\FreeFW\Storage\Storage::COND_GREATER => 0],
                'don_status'         => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => 'NOK'],
                'session.sess_month' => $p_params['month']
            ];
            $query
                ->addFromFilters($filters)
                ->addRelations(['client', 'payment_type', 'session']);
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
                        $email1   = strtolower($oneTest['accl_complement']);
                        $email2   = strtolower($client->getCliEmail());
                        $full1    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $oneTest['accl_label']));
                        $full2    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $lastname . $firstname));
                        $full3    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $firstname . $lastname));
                        $full4    = strtoupper(str_replace([' ', '\'', '-', '.'], '', $client->getCliAccounting()));
                        $words    = explode(' ', $oneTest['accl_label']);
                        $matching = 0;
                        if ($full1 == $full2 || $full1 == $full3 || $full1 == $full4 || ($email1 != '' && $email1 == $email2)) {
                            $matching = 100;
                        } else {
                            if (
                                \FreeFW\Tools\PBXString::soundLike($full1, $full2) ||
                                ($full4 != '' && strpos($full1, $full4) !== false)
                            ) {
                                $matching = 70;
                            } else {
                                foreach ($words as $oneWord) {
                                    if (strlen($oneWord) > 2) {
                                        if ($oneWord == $lastname) {
                                            $matching += 40;
                                        } else {
                                            if ($oneWord == $firstname) {
                                                $matching += 20;
                                            } else {
                                                if ($lastname != '' && preg_match("#\b" . $oneWord . "\b#", $lastname) > 0) {
                                                    $matching += 30;
                                                } else {
                                                    if ($firstname != '' && preg_match("#\b" . $oneWord . "\b#", $firstname) > 0) {
                                                        $matching += 10;
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
                                $comment .= ' : ' . $oneTest['accl_ts'];
                                $comment .= ' (' . $oneTest['accl_ptyp_name'] . ')';
                                if (strpos($ptyp->getPtypAccounting(), $oneTest['accl_ptyp_name']) === false) {
                                    $comment .= ' : !=! ' . $oneTest['accl_ptyp_name'];
                                    $matching -= 10;
                                } else {
                                    $comment .= ' : ' . $oneTest['accl_ptyp_name'];
                                }
                                if ($matching > 100) {
                                    $matching = 100;
                                }
                                // Matched...
                                $oneDonation
                                    ->setAcclId($oneTest['accl_id'])
                                    ->setDonVerif(\FreeAsso\Model\Donation::VERIF_AUTO)
                                    ->setDonDesc('Contrôlé avec : ' . $oneTest['accl_label'])
                                    ->setDonVerifComment($comment)
                                    ->setDonVerifMatch(intval($matching / 10));
                                if (!$oneDonation->save(true, true)) {
                                    var_dump($oneDonation->getErrors());
                                    die;
                                }
                                $line = \FreeAsso\Model\AccountingLine::findFirst(
                                    ['accl_id' => $oneTest['accl_id']]
                                );
                                if ($line) {
                                    $line->setDonId($oneDonation->getDonId());
                                    $line->save();
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
            $to = clone ($from);
            $to->add(new \DateInterval('P1M'));
            $query = \FreeAsso\Model\Donation::getQuery();
            $query
                ->addFromFilters(
                    [
                        'don_real_ts'   => [\FreeFW\Storage\Storage::COND_BETWEEN => [
                            \FreeFW\Tools\Date::datetimeToMysql($from),
                            \FreeFW\Tools\Date::datetimeToMysql($to)
                        ]],
                        'don_mnt_input' => [\FreeFW\Storage\Storage::COND_GREATER => 0],
                        'accl_id'       => \FreeFW\Storage\Storage::COND_EMPTY,
                        'don_status'    => [\FreeFW\Storage\Storage::COND_NOT_EQUAL => 'NOK'],
                    ]
                )
                ->addRelations(['client', 'payment_type']);
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
                            if (
                                \FreeFW\Tools\PBXString::soundLike($full1, $full2) ||
                                ($full4 != '' && strpos($full1, $full4) !== false)
                            ) {
                                $matching = 70;
                            } else {
                                foreach ($words as $oneWord) {
                                    if (strlen($oneWord) > 2) {
                                        if ($oneWord == $lastname) {
                                            $matching += 40;
                                        } else {
                                            if ($oneWord == $firstname) {
                                                $matching += 20;
                                            } else {
                                                if ($lastname != '' && preg_match("#\b" . $oneWord . "\b#", $lastname) > 0) {
                                                    $matching += 30;
                                                } else {
                                                    if ($firstname != '' && preg_match("#\b" . $oneWord . "\b#", $firstname) > 0) {
                                                        $matching += 10;
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
                            $comment .= ' : ' . $oneTest['accl_ts'];
                            if ($oneDonation->getDonMntInput() == $oneTest['accl_amount']) {
                                $matching += 10; // Pour le = montant
                            } else {
                                $comment .= ' !! : ' . $oneTest['accl_amount'];
                            }
                            if (strpos($ptyp->getPtypAccounting(), $oneTest['accl_ptyp_name']) === false) {
                                $comment .= ' : !=! ' . $oneTest['accl_ptyp_name'];
                                $matching -= 10;
                            } else {
                                $comment .= ' : ' . $oneTest['accl_ptyp_name'];
                            }
                            if ($matching >= 40) {
                                // Matched...
                                $oneDonation
                                    ->setAcclId($oneTest['accl_id'])
                                    ->setDonVerif(\FreeAsso\Model\Donation::VERIF_AUTO)
                                    ->setDonDesc('Contrôlé avec : ' . $oneTest['accl_label'])
                                    ->setDonVerifComment($comment)
                                    ->setDonVerifMatch(intval($matching / 10));
                                if (!$oneDonation->save(true, true)) {
                                    var_dump($oneDonation->getErrors());
                                    die;
                                }
                                $line = \FreeAsso\Model\AccountingLine::findFirst(
                                    ['accl_id' => $oneTest['accl_id']]
                                );
                                if ($line) {
                                    $line->setDonId($oneDonation->getDonId());
                                    $line->save();
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
            $oneAccounting->setAcchStatus(\FreeAsso\Model\AccountingHeader::STATUS_DONE);
            if (!$oneAccounting->save()) {
                var_dump($oneAccounting->getErrors());
            }
        }
        $sessions = \FreeAsso\Model\Session::find(
            [
                'sess_year'   => $p_params['year'],
                'sess_month'  => $p_params['month'],
            ]
        );
        foreach ($testing as $oneTest) {
            $line = $oneTest['accl_ts'] . ', ' . $oneTest['accl_label'] . ', ' . $oneTest['accl_amount'] . ', ' . $oneTest['accl_ptyp_name'] . PHP_EOL;
            $this->logger->debug($line);
        }
        foreach ($sessions as $oneSession) {
            $oneSession
                ->setSessVerif(\FreeAsso\Model\Session::VERIF_DONE)
                ->save();
        }
        return true;
    }
}
