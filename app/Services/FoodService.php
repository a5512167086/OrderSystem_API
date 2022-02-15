<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Support\Carbon;

class FoodService
{
    protected $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
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
}
