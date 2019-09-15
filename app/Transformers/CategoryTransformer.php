<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'user_id' => $category->user_id,
            'name' => $category->name,
            'description' => $category->description,
        ];
    }
}