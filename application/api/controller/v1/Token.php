<?php

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validata\TokenGet;

class Token {
    public function getToken($code = '') {
        (new TokenGet())->goCheck();
        $ut     = new UserToken($code);
        $result = $ut->get();
    }
}