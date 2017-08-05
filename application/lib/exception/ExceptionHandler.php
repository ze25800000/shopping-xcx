<?php

namespace app\lib\exception;


use Exception;
use think\Config;
use think\exception\Handle;
use think\Log;
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
//            Config::get('app_debug');
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->code      = 500;
                $this->msg       = "服务器内部错误";
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
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

    private function recordErrorLog(Exception $e) {
        Log::init([
            // 日志记录方式，内置 file socket 支持扩展
            'type'  => 'File',
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error']
        ]);
        Log::record($e->getMessage(), 'error');
    }
}