<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected $order_service;

    public function __construct(OrderService $order_service)
    {
        $this->order_service = $order_service;
    }

    public function createNewOrder(Request $request)
    {
        $rules = [
            'user' => 'required|string',
            'foodList' => 'required|array',
            'foodList.*.name' => 'required|string',
            'foodList.*.amount' => 'required|integer',
            'foodList.*.price' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->order_service->createNewOrder($input);
            return ['resultCode' => 200, 'message' => 'Insert Order Success'];
        }
    }

    public function getAllOrders()
    {
        $orderList = $this->order_service->getAllOrders();

        return $orderList;
    }

    public function deleteOrderById(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->order_service->deleteOrderById($input);
            return ['resultCode' => 200, 'message' => 'Delete Order Success'];
        }
    }
}
