<?php

namespace app\api\model;


class Category extends BaseModel {
    public $hidden = ['delete_time', 'description', 'update_time', 'topic_img_id'];
    public function img() {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}