<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function getUsers()
    {
        $userList = $this->user_service->getUsers();

        return $userList;
    }

    public function createUser(Request $request)
    {
        $rules = [
            'account' => 'required|string|min:6|max:100',
            'password' => 'required|string|min:6|max:100',
            'user_name' => 'required|string|max:100',
            'user_email' => 'required|string|email|max:100',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->failed()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->user_service->createUser($input);
            return ['resultCode' => 200, 'message' => 'Insert User Success'];
        }
    }

    public function loginUser(Request $request)
    {
        $account = $request->input()['account'];
        $password = $request->input()['password'];
        $isExisted = $this->user_service->checkExisted($account);

        if ($isExisted) {
            $loginUser = $this->user_service->loginUser($account, $password);

            if ($loginUser['isSuccess']) {
                return ['resultCode' => 200, 'message' => 'Login Success', 'user_info' => $loginUser['user_info']];
            } else {
                return ['resultCode' => 400, 'message' => 'Password Not Correct'];
            }
        } else {
            return ['resultCode' => 400, 'message' => 'User Not Existed'];
        }
    }
}
