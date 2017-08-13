<?php

namespace app\lib\exception;


class successMessage extends BaseException {
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;
}