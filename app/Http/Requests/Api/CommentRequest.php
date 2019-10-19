<?php

namespace App\Http\Requests\Api;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'contents' => 'max:80',
        ];
    }

    public function attributes()
    {
        return [
            'contents' => '评论内容',
        ];
    }
    public function messages()
    {
        return [
            'contents.max' => '评论内容不能超过80字',
        ];
    }
}