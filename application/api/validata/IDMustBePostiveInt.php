<?php

namespace app\api\validata;


class IDMustBePostiveInt extends BaseValidata {
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '') {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return $field."必须为正整数";
        }
    }
}