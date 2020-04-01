<?php

// 引入SDK
require_once '../lib/aip-php-sdk/AipOcr.php';
require_once '../utils/CaptchaUtils.php';
require_once '../utils/CommonUtils.php';

// 加载配置文件
$config = require('../config/app.php');

// 请求首页
$indexResult = CommonUtils::curl_get($config['chengmi_url']);
preg_match("/id=\"login_token\" value=\"(.*?)\"/i", $indexResult, $result);
$loginToken = $result[1];

// 获取图片验证码
$client = new AipOcr($config['ocr_app_id'], $config['ocr_app_key'], $config['ocr_secret_key']);
$options = array();
$options["language_type"] = "ENG";
$captchaResult = $client->basicAccurate(CommonUtils::curl_get2($config['captcha_url']), $options);
$code = CaptchaUtils::checkCaptcha($captchaResult);

// 模拟登陆
$postData = [
    'username' => '619346077@qq.com',
    'code' => $code,
    'userpwd' => md5('lzy12345!!'),
    'b_type' => 1,
    'token' => $loginToken,
];

$loginResult = CommonUtils::curl_post($config['login_url'], $postData);


// 获取账户余额
$userPanel = CommonUtils::curl_get2($config['user_url']);
preg_match("/<td height=\"36\" align=\"center\" class=\"hsac\" style=\"font-size: 18px;\">\s+¥{1}(.*?)\s+<\/td>/s", $userPanel, $result);
//账户余额
echo "账户余额为: {$result[1]}元\r\n";
