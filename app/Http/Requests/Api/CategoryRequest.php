<?php

namespace App\Http\Requests\Api;
class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' =>'required|max:20',
            'description' =>'nullable|max:60',
        ];
    }
}