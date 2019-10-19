<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CommentRequest;
use App\Http\Requests\Api\ReplyRequest;
use App\Models\Comment;
use App\Models\Article;
use App\Models\Reply;
use App\Transformers\CommentTransformer;
use App\Models\User;
use Illuminate\Support\Str;

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

    public function store($article,CommentRequest $request)
    {
        if($article = Article::find($article)){
            $user = $this->user;
            $data = new Comment();
            $data ->article_id           = $article->id ;
            $data -> fromId              = $user->id;
            $data ->  type               =     0;
            $data ->  fromName           = $user->name;
            $data ->  fromAvatar         = $user->avatar;
            $data ->  Contents            = $request->contents;
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

    public function replyStore(ReplyRequest $request,$comment)
    {
        if ($comment = Comment::find($comment)){
            $fromUser = $this->user;
            $toUser = User::find($request->toUser);
            $data = new Reply();
            $data ->  comment_id      = $comment->id;
            $data ->  fromId          = $fromUser->id;
            $data ->  fromName        = $fromUser->name;
            $data ->  fromAvatar      = $fromUser->avatar;
            $data ->  toId            = $toUser->id;
            $data ->  toName          = $toUser->name;
            $data ->  toAvatar        = $toUser->avatar;
            $data ->  Contents         = Str::after($request->contents,'@'.$toUser->name.' ');
            if($data->save()) {
                return response()->json(['message' => '回复成功'], 201);
            }else{
                return response()->json(['message' => '回复失败'], 500);
            }
        }else{
            return response()->json(['message' => '目标评论不存在'], 404);
        }
    }

    public function like($comment)
    {
        $comment = Comment::find($comment);
        if($comment){
            ++$comment->likeNum;
            if($comment->save()){
                return response()->json(['message' => '点赞成功'], 201);
            }else{
                return response()->json(['message' => '点赞失败'], 500);
            }

        }else{
            return response()->json(['message' => '点赞失败'], 500);
        }
    }

    public function destroy($comment)
    {
        $this->authorize('destroy', $this->user());
        $comment = Comment::find($comment);
        if(Reply::where('comment_id',$comment->id)->delete() && $comment->delete()){
            return response()->json(['message' => '删除成功'], 201);
        }
        else{
            return response()->json(['message' => '删除失败'], 500);
        }
    }
    public function replyDestroy($reply)
    {
        $this->authorize('destroy', $this->user());
        if(Reply::destroy($reply)){
            return response()->json(['message' => '删除成功'], 201);
        }else{
            return response()->json(['message' => '删除失败'], 500);
    }

    }
}
