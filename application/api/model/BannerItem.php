<?php

namespace app\api\model;


class BannerItem extends BaseModel {
    public $hidden = ['delete_time', 'banner_id', 'update_time', 'img_id', 'id'];

    public function img() {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}