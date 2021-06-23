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
}
