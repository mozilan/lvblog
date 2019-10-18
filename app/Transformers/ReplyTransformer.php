<?php

namespace App\Transformers;
use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    public function transform(Reply $reply)
    {
        return [
            'id' => $reply->id,
            'comment_id' => $reply->comment_id,
            'fromId' => $reply->fromId,
            'fromName' => $reply->fromName,
            'fromAvatar' => $reply->fromAvatar,
            'toId' => $reply->toId,
            'toName' => $reply->toName,
            'toAvatar' => $reply->toAvatar,
            'content' => $reply->content,
            'date' => $reply->created_at->toDateTimeString(),
        ];
    }
}