<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    //用户列表
    $router->get('users', 'UsersController@index');
    //查看用户
    $router->get('users/{id}', 'UsersController@show');
    //删除用户
    $router->delete('users/{id}', 'UsersController@delete');

    //文章列表
    $router->get('articles', 'ArticlesController@index');
    //查看文章
    $router->get('articles/{id}', 'ArticlesController@show');
    //编辑文章
    $router->get('articles/{id}/edit', 'ArticlesController@edit');
    //更新文章
    $router->put('articles/{id}', 'ArticlesController@update');
    //删除文章
    $router->delete('articles/{id}', 'ArticlesController@destroy');


    $router->get('comments', 'CommentsController@index');
    $router->get('comments/{id}', 'CommentsController@show');
    $router->delete('comments/{id}', 'CommentsCodesController@destroy');

    $router->get('replies', 'RepliesController@index');
    $router->get('replies/{id}', 'RepliesController@show');
    $router->delete('replies/{id}', 'RepliesController@destroy');

    //预览网站配置
    $router->get('configs', 'WebController@index');
    //新建网站配置
    $router->get('configs/create', 'WebController@create');
    //查看网站配置
    $router->get('configs/{id}', 'WebController@show');
    //删除网站配置
    $router->delete('configs/{id}', 'WebController@destroy');

    //新增网站配置 - 保存
    $router->post('configs', 'WebController@store');
    //编辑网站配置
    $router->get('configs/{id}/edit', 'WebController@edit');
    //更新网站配置
    $router->put('configs/{id}', 'WebController@update');



    //友链列表
    $router->get('partners', 'PartnersController@index');
    //新增友链
    $router->get('partners/create', 'PartnersController@create');
    //预览友链
    $router->get('partners/{id}', 'PartnersController@show');
    //删除友链
    $router->delete('partners/{id}', 'PartnersController@destroy');

    //保存友链
    $router->post('partners', 'PartnersController@store');
    //编辑友链
    $router->get('partners/{id}', 'PartnersController@edit');
    //更新友链
    $router->put('partners/{id{}', 'PartnersController@update');

    //预览今日推荐
    $router->get('recommends', 'RecommendsController@index');
    //新增推荐内容
    $router->get('recommends/create', 'RecommendsController@create');
    //查看推荐内容
    $router->get('recommends/{id}', 'RecommendsController@show');
    //保存推荐内容
    $router->post('recommends', 'RecommendsController@store');
    //删除推荐内容
    $router->delete('recommends/{id}', 'RecommendsController@destroy');
    //编辑推荐内容
    $router->get('recommends/{id}/edit', 'RecommendsController@edit');
    //更新推荐内容
    $router->put('recommends/{id}', 'RecommendsController@update');
});
