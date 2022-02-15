<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    protected $food_service;

    public function __construct(FoodService $food_service)
    {
        $this->food_service = $food_service;
    }

    public function getAllFoodClass()
    {
        $foodList = $this->food_service->getAllFoodClass();

        return $foodList;
    }

    public function createFoodClass(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'price' => 'required|integer',
            'img_url' => 'required|string',
            'type' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $foodList = $this->food_service->createFoodClass($input);
            return ['resultCode' => 200, 'message' => 'Insert Food Success'];
        }
    }
}
