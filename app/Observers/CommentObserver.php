<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\User;
use App\Notifications\ArticleReplied;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
        $article = $comment->article;
        // 如果要通知的人是当前用户，就不必通知了！
        $user =$comment->article->user;
        if (!$user ->id == auth('api')->user()->id) {
            $user->increment('notification_count');
        }
        $article->user->notify(new ArticleReplied($comment));
    }

    /**
     * Handle the comment "updated" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
