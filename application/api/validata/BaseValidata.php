<?php

namespace app\api\validata;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidata extends Validate {
    public function goCheck() {
        $params = Request::instance()->param();
        $result = $this->check($params);
        if (!$result) {
            $error = $this->error;
            throw new Exception($error);
        } else {
            return true;
        }
    }
}