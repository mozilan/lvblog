<?php

namespace App\Transformers;

use App\Models\Article;
use App\Models\comment;
use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['reply'];
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'article_id' => $comment->article_id,
            'type' => $comment->type,
            'fromId' => $comment->fromId,
            'fromName' => $comment->fromName,
            'fromAvatar' => $comment->fromAvatar,
            'likeNum' => $comment->likeNum,
            'content' => $comment->content,
            'date' => $comment->created_at->toDateTimeString(),
        ];
    }
    public function includeReply(Comment $comment)
    {
        return $this->collection($comment->reply, new ReplyTransformer());
    }
}