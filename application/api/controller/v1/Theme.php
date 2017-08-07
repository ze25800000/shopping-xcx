<?php

namespace app\api\controller\v1;


use app\api\validata\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validata\IDMustBePostiveInt;
use app\lib\exception\ThemeException;

class Theme {
    public function getSimpleList($ids = '') {
        (new IDCollection())->goCheck();
        $ids    = explode(',', $ids);
        $result = ThemeModel::with(['topicImg', 'headImg'])
            ->select($ids);
        if (!$result) {
            throw new ThemeException();
        }
        return $result;
    }

    public function getComplexOne($id) {
        (new IDMustBePostiveInt())->goCheck();
        $result = ThemeModel::getComplexOneByID($id);
        if (!$result) {
            throw new ThemeException();
        }
        return $result;
    }
}