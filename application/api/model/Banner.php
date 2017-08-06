<?php

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends Model {
    public static function getBannerByID($id) {
//        $result = Db::table('banner_item')
//            ->where(function ($query) use ($id) {
//                $query->where('banner_id', '=', $id);
//            })
//            ->select();
//        return json($result);
    }
}