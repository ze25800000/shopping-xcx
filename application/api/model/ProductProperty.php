<?php

namespace app\api\model;


class ProductProperty extends BaseModel {
    public $hidden = ['update_time', 'delete_time', 'product_id'];

}