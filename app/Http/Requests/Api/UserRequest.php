<?php

namespace App\Http\Requests\Api;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|max:15',
                    'password' => 'required|string|min:6',
                    'verification_key' => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;
            case 'PATCH':
                $userId = \Auth::guard('api')->id();
                return [
                    'name' => 'required|max:15,' .$userId,
                    'email'=>'nullable|email|unique:users,email,' .$userId,
                    'introduction' => 'max:80',
                    'avatar_image_id' => 'nullable|exists:images,id,type,avatar,user_id,' .$userId,
                ];
                break;
        }
    }
    public function attributes()
    {
        return [
            'name' => '用户名',
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
            'introduction' => '个人简介',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => ':attribute不能为空。',
        ];
    }
}