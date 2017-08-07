<?php

namespace app\api\model;


class Product extends BaseModel {
    public $hidden = ['topic_img_id', 'delete_time', 'head_img_id', 'update_time', 'create_time', 'pivot', 'from', 'category_id','img_id'];

    public function getMainImgUrlAttr($value, $data) {
        return $this->prefixImgUrl($value, $data);
    }
}