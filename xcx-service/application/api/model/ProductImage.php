<?php

namespace app\api\model;


class ProductImage extends BaseModel {
    public $hidden = ['img_id','delete_time','product_id'];
    public function imgUrl() {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}