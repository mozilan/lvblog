<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleMapTag;

class ArticlesController extends Controller
{
    //
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        $article->save();
        foreach ($request->tags as $v){
            if(Tag::where([['name',$v],['user_id',$this->user()->id]])->first() !== null){
                $tag = Tag::where([
                    ['name',$v],
                    ['user_id',$this->user()->id]
                ])->first();
                $tag->num = $tag->num+1;
            }else{
                $tag = new Tag();
                $tag -> user_id = $this->user()->id;
                $tag -> name = $v;
                $tag -> num = 1;
            }
            $tag->save();
            $article_map_tag = new ArticleMapTag();
            $article_map_tag-> tag_id = $tag->id;
            $article_map_tag-> article_id = $article->id;
            $article_map_tag->save();
        }

//        return $this->response->item($article, new TopicTransformer())
//            ->setStatusCode(201);
        return response()->json(['message' => '发布成功'], 201);
    }
}