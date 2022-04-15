<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order_list';

    protected $fillable = ['user', 'status'];

    const UPDATED_AT = null;

    public function OrderFoods()
    {
        return $this->hasMany(OrderFood::class);
    }
}
