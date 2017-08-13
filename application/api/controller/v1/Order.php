<?php

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validata\IDMustBePostiveInt;
use app\api\validata\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\validata\PagingParameter;
use app\lib\exception\OrderException;

class Order extends BaseController {
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope'   => ['only' => 'getDetail,getSummaryByUser']
    ];

    public function getSummaryByUser($page = 1, $size = 15) {
        (new PagingParameter())->goCheck();
        $uid           = TokenService::getCurrentUid();
        $pageingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
        if ($pageingOrders->isEmpty()) {
            return [
                'data'         => [],
                'current_page' => $pageingOrders->getCurrentPage()
            ];
        }
        $data = $pageingOrders->hidden(['snap_items', 'snap_address', 'prepay_id'])->toArray();
        return [
            'data'         => $data,
            'current_page' => $pageingOrders->getCurrentPage()
        ];
    }

    public function placeOrder() {
        (new OrderPlace())->goCheck();
        //必需加‘/a’才可以获得数组
        $oProducts = input('post.products/a');
        $uid       = TokenService::getCurrentUid();
        $order     = new OrderService();
        $status    = $order->place($oProducts, $uid);
        return $status;
    }

    public function getDetail($id) {
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if (!$orderDetail) {
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }
}