<?php

namespace app\api\controller\v1;


use app\api\validata\IDMustBePostiveInt;

class Banner {
    public function getBanner($id) {
        (new IDMustBePostiveInt())->goCheck();
    }
}