<?php

namespace app\api\service;


use app\lib\exception\WeChatException;
use think\Exception;

class UserToken {
    private $wxAppId;
    private $wxAppSecret;
    private $code;
    private $wxLoginUrl;

    public function __construct($code) {
        $this->wxAppId     = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->code        = $code;
        $this->wxLoginUrl  = sprintf(config('wx.login_url'), $this->wxAppId, $this->wxAppSecret, $this->code);
    }

    public function get() {
        $result   = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw new Exception('微信服务器异常，没有返回结果');
        } else {
            $final = array_key_exists('errcode', $wxResult);
            if ($final) {
                $this->processLoginError($wxResult);
            } else {
                $this->grantToken($wxResult);
            }
        }
    }

    private function processLoginError($wxResult) {
        throw  new WeChatException([
            'errorCode' => $wxResult['errcode'],
            'msg'       => $wxResult['errmsg']
        ]);
    }

    private function grantToken($wxResult) {
        $openid = $wxResult['openid'];
    }

}