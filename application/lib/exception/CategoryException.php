<?php

namespace app\lib\exception;


class CategoryException extends BaseException {
    public $code = 404;
    public $msg = '类目不存在';
    public $errorCode = 50000;
}