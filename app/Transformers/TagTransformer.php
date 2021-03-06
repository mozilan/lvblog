<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag)
    {

        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'count' => $tag->num,
            'user_id' => $tag->user_id,
        ];
    }
}