<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>蓝默空间-LvBlog</title>
    <meta name="description" content="LvBlog是基于Laravel5.8和Vue2开发的API驱动、前后端分离、响应式的单页面博客类Web应用">
    <meta name="robots" content="all,follow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--css--}}
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
    {{--<link href="https://mozilan.geekadpt.cn/lvblog/public/css/app.css" rel="stylesheet" type="text/css"/>--}}
    <!-- Favicon-->
    <link rel="shortcut icon" href=”https://mozilan.geekadpt.cn/www/img/favicon/favicon-64.ico” type=”image/x-icon”>
</head>
<body>
{{--
*   Application: LvBlog
*   Frameworks: Laravel 5.8 & Vue 2 & Element-UI 2.12.0
*   Author: WuNian
*   Gitee: https://gitee.com/bluish_space/lvblog
*   URL: https://www.mozilan.com
*   License: MIT License
*   Copyright (c) 2019 - BluishSpace
*
--}}

<div id="app">
    <router-view></router-view>
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
{{--<script type="text/javascript" src="https://mozilan.geekadpt.cn/lvblog/public/js/app.js"></script>--}}

</body>
</html>