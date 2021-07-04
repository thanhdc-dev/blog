<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    protected $modelClass = User::class;
    protected $validateClass = UserValidate::class;


    /**
     * Đăng ký
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function register(Request $request) {
        if (method_exists($this->validate,'registerValidate')) {
            $storeValidate = $this->validate->registerValidate();
            $validate = Validator::make($request->all(), $storeValidate['rules'], $storeValidate['messages']);
            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()->first()]);
            }
        }

        $userExists = User::where('email', $request->email)
            ->where('trash', false)
            ->where('delete', false)
            ->exists();

        if ($userExists) {
            return response()->json(['status' => false, 'message' => 'Tài khoản đã tồn tại']);
        }

        $params = $request->post();
        $params['password'] = Hash::make($params['password']);
        $userNew = $this->model->fill($params);
        $userNew->save();

        return response()->json(['status' => false, 'data' => $userNew]);
    }

    /**
     * Đăng nhập
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function login(Request $request) {
        if (method_exists($this->validate,'loginValidate')) {
            $storeValidate = $this->validate->loginValidate();
            $validate = Validator::make($request->all(), $storeValidate['rules'], $storeValidate['messages']);
            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()->first()]);
            }
        }

        $user = User::where('email', $request->email)
            ->where('trash', false)
            ->where('delete', false)
            ->first();

        /** Sai thông tin email hoặc mật khẩu */
        if (!$user || !Hash::check($request->password, $user->getAuthPassword())) {
            return response()->json(['status' => false, 'message' => 'unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json($user->createToken($user->id));
    }
}
