<?php
namespace FreeAPI\INSEE\Sirene;

/**
 * class Siren
 */
class Siret extends \FreeAPI\INSEE\Api
{

    /**
     * Find by SIRET
     * 
     * @param string $p_siret
     */
    public function findBySIRET($p_siret)
    {
        $p_siret = str_replace(' ', '', $p_siret);
        $p_siret = str_replace('-', '', $p_siret);
        $p_siret = substr($p_siret, 0, 9);
        $result = $this->getOneSiret($p_siret);
        if ($result) {
            $result_set = new \FreeAPI\INSEE\ResultSet();
            if (isset($result['header']) && $result['header']['message'] == 'OK') {
                if (isset($result['header'])) {
                    if (isset($result['header']['total'])) {
                        $result_set->setTotalCount($result['header']['total']);
                    }
                }
                if (isset($result['etablissement'])) {
                    $etab         = $result['etablissement'];
                    $result_set[] = new \FreeAPI\INSEE\Sirene\Etablissement($etab);
                    $result_set->setTotalCount(1);
                }
            }
            return $result_set;
        }
        return false;
    }

    /**
     * Find by crits
     * 
     * @param array $p_crits
     */
    public function find($p_crits = [], $p_start = 0, $p_len = 20)
    {
        if (is_array($p_crits)) {
            $result_set = new \FreeAPI\INSEE\ResultSet();
            $params = [
                'nombre' => $p_len,
                'debut'  => $p_start
            ];
            $q = [];
            if (count($p_crits) > 0) {
                foreach ($p_crits as $key => $value) {
                    $val = $this->encodeParam($value);
                    switch (strtolower($key)) {
                        case 'siren':
                            if (strlen($val) < 9 && strpos($val, '*') === false) {
                                $val = '*' . $val . '*';
                            }
                            $q[] = 'siren:' . $val;
                            break;
                        case 'siret':
                            if (strlen($value) <= 9) {
                                $value = '*' . $value . '*';
                            }
                            $q[] = 'siret:' . $val;
                            break;
                        case 'nom':
                            $q[] = 'denominationUniteLegale:' . $val;
                            break;
                        case 'cp':
                            $q[] = 'codePostalEtablissement:' . $val;
                            break;
                        case 'ville':
                            $q[] = 'libelleCommuneEtablissement:' . $val;
                            break;
                        case 'sigle':
                            $q[] = 'sigleUniteLegale:' . $val;
                            break;
                    }
                }
            }
            if (count($q) > 0) {
                $params['q'] = '';
                foreach ($q as $val) {
                    if ($params['q'] != '') {
                        $params['q'] .= '%20AND%20';
                    }
                    $params['q'] .= '(' . $val . ')';
                }
            }
            $result = $this->getSiret($params);
            if ($result) {
                $result_set = new \FreeAPI\INSEE\ResultSet();
                if (isset($result['header']) && $result['header']['message'] == 'OK') {
                    $result_set->setTotalCount(1);
                    if (isset($result['header'])) {
                        if (isset($result['header']['total'])) {
                            $result_set->setTotalCount($result['header']['total']);
                        }
                    }
                    if (isset($result['etablissements'])) {
                        foreach ($result['etablissements'] as $etab) {
                            $result_set[] = new \FreeAPI\INSEE\Sirene\Etablissement($etab);
                        }
                    }
                }
                return $result_set;
            }
        }
        return false;
    }

    /**
     * find by SIRET
     * 
     * @param string $p_siret
     * 
     * @return array|bool
     */
    protected function getOneSiret(string $p_siret)
    {
        $token = $this->getToken();
        if ($token->isValid()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url_api . '/siret/' . urlencode($p_siret));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = [
                'Accept: application/json',
                'Authorization: ' . $token->getAuthorizationHeader()
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return false;
            }
            curl_close($ch);
            return json_decode($result, true);
        } else {
            return false;
        }
    }

    /**
     * find
     * 
     * @param array $p_params
     * 
     * @return array|bool
     */
    protected function getSiret(array $p_params)
    {
        $token = $this->getToken();
        if ($token->isValid()) {
            $ch = curl_init();
            $q = '';
            foreach ($p_params as $key => $val) {
                if ($q != '') {
                    $q .= '&';
                }
                $q .= $key . "=" . $val;
            }
            curl_setopt($ch, CURLOPT_URL, $this->url_api . '/siret?' . $q);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $headers = [
                'Accept: application/json',
                'Authorization: ' . $token->getAuthorizationHeader()
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return false;
            }
            curl_close($ch);
            return json_decode($result, true);
        } else {
            return false;
        }
    }
}
