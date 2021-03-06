<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Reply;
use App\Observers\ArticleObserver;
use App\Observers\CommentObserver;
use App\Observers\ReplyObserver;
use Encore\Admin\Layout\Content;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Article::observe(ArticleObserver::class);
        Comment::observe(CommentObserver::class);
        Reply::observe(ReplyObserver::class);
    }
}
