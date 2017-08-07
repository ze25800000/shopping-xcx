<?php

namespace app\api\validata;


class Count extends BaseValidata {
    public $rule = [
        'count' => 'isPositiveInteger|between:1,16'
    ];
}