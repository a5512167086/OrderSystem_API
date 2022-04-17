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

    public function getUserById($id)
    {
        $user = $this->user_service->getUserById($id);

        return $user;
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

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        }

        $isUserExisted = $this->user_service->checkExisted($input['account']);

        if ($isUserExisted) {
            return ['resultCode' => 444, 'message' => 'User Already Existed'];
        }

        $this->user_service->createUser($input);
        return ['resultCode' => 200, 'message' => 'Insert User Success'];
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

    public function deleteUserById(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->user_service->deleteUserById($input);
            return ['resultCode' => 200, 'message' => 'Delete User Success'];
        }
    }

    public function updateUserById(Request $request)
    {
        $rules = [
            'id' => 'required|integer',
            'account' => 'required|string',
            'password' => 'required|string',
            'user_name' => 'required|string',
            'user_email' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        $input = $request->input();

        if ($validator->fails()) {
            return ['resultCode' => 400, 'message' => 'Validator Fail'];
        } else {
            $this->user_service->updateUserById($input);
            return ['resultCode' => 200, 'message' => 'Update FoodClass Success'];
        }
    }
}
