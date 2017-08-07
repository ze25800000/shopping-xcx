<?php

namespace app\api\model;


class Image extends BaseModel {
    public $hidden = ['delete_time', 'update_time', 'id'];
}