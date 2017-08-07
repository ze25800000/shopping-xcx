<?php

namespace app\api\controller\v1;


use app\api\validata\IDCollection;
use app\api\model\Theme as ThemeModel;

class Theme {
    /**
     * @url /theme?ids=1,2,3,4
     * @return 一组theme模型
     */
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
}