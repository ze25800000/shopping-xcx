<?php

namespace app\lib\exception;


class WeChatException extends BaseException {
    public $code = 400;
    public $msg = '微信请求失败';
    public $errorCode = '40000';
}