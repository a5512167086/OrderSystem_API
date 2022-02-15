<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'food_list';

    protected $fillable = ['name', 'price', 'img_url', 'type'];
}
