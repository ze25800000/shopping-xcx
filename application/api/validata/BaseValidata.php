<?php

namespace app\api\validata;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidata extends Validate {
    public function goCheck() {
        $params = Request::instance()->param();
        $result = $this->batch()->check($params);
        if (!$result) {
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '') {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    protected function isNotEmpty($value) {
        if (empty($value)) {
            return false;
        } else {
            return true;
        }
    }
}