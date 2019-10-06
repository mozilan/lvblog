<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Models\Archive;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleMapTag;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Models\User;

class ArticlesController extends Controller
{
    //
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        $article->save();
        $archieve=new Archive();
        $archieve->user_id = $this->user()->id;
        $archieve->article_id = $article->id;
        $archieve->title = $article->title;
        $archieve->save();
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
    public function index(Request $request, Article $article)
    {
        $query = $article->query();

        if ($categoryId = $request->category_id) {
            $query->where('category_id', $categoryId);
        }

        switch ($request->order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        $query->where('target','0');
        $articles = $query->paginate(6);

        return $this->response->paginator($articles, new ArticleTransformer());
    }
    public function userIndex($user, Request $request)
    {
        $user = User::find($user);
        $articles = $user->articles()->recent()
            ->paginate(6);
//        $articles = Article::where('user_id',$user)->recent()
//            ->paginate(20);
        return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function show($article)
    {
        $article = Article::find($article);
        if($this->user->id != $article->user_id && $article->target != 0 ) {
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }
        return $this->response->item($article, new ArticleTransformer());
    }
}