<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $this->food_service->createFoodClass($input);
            return ['resultCode' => 200, 'message' => 'Insert Food Success'];
        }
    }

    public function getAllFoodType()
    {
        $foodTypeList = $this->food_service->getAllFoodType();

        return $foodTypeList;
    }

    public function createFoodType(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->food_service->createFoodType($input);
            return ['resultCode' => 200, 'message' => 'Insert FoodType Success'];
        }
    }

    public function deleteFoodClassById(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->food_service->deleteFoodById($input);
            return ['resultCode' => 200, 'message' => 'Delete FoodType Success'];
        }
    }

    public function deleteFoodTypeById(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->food_service->deleteFoodTypeById($input);
            return ['resultCode' => 200, 'message' => 'Delete FoodType Success'];
        }
    }
}
