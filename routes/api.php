<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', function($api) {
//    $api->get('version', function() {
//        return response('this is version v1');
//    });
//});
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\API',
    ], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')
            ->name('api.captchas.store');
        // 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
        //获取某一用户所有分类
        $api->get('categories/{user}', 'CategoriesController@index')
            ->name('api.categories.index');
        //获取某一用户所有文章标签
        $api->get('tags/{user_id}', 'TagsController@index')
            ->name('api.tags.index');
        //获取标签云
        $api->get('all/tags', 'TagsController@all')
            ->name('api.tags.all.show');
        //获取所有文章
        $api->get('articles', 'ArticlesController@index')
            ->name('api.articles.index');
        //获取某一用户所有文章
        $api->get('users/{user}/articles', 'ArticlesController@userIndex')
            ->name('api.users.articles.index');
        //获取某一文章
        $api->get('articles/{article}', 'ArticlesController@show')
            ->name('api.articles.show');
        //获取某一分类下所有文章
        $api->get('categories/{category}/articles/', 'ArticlesController@categoryIndex')
            ->name('api.user.category.articles.show');
        //获取某一标签下所有文章
        $api->get('tags/{tag}/articles', 'ArticlesController@tagIndex')
            ->name('api.user.tag.articles.show');
        //获取文章下所有评论
        $api->get('comments/articles/{article}', 'CommentController@show')
            ->name('api.articles.comments.show');
        //获取某一用户的归档
        $api->get('archives/{user}', 'ArchivesController@index')
            ->name('api.archives.index');
        // 指定用户信息
        $api->get('other/{other}', 'UsersController@other')
            ->name('api.other.show');
        // 获取网站配置信息
        $api->get('web/configs', 'WebController@config');
        // 获取友情链接信息
        $api->get('web/friends', 'WebController@friendShow')
            ->name('api.web.friend,show');
        // 更新阅读量
        $api->patch('articles/view/{article_id}', 'ArticlesController@viewUpdate')
            ->name('api.articles.view.update');
        $api->get('recommend/articles', 'ArticlesController@recommendIndex')
            ->name('api.articles.recommend.show');
        // 评论点赞
        $api->patch('comments/{comment}/like', 'CommentController@like')
            ->name('api.comments.like');
        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            //用户新建分类
            $api->post('categories', 'CategoriesController@store')
                ->name('api.categories.store');
            //用户删除分类
            $api->delete('categories/{id}', 'CategoriesController@destroy')
                ->name('api.categories.destroy');
            // 图片资源
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');
            // 发布文章
            $api->post('articles', 'ArticlesController@store')
                ->name('api.articles.store');
            // 更新文章
            $api->patch('articles/{article}', 'ArticlesController@update')
                ->name('api.articles.update');
            $api->delete('articles/{article}', 'ArticlesController@destroy')
                ->name('api.articles.destroy');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            // 标记消息通知为已读
            $api->patch('user/read/notifications', 'NotificationsController@read')
                ->name('api.user.notifications.read');
            // 当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')
                ->name('api.user.permissions.index');
            //获取用户草稿箱下所有文章
            $api->get('drafts/articles', 'ArticlesController@draftIndex')
                ->name('api.user.draft.articles.show');
            //获取用户私有文章
            $api->get('privates/articles', 'ArticlesController@privateIndex')
                ->name('api.user.private.articles.show');
            // 发布评论
            $api->post('articles/{article}/comments', 'CommentController@store')
                ->name('api.articles.comments.store');
            // 发布回复
            $api->post('comments/{comment}/replies', 'CommentController@replyStore')
                ->name('api.comments.replies.store');
            // 删除评论
            $api->delete('comments/{comment}', 'CommentController@destroy')
                ->name('api.articles.comments.destroy');
            // 删除回复
            $api->delete('comments/replies/{reply}', 'CommentController@replyDestroy')
                ->name('api.comments.replies.destroy');
        });
    });
});
$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});