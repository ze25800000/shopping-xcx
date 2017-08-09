<?php

namespace app\api\service;


use app\api\model\Product;

class Order {
    protected $oProducts;
    protected $product;
    protected $uid;

    public function place($oProducts, $uid) {
        $this->oProducts = $oProducts;
        $this->product   = $this->getProductByOrder($oProducts);
        $this->uid       = $uid;
    }

    protected function getProductByOrder($oProducts) {
        $oPIDs = [];
        foreach ($oProducts as $oProduct) {
            array_push($oPIDs, $oProduct['product_id']);
        }
        $result = Product::all($oPIDs)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();
        return $result;
    }
}