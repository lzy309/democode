<?php


class CaptchaUtils
{
    public static function checkCaptcha($result)
    {
        // 没有匹配到验证码或者验证码多余1行 不符合规定
        if ($result['words_result_num'] != 1) {
            return false;
        }

        $words = preg_replace('/ /', '', $result['words_result'][0]['words']);
        if (strlen($words) != 4) {
            return false;
        }
        return $words;
    }
}