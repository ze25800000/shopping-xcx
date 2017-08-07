<?php

namespace app\api\controller\v1;


use app\api\validata\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

class Product {
    public function getRecentProduct($count = 15) {
        (new Count())->goCheck();
        $result = ProductModel::getRecentProduct($count);
        $result = $result->hidden(['summary']);
        if ($result->isEmpty()) {
            throw new ProductException();
        }
        return $result;
    }
}