<?php

namespace app\api\controller\v1;


use app\api\validata\AddressNew;
use app\api\service\Token as TokenService;

class Address {
    public function createOrUpdateAddress() {
        (new AddressNew())->goCheck();
        $uid = TokenService::getCurrentUid();
    }
}