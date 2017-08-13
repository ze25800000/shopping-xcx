<?php

namespace app\api\model;


class Product extends BaseModel {
    public $hidden = ['topic_img_id', 'delete_time', 'head_img_id', 'update_time', 'create_time', 'pivot', 'from', 'category_id', 'img_id'];

    public function getMainImgUrlAttr($value, $data) {
        return $this->prefixImgUrl($value, $data);
    }

    public static function getRecentProduct($count) {
        return self::limit($count)
            ->order('create_time desc')
            ->select();
    }

    public static function getProductByCategoryID($id) {
        return self::where('category_id', '=', $id)
            ->select();
    }

    public function imgs() {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function properties() {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public static function getProductDetail($id) {
//        return self::with(['imgs.imgUrl', 'properties'])
//            ->find($id);
        $product = self::with([
            'imgs' => function ($query) {
                $query->with(['imgUrl'])
                    ->order('order', 'asc');
            }
        ])
            ->with(['properties'])
            ->find($id);
        return $product;
    }
}