<?php

namespace App\Transformers;

use App\Models\Recommend;
use League\Fractal\TransformerAbstract;

class RecommendTransformer extends TransformerAbstract
{
    public function transform(Recommend $recommend)
    {
        return [
            'id' => $recommend->id,
            'article_id' => $recommend->article_id,
            'article_title' => $recommend->article_title,
            'article_description' => $recommend->article_description,
            'article_thumb' => $recommend->article_thumb,
        ];
    }
}