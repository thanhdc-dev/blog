<?php

namespace App\Http\Requests;

class PostValidate
{
    /**
     * Store validate
     * @return array
     */
    function storeValidate(): array
    {
        $rules = [
            'title' => 'required',
            'body'  => 'required',
        ];
        $messages = [
            'name.required'  => 'Tiêu đề là bắt buộc',
            'email.required'  => 'Nội dung là bắt buộc',
        ];

        return [
            'rules'     => $rules,
            'messages'   => $messages
        ];
    }
}
