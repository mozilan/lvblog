<?php

namespace App\Http\Requests\Api;

use App\Rules\existReply;

class ReplyRequest extends FormRequest
{


    public function rules()
    {
        return [
            'contents' => 'max:80',
            'toUser' => new existReply($this->route('comment'))
        ];
    }

    public function attributes()
    {
        return [
            'contents' => '评论内容',
            'toUser' => '用户'
        ];
    }
    public function messages()
    {
        return [
            'contents.max' => '评论内容不能超过80字',
            'toUser.exists' => '回复的用户不存在或在当前评论下没有发表回复.'
        ];
    }
}