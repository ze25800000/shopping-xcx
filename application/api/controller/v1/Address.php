<?php

namespace app\api\controller\v1;


use app\api\validata\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\exception\successMessage;
use app\lib\exception\UserException;

class Address {
    public function createOrUpdateAddress() {
        $validata = new AddressNew();
        $validata->goCheck();
        $uid  = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserException();
        }
        $dataArray   = $validata->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->save($dataArray);
        } else {
            $user->address->save($dataArray);
        }
        return json(new successMessage(), 201);
    }
}