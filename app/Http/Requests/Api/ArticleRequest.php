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
    public function attributes()
    {
        return [
            'title' => '文章标题',
            'body' => '文章内容',
            'tags' => '标签',
            'category_id' => '文章分类',
            'excerpt' => '摘要',
            'target' => '发布形式',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => ':attribute不能为空',
            'body.required' => ':attribute不能为空',
            'category_id.required' => ':attribute不能为空',
        ];
    }
}
