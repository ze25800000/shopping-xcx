<?php

namespace app\api\model;


class Theme extends BaseModel {
    public $hidden = ['topic_img_id', 'delete_time', 'head_img_id', 'update_time'];

    public function topicImg() {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg() {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public function product() {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }

    public static function getComplexOneByID($id) {
        return self::with(['headImg', 'topicImg', 'product'])
            ->select($id);
    }
}