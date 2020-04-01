<?php

require_once '../utils/CommonUtils.php';

class Domain
{
    private $nonce;
    private $secretId;
    private $signature;
    private $secretKey;

    public function __construct()
    {
        $this->nonce = uniqid();
        $this->secretId = 'AKIDU3OUMzYZY4LN9iBlERPBi0NWP4TgO194';
        $this->secretKey = 'tXx85nRqztY1FG2kFYdT5TdYQ4XkiSw9';
    }

    /**
     * 添加域名
     * @param $domain 域名名称
     * @return bool|string
     */
    public function addDomain($domain)
    {
        $params = array(
            'Action' => 'DomainCreate',
            'Region' => 'ap-guangzhou',
            'Timestamp' => time(),
            'Nonce' => $this->nonce,
            'SecretId' => $this->secretId,
            'SignatureMethod' => 'HmacSHA256',
            'domain' => $domain
        );
        ksort($params);

        $param = '';
        foreach ($params as $key => $value) {
            $param .= $key . '=' . $value . '&';
        }
        $srcStr = trim("GETcns.api.qcloud.com/v2/index.php?" . $param, "&");
        $this->signature = base64_encode(hash_hmac('sha256', $srcStr, $this->secretKey, true));

        $url = trim('https://cns.api.qcloud.com/v2/index.php?' . $param, "&");
        return CommonUtils::curl($url . '&Signature=' . $this->signature);
    }

    /**
     * 设置域名状态
     * @param $domain
     * @param $status
     * @return bool|string
     */
    public function setDomainStatus($domain, $status)
    {
        $params = array(
            'Action' => 'SetDomainStatus',
            'Region' => 'ap-guangzhou',
            'Timestamp' => time(),
            'Nonce' => $this->nonce,
            'SecretId' => $this->secretId,
            'SignatureMethod' => 'HmacSHA256',
            'domain' => $domain,
            'status' => $status ? 'enable' : 'disable'
        );
        ksort($params);

        $param = '';
        foreach ($params as $key => $value) {
            $param .= $key . '=' . $value . '&';
        }
        $srcStr = trim("GETcns.api.qcloud.com/v2/index.php?" . $param, "&");
        $this->signature = base64_encode(hash_hmac('sha256', $srcStr, $this->secretKey, true));

        $url = trim('https://cns.api.qcloud.com/v2/index.php?' . $param, "&");
        return CommonUtils::curl($url . '&Signature=' . $this->signature);
    }

    /**
     * 删除域名
     * @param $domain
     * @return bool|string
     */
    public function delDomain($domain)
    {
        $params = array(
            'Action' => 'DomainDelete',
            'Region' => 'ap-guangzhou',
            'Timestamp' => time(),
            'Nonce' => $this->nonce,
            'SecretId' => $this->secretId,
            'SignatureMethod' => 'HmacSHA256',
            'domain' => $domain,
        );
        ksort($params);

        $param = '';
        foreach ($params as $key => $value) {
            $param .= $key . '=' . $value . '&';
        }
        $srcStr = trim("GETcns.api.qcloud.com/v2/index.php?" . $param, "&");
        $this->signature = base64_encode(hash_hmac('sha256', $srcStr, $this->secretKey, true));

        $url = trim('https://cns.api.qcloud.com/v2/index.php?' . $param, "&");
        return CommonUtils::curl($url . '&Signature=' . $this->signature);
    }
}


$domain = new Domain();
$Result = $domain->getDomainList('lizhaoyang.com');

var_dump($Result);

