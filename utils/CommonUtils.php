<?php


class CommonUtils
{
    public static function curl($url)
    {
        $curl = curl_init();
        $timeout = 5;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public static function curl_get($url)
    {
        $curl = curl_init();
        $timeout = 5;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_COOKIEJAR, 'tmp.cookie'); //获取COOKIE并存储
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public static function curl_get2($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_COOKIEFILE, 'tmp.cookie');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function curl_post($url, $data = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'tmp.cookie');
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}