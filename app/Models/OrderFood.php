<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFood extends Model
{
    protected $table = 'order_food_list';

    protected $fillable = ['order_id', 'name', 'price', 'amount'];

    const UPDATED_AT = null;

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
