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

    protected function isMobile($value) {
        $rule   = "/^1(3|4|5|7|8)[0-9]\d{8}$/";
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getDataByRule($array) {
        if (array_key_exists('uid', $array) | array_key_exists('user_id', $array)) {
            throw new ParameterException([
                'msg' => '参数中包含非法参数uid或者user_id'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $array[$key];
        }
        return $newArray;
    }
}