<?php

namespace App\Http\Requests\Api;

class CaptchaRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                'unique:users'
            ]

        ];
    }
    public function attributes()
    {
        return [
            'phone' => '手机号',
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => ':attribute不能为空',
            'phone.regex' => ':attribute格式不正确',
            'phone.unique' => ':attribute已经注册过了',
        ];
    }
}