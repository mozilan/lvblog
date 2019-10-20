<?php

namespace App\Http\Requests\Api;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'contents' => 'required|max:80',
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
            'contents.max' => ':attribute不能超过80字',
            'contents.required' => ':attribute不能为空'
        ];
    }
}