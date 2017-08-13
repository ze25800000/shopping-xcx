<?php

namespace app\api\validata;


class TokenGet extends BaseValidata {
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];
    protected $message = [
        'code' => '必须要有code'
    ];
}