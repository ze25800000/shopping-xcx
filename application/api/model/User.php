<?php

namespace app\api\model;


class User extends BaseModel {
    public static function getUserByOpenID($openid) {
        return self::where('openid', '=', $openid)
            ->find();
    }
}