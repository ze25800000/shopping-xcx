<?php

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;

class Pay {
    private $orderID;
    private $orderNO;

    function __construct($orderID) {
        if (!$orderID) {
            throw new Exception('订单号不允许为null');
        }
        $this->orderID = $orderID;
    }

    public function pay() {
        $orderService = new OrderService();
        $status       = $orderService->checkOrderStock($this->orderID);
        if (!$status['pass']) {
            return $status;
        }
    }


    private function checkOrderValid() {
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if (!$order) {
            throw new OrderException();
        }
        if (!Token::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg'       => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        if ($order->status != OrderStatusEnum::UNPAID) {
            throw new OrderException([
                'msg'       => '订单已经支付',
                'errorCode' => 80003,
                'code'      => 400
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }
}