<?php

namespace app\api\model;


class Banner extends BaseModel {
    public $hidden = ['delete_time', 'update_time', 'id'];

    public function items() {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id) {
        return self::with(['items', 'items.img'])->find($id);
    }

}