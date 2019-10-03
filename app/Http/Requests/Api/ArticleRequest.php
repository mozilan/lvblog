<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
            'tags' => 'nullable',
            'category_id' => 'required|numeric|exists:categories,id',
            'target' => 'required|numeric'
        ];
    }
}
