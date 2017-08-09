<?php

namespace app\api\validata;


use app\lib\exception\ParameterException;
use think\Validate;

class OrderPlace extends BaseValidata {
    protected $rule = [
        'products' => 'checkProducts'
    ];
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count'      => 'require|isPositiveInteger'
    ];

    protected function checkProducts($values) {
        if (!is_array($values)) {
            throw new ParameterException([
                'msg' => '商品参数错误'
            ]);
        }
        if (empty($values)) {
            throw new ParameterException([
                'msg' => '商品参数不能为空'
            ]);
        }
        foreach ($values as $value) {
            $this->checkProduct($value);
        }
        return true;
    }

    protected function checkProduct($value) {
        $validate = new BaseValidata($this->singleRule);
        $result   = $validate->check($value);
        if (!$result) {
            throw new ParameterException([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}