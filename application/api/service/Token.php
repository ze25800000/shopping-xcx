<?php

namespace app\api\service;


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
}