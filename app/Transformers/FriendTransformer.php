<?php

namespace App\Transformers;

use App\Models\Partner;
use League\Fractal\TransformerAbstract;

class FriendTransformer extends TransformerAbstract
{
    public function transform(Partner $friend)
    {
        return [
            'name' => $friend->name,
            'avatar' => $friend->avatar,
            'description' => $friend->description,
            'url' => $friend->url,
        ];
    }
}