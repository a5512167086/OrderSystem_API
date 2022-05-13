<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderFood;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class OrderService
{
    protected $order, $orderFood;

    public function __construct(Order $order, OrderFood $orderFood)
    {
        $this->order = $order;
        $this->orderFood = $orderFood;
    }

    public function createNewOrder($input)
    {
        $order = new Order;
        $now = Carbon::now()->toDateTimeString();

        $order->user = $input['user'];
        $order->created_at = $now;
        $order->save();

        foreach ($input['foodList'] as $food) {
            $orderFood = new OrderFood;

            $orderFood->order_id = $order->id;
            $orderFood->name = $food['name'];
            $orderFood->price = $food['price'];
            $orderFood->amount = $food['amount'];
            $orderFood->created_at = $now;

            $orderFood->save();
        }
    }

    public function getAllOrders()
    {
        $orderList = Order::with('OrderFoods')->get();

        return $orderList;
    }

    public function deleteOrderById($input)
    {
        $order = Order::find($input['id']);
        $order->OrderFoods()->delete();
        $order->delete();
    }

    public function completeOrderById($input)
    {
        $id = $input['id'];

        Order::where('id', $id)->update([
            'status' => 'Success',
        ]);
    }
}
