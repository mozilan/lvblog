<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Models\Article;

class ArticlesController extends Controller
{
    //
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        $article->save();

//        return $this->response->item($article, new TopicTransformer())
//            ->setStatusCode(201);
        return response()->json(['message' => '发布成功'], 200);
    }
}