<?php

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validata\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;

class Order extends BaseController {
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder() {
        (new OrderPlace())->goCheck();
        //必需加‘/a’才可以获得数组
        $oProducts = input('post.products/a');
        $uid       = TokenService::getCurrentUid();
        $order     = new OrderService();
        $status    = $order->place($oProducts, $uid);
        return $status;
    }
}