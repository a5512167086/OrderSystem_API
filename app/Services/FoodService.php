<?php

namespace App\Services;

use App\Models\Food;
use App\Models\FoodType;
use Illuminate\Support\Carbon;

class FoodService
{
    protected $food;

    public function __construct(Food $food, FoodType $foodType)
    {
        $this->food = $food;
        $this->foodType = $foodType;
    }

    public function getAllFoodClass()
    {
        $foodList = Food::all();

        return $foodList;
    }

    public function createFoodClass($input)
    {
        $now = Carbon::now()->toDateTimeString();

        $food = new Food;

        $food->name = $input['name'];
        $food->price = $input['price'];
        $food->img_url = $input['img_url'];
        $food->type = $input['type'];
        $food->created_at = $now;
        $food->updated_at = null;

        $food->save();
    }

    public function getAllFoodType()
    {
        $foodTypeList = FoodType::all();

        return $foodTypeList;
    }


    public function createFoodType($input)
    {
        $now = Carbon::now()->toDateTimeString();

        $foodType = new FoodType;

        $foodType->name = $input['name'];
        $foodType->created_at = $now;
        $foodType->updated_at = null;

        $foodType->save();
    }

    public function deleteFoodById($input)
    {
        $id = $input['id'];

        Food::where('id', $id)->delete();
    }

    public function deleteFoodTypeById($input)
    {
        $id = $input['id'];

        FoodType::where('id', $id)->delete();
    }
}
