<?php

namespace app\api\validata;


class IDCollection extends BaseValidata {
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];
    protected $message = [
        'ids' => 'ids参数必须是以逗号分隔的多个正整数'
    ];

    protected function checkIDs($values) {
        $values = explode(',', $values);
        if (empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            }
        }
        return true;
    }
}