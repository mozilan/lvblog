<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'category'];
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'title' => $article->title,
            'body' => $article->body,
            'user_id' => (int) $article->user_id,
            'category_id' => (int) $article->category_id,
            'reply_count' => (int) $article->reply_count,
            'view_count' => (int) $article->view_count,
            'last_reply_user_id' => (int) $article->last_reply_user_id,
            'excerpt' => $article->excerpt,
            'slug' => $article->slug,
            'created_at' => (string) $article->created_at,
            'updated_at' => (string) $article->updated_at,
            'tag' => $article->Tags(),
        ];

    }
    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }
    public function includeCategory(Article $article)
    {
        return $this->item($article->category, new CategoryTransformer());
    }
}