<?php

namespace app\api\model;


class UserAddress extends BaseModel {
    protected $hidden = ['update_time', 'delete_time', 'user_id'];
}