<?php

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token {
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
                return $this->grantToken($wxResult);
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
        $user   = UserModel::getUserByOpenID($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            $uid = $this->newUser($openid);
        }
        $cacheValue = $this->prepareCacheValue($wxResult, $uid);
        $token      = $this->saveToCache($cacheValue);
        return $token;
    }

    private function newUser($openid) {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    private function prepareCacheValue($wxResult, $uid) {
        $cacheValue          = $wxResult;
        $cacheValue['uid']   = $uid;
        $cacheValue['scope'] = ScopeEnum::User;
        return $cacheValue;
    }

    private function saveToCache($cacheValue) {
        $key       = self::generateToken();
        $value     = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');
        $result    = cache($key, $value, $expire_in);
        if (!$result) {
            throw new TokenException([
                'msg' => '服务器缓存异常'
            ]);
        }
        return $key;
    }
}