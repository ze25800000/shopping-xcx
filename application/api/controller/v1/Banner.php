<?php

namespace app\api\controller\v1;


use app\api\validata\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner {
    public function getBanner($id) {
        (new IDMustBePostiveInt())->goCheck();
        $result = BannerModel::get($id);
//        $result = BannerModel::getBannerByID($id);
        if (!$result) {
            throw new BannerMissException();
        }
        return $result;
    }
}