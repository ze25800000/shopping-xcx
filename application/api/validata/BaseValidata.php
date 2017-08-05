<?php

namespace app\api\validata;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidata extends Validate {
    public function goCheck() {
        $params = Request::instance()->param();
        $result = $this->check($params);
        if (!$result) {
            $e      = new ParameterException();
            $e->msg = $this->error;
            throw $e;
        } else {
            return true;
        }
    }
}