<p align="center"><img src="https://images.gitee.com/uploads/images/2019/1030/103313_1b97b016_2215545.png"></p>

### <p align="center">蓝默空间のLvBlog-V1.1.1</p>


## 关于

LvBlog 是我们应用的名称，“L” 是 Laravel 的缩写 , “v” 是 Vue 的缩写，本项目是基于 Laravel 5.8 + Vue 2 开发， 实现了 API 驱动、前后端分离和响应式的单页面博客类 Web 应用。 

## 安装

- composer install
- yarn install
- php artisan storage:link 
- php artisan key:generate
- php artisan jwt:secret 
- php artisan migrate 
- php artisan admin:install 
- php artisan up 
- npm run production
- sudo chmod -R 777 storage
- sudo chown -R www-data:www-data /var/www/www.mozilan.com

## 配置

-  [Laravel-admin](https://laravel-admin.org/docs/zh/) 初始化应用配置表

## 特性

1. 首页、博客园

- 小白板
- 今日推荐
- 友情链接
- 广告位
- 联系我们
- 标签云
- Ta的标签、分类

2. 登陆、注册

- 第三方登录（GitHub、微博、微信，QQ）
- 手机号注册，使用云片、腾讯云、阿里云短信服务

3. 文章

- 动态添加标签和分类
- Popover 博主信息弹出框
- 一键切换精简、大图模式
- mavonEditor | 基于Vue的markdown 编辑器插件
- 无限懒加载
- 随机图片 API

4. 评论系统


- 仿简书二级评论系统
- 邮件通知
- 消息队列


5. 个人空间

- 引导页
- 个人主页
- 我的简历
- 更新资料


6. 其它

- 面包屑导航
- 站内搜索
- 小屏幕 Collapse 折叠菜单
- 友好的错误提醒界面
- 响应式设计，全面适配小屏幕
- wheelMenu-右下角功能菜单(回到顶部，QQ客服)
- 简约风格，精雕细琢，返璞归真


## Demo

- https://www.mozilan.com

## 交流

- QQ群: 670494430
- 公众号: LAMPer 技术栈


## 支持

- 大三学生党编写开源项目不容易，如果你觉得这个项目帮你节约了时间，不妨支持一下请我喝杯咖啡!  :blush: 

![输入图片说明](https://images.gitee.com/uploads/images/2019/1030/113332_665b0874_2215545.png "在这里输入图片标题")

## License

The LvBlog Application is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).



