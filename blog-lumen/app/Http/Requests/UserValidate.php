<?php

namespace App\Http\Requests;

class UserValidate
{
    /**
     * Store validate
     * @return array
     */
    function storeValidate(): array
    {
        $rules = [
            'name'  => 'required',
            'email' => 'required|email',
        ];
        $messages = [
            'name.required'  => 'Tên là bắt buộc',
            'email.required'  => 'Email là bắt buộc',
            'email.email'  => 'Email không đúng',
        ];

        return [
            'rules'     => $rules,
            'messages'   => $messages
        ];
    }

    /**
     * Login validate
     * @return array
     */
    function registerValidate(): array
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            're_password'  => 'required|same:password',
        ];
        $messages = [
            'name.required'         => 'Tên là bắt buộc',
            'email.required'        => 'Email là bắt buộc',
            'email.email'           => 'Email không đúng',
            'password.required'     => 'Mật khẩu là bắt buộc',
            're_password.required'  => 'Xác nhận khẩu là bắt buộc',
            're_password.same'      => 'Mật khẩu không trùng khớp',
        ];

        return [
            'rules'     => $rules,
            'messages'  => $messages
        ];
    }

    /**
     * Login validate
     * @return array
     */
    function loginValidate(): array
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required',
        ];
        $messages = [
            'email.required'    => 'Email là bắt buộc',
            'email.email'       => 'Email không đúng',
            'password.required' => 'Mật khẩu là bắt buộc',
        ];

        return [
            'rules'      => $rules,
            'messages'   => $messages
        ];
    }
}
