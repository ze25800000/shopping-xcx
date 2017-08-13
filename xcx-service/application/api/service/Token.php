<?php

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
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

    //用户或管理员都可以访问的权限
    public static function needPrimaryScope() {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    //只有用户才能访问的接口权限
    public static function needExclusiveScope() {
        $scope = self::getCurrentTokenVar('scope');
        if ($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    public static function isValidOperate($checkUID) {
        if (!$checkUID) {
            throw new Exception('检测UID时必须传入被检测的UID');
        }
        $currentOperateUID = self::getCurrentUid();
        if ($currentOperateUID == $checkUID) {
            return true;
        }
        return false;
    }
}