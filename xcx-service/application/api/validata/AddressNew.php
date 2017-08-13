<?php

namespace app\api\validata;


class AddressNew extends BaseValidata {
    public $rule = [
        'name'     => 'require|isNotEmpty',
        'mobile'   => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city'     => 'require|isNotEmpty',
        'country'  => 'require|isNotEmpty',
        'detail'   => 'require|isNotEmpty'
    ];
}