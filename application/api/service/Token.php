<?php

namespace app\api\service;


use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token {
    public static function generateToken() {
        //32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        //时间戳
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //盐 salt
        $salt = config('secure.token_salt');
        //用三组字符串，进行md5加密
        return md5($randChars . $timestamp . $salt);
    }

    public static function getCurrentTokenVar($key) {
        $token      = Request::instance()
            ->header('token');
        $tokenValue = Cache::get($token);
        if (!$tokenValue) {
            throw new TokenException();
        } else {
            if (!is_array($tokenValue)) {
                $tokenValue = json_decode($tokenValue, true);
            }
            if (array_key_exists($key, $tokenValue)) {
                return $tokenValue[$key];
            } else {
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }

    public static function getCurrentUid() {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
}