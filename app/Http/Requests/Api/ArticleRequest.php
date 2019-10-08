<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'body' => 'required|string',
            'tags' => 'nullable',
            'category_id' => 'required|numeric|exists:categories,id',
            'excerpt' => 'nullable|string|max:125',
            'target' => 'required|numeric'
        ];
    }
}
