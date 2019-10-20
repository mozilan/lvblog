<?php

namespace App\Http\Requests\Api;

use App\Rules\existReply;

class ReplyRequest extends FormRequest
{


    public function rules()
    {
        return [
            'contents' => 'required|max:80',
            'toUser' => new existReply($this->route('comment'))
        ];
    }

    public function attributes()
    {
        return [
            'contents' => '回复内容',
            'toUser' => '用户'
        ];
    }
    public function messages()
    {
        return [
            'contents.max' => ':attribute不能超过80字',
            'contents.required' => ':attribute不能为空',
            'toUser.exists' => '回复的用户不存在或在当前评论下没有发表回复.'
        ];
    }
}