<?php

namespace app\lib\exception;


use Exception;
use think\exception\Handle;
use think\Request;

class ExceptionHandler extends Handle {
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e) {
        if ($e instanceof BaseException) {
            $this->code      = $e->code;
            $this->msg       = $e->msg;
            $this->errorCode = $e->errorCode;
        } else {
            $this->code      = 500;
            $this->msg       = "服务器内部错误";
            $this->errorCode = 999;
        }
        $request = Request::instance();
        $url     = $request->url();
        $result  = [
            'error_code'  => $this->errorCode,
            'msg'         => $this->msg,
            'request_url' => $url,
        ];
        return json($result, $this->code);
    }
}