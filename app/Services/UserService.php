<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsers()
    {
        $userList = User::all();

        return $userList;
    }

    public function createUser($input)
    {
        $now = Carbon::now()->toDateTimeString();

        $user = new User;

        $user->account = $input['account'];
        $user->password = $input['password'];
        $user->user_name = $input['user_name'];
        $user->user_email = $input['user_email'];
        $user->created_at = $now;
        $user->updated_at = null;

        $user->save();
    }

    public function checkExisted(string $account)
    {
        $user = User::where('account', '=', $account)->first();

        if ($user != null) {
            return true;
        } else {
            return false;
        }
    }

    public function loginUser(string $account, string $password)
    {
        $user = User::where([['account', '=', $account], ['password', '=', $password]])->first();

        if ($user != null) {
            return ['isSuccess' => true, 'user_info' => $user];
        } else {
            return ['isSuccess' => false];
        }
    }
}
