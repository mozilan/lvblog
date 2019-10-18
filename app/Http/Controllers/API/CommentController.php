<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Article;
use App\Transformers\CommentTransformer;

class CommentController extends Controller
{
    //
    public function show($article)
    {
        if($article = Article::find($article)){
            return $this->response->collection($article->comment, new CommentTransformer());
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }
    }
}
