<?php

namespace app\api\validata;


class IDMustBePostiveInt extends BaseValidata {
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];
    protected $message = [
        'id' => 'id必须是正整数'
    ];

}