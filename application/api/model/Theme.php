<?php

namespace app\api\model;


class Theme extends BaseModel {
    public $message = ['topic_img_id', 'delete_time', 'head_img_id'];

    public function topicImg() {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg() {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }
}