<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Models\Article;
use App\Models\Reply;
use App\Transformers\CommentTransformer;
use App\Models\User;
use DemeterChain\C;
use Illuminate\Http\Request;

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

    public function store($article,Request $request)
    {
        if($article = Article::find($article)){
            $user = $this->user;
            $data = new Comment();
            $data ->article_id           = $article->id ;
            $data -> fromId              = $user->id;
            $data ->  type               =     0;
            $data ->  fromName           = $user->name;
            $data ->  fromAvatar         = $user->avatar;
            $data ->  content            = $request->contents;
            $data ->  likeNum            = 0;
            if($data->save()){
                return response()->json(['message' => '评论成功'], 201);
            }else{
                return response()->json(['message' => '评论失败'], 500);
            }
        }else{
            return response()->json(['message' => '文章不存在或者没有访问权限'], 404);
        }
    }

    public function replyStore(Request $request,$comment)
    {
        if ($comment = Comment::find($comment)){
            $fromUser = $this->user;
            $toUser = User::find($request->user);
            $data = new Reply();
            $data ->  comment_id      = $comment->id;
            $data ->  fromId          = $fromUser->id;
            $data ->  fromName        = $fromUser->name;
            $data ->  fromAvatar      = $fromUser->avatar;
            $data ->  toId            = $toUser->id;
            $data ->  toName          = $toUser->name;
            $data ->  toAvatar        = $toUser->avatar;
            $data ->  content         = $request->contents;
            if($data->save()) {
                return response()->json(['message' => '回复成功'], 201);
            }else{
                return response()->json(['message' => '回复失败'], 500);
            }
        }else{
            return response()->json(['message' => '目标评论不存在'], 404);
        }
    }
}
