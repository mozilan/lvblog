<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ArticleRequest;
use App\Models\Archive;
use App\Models\Article;
use App\Models\Category;
use App\Models\Recommend;
use App\Models\Tag;
use App\Models\ArticleMapTag;
use App\Transformers\ArticleTransformer;
use App\Transformers\RecommendTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;

class ArticlesController extends Controller
{
    //
    protected $perpage = 4;
    public function store(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        $article->save();
        if($article->target == 0) {
            //发布归档
            $archieve = new Archive();
            $archieve->user_id = $this->user()->id;
            $archieve->article_id = $article->id;
            $archieve->title = $article->title;
            $archieve->save();
            //发布标签和标签文章对照表
            if ($request->tags) {
                foreach ($request->tags as $v) {
                    if (Tag::where([['name', $v], ['user_id', $this->user()->id]])->first() != null) {
                        $tag = Tag::where([
                            ['name', $v],
                            ['user_id', $this->user()->id]
                        ])->first();
                        $tag->num = $tag->num + 1;
                    } else {
                        $tag = new Tag();
                        $tag->user_id = $this->user()->id;
                        $tag->name = $v;
                        $tag->num = 1;
                    }
                    $tag->save();
                    $article_map_tag = new ArticleMapTag();
                    $article_map_tag->tag_id = $tag->id;
                    $article_map_tag->article_id = $article->id;
                    $article_map_tag->save();
                }
            }
        }
        return response()->json(['message' => '发布成功'], 201);
    }
    public function update(ArticleRequest $request,$article)
    {
        $this->authorize('update', $this->user());
        $article = Article::find($article);
        //删除标签和标签文章对照表
        if($article->target == 0 ){
            if($article_map_tag = ArticleMapTag::where('article_id',$article->id)->get()){
                foreach ($article_map_tag as $v){
                    $tag = Tag::find($v->tag_id);
                    if($tag->num >1){
                        $tag->num = $tag->num - 1;
                        $tag->save();
                    }else{
                        Tag::destroy($v->tag_id);
                    }
                }
            }
            ArticleMapTag::where('article_id',$article->id)->delete();
        }
        $article->fill($request->all());
        $article->user_id = $this->user()->id;
        $article->save();
        //如果不是公开文章则删除归档
        if($article->target != 0 ){
            Archive::where('article_id',$article->id)->delete();
        }
        if($article->target == 0 ){
            //发布标签和标签文章对照表
            if($request->tags){
                foreach ($request->tags as $v){
                    if(Tag::where([['name',$v],['user_id',$this->user()->id]])->first() != null){
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
                    //添加分类表
                    $article_map_tag = new ArticleMapTag();
                    $article_map_tag-> tag_id = $tag->id;
                    $article_map_tag-> article_id = $article->id;
                    $article_map_tag->save();
                    //发布归档
                    $archieve = new Archive();
                    $archieve->user_id = $this->user()->id;
                    $archieve->article_id = $article->id;
                    $archieve->title = $article->title;
                    $archieve->save();
                }
            }
        }
        return response()->json(['message' => '更新成功'], 201);
    }

    public function destroy($id)
    {
        $this->authorize('destroy', $this->user());
        $article = Article::find($id);
        if($article_map_tag = ArticleMapTag::where('article_id',$article->id)->get()){
            foreach ($article_map_tag as $v){
                $tag = Tag::find($v->tag_id);
                if($tag->num >1){
                    $tag->num = $tag->num - 1;
                    $tag->save();
                }else{
                    Tag::destroy($v->tag_id);
                }
            }
        }
        Article::destroy($id);
        Archive::where('article_id',$id)->delete();
        return response()->json(['message' => '删除成功'], 201);
    }
    public function index(Request $request, Article $article)
    {
        $query = $article->query();
        switch ($request->order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        $query->where('target','0');
        $articles = $query->paginate($this->perpage);

        return $this->response->paginator($articles, new ArticleTransformer());
    }
    public function userIndex(Article $article,$user, Request $request)
    {

        $user = User::find($user);
        if(!$user->first()){
            return response()->json(['message' => '不存在此用户'], 403);
        }
        $query = $article->query();
        $query -> where('user_id',$user->id);
        switch ($request->order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        $query->where('target','0');
        $articles = $query->paginate($this->perpage);
        return $this->response->paginator($articles, new ArticleTransformer());
    }

    public function categoryIndex(Article $article,$category,Request $request)
    {
        $query = $article->query();
        $category = Category::find($category);
        if($category){
            $query->where('category_id',$category->id);
            switch ($request->order) {
                case 'recent':
                    $query->recent();
                    break;

                default:
                    $query->recentReplied();
                    break;
            }

            $query->where('target','0');

            $articles = $query->paginate($this->perpage);

            return $this->response->paginator($articles, new ArticleTransformer());
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }

    }
    public function tagIndex($tag,Article $article,Request $request)
    {
        $query = $article->query();
        $tag = Tag::find($tag);
        if($tag){
            $query->whereIn('id', ArticleMapTag::where('tag_id',$tag->id)->pluck('article_id')->toArray());;
            switch ($request->order) {
                case 'recent':
                    $query->recent();
                    break;

                default:
                    $query->recentReplied();
                    break;
            }

            $query->where('target','0');

            $articles = $query->paginate($this->perpage);

            return $this->response->paginator($articles, new ArticleTransformer());
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }
    }

    public function searchIndex(Request $request)
    {
        // 创建一个查询构造器
        $builder = Article::query()->where('target', 0);
        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->search) {
            $like = '%'.$search.'%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('excerpt', 'like', $like);
            });
        }

        // 是否有提交 order 参数，如果有就赋值给 $order 变量
        // order 参数用来控制商品的排序规则
        if ($order = $request->input('order', '')) {
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1], ['reply_count', 'view_count'])) {
                    // 根据传入的排序值来构造排序参数
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }
        $articles = $builder->paginate(16);

        return $this->response->paginator($articles, new ArticleTransformer());
    }
    public function draftIndex(Article $article,Request $request)
    {
        $user = $this->user;
        $query = $article->query();

        if ($query->where('user_id', $user->id)) {
            switch ($request->order) {
                case 'recent':
                    $query->recent();
                    break;

                default:
                    $query->recentReplied();
                    break;
            }
            $query->where('target', '1');

            $articles = $query->paginate($this->perpage);

            return $this->response->paginator($articles, new ArticleTransformer());
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }

    }
    public function privateIndex(Article $article,Request $request)
    {
        $user = $this->user;
        $query = $article->query();

        if ($query->where('user_id', $user->id)) {
            switch ($request->order) {
                case 'recent':
                    $query->recent();
                    break;

                default:
                    $query->recentReplied();
                    break;
            }
            $query->where('target', '2');

            $articles = $query->paginate($this->perpage);

            return $this->response->paginator($articles, new ArticleTransformer());
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }

    }
    public function recommendIndex()
    {
        $recommendArticles = Recommend::whereDate('created_at', '=', Carbon::now()->toDateString())->get();
        if($recommendArticles->first()){
            return $this->response->collection($recommendArticles, new RecommendTransformer());
        }else{
            return response()->json(['message' => '今天没有推荐文章'], 404);
        }

    }
    public function viewUpdate($article)
    {
        $article = Article::find($article);
        if($article){
            ++$article->view_count;
            $article->save();
        }
    }
    public function show($article)
    {
        $article = Article::find($article);
        if($article==null){
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }
        if($this->user){
            if($this->user->id != $article->user_id && $article->target != 0 ) {
                return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
            }else{
                return $this->response->item($article, new ArticleTransformer());
            }
        }else {
            if ($article->target == 0) {
                return $this->response->item($article, new ArticleTransformer());
            } else {
                return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
            }
        }
    }
}