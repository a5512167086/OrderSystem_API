<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user_list';

    protected $fillable = ['account', 'password', 'user_name', 'user_email'];
}
