<style scoped>
    #side .item {
        margin-bottom: 30px;
    }

    .art-item {
        margin-bottom: 30px;
        position: relative;
    }

    .art-item .star {
        width: 60px;
        height: 60px;
        position: absolute;
        top: 0;
        right: 0;
    }

    img.tag {
        width: 16px;
        height: 16px;
    }

    .art-title {
        border-left: 3px solid #F56C6C;
        padding-left: 5px;
        cursor: pointer;
    }

    .art-title:hover {
        padding-left: 10px;
        color: #409EFF;
    }

    .art-time {
        margin-right: 20px;
    }

    .art-body {
        display: flex;
        padding: 10px 0;
    }

    .side-img {
        height: 150px;
        width: 270px;
        overflow: hidden;
        margin-right: 10px;
    }

    img.art-banner {
        width: 100%;
        height: 100%;
        transition: all 0.6s;
    }

    img.art-banner:hover {
        transform: scale(1.4);
    }

    .side-abstract {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .art-abstract {
        flex: 1;
        color: #aaa;
    }

    .art-more {
        height: 40px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .art-more .view {
        color: #aaa;
    }
    h5{
        font-size: 18px;
    }
    .pagination {
        background-color: #F9F9F9;
    }
</style>

<template>
    <div class="home">
        <el-row id="artList" type="flex" justify="space-around">
            <el-col :span="16">
                <el-row class="art-item">
                    <el-card shadow="hover">
                        <h5><router-link to="/index" tag="span" class="art-title">Laravel+Vue+Element UI开发SPA应用</router-link></h5>
                        <el-row class="art-info d-flex align-items-center justify-content-start">
                            <div class="art-time"><i class="el-icon-time"></i>：2019-08-29</div>
                            <div class="d-flex align-items-center"><img class="tag" src="../../assets/tag.png" />：
                                <el-tag size="mini">Laravel</el-tag><el-tag size="mini">Vue</el-tag><el-tag size="mini">Element UI</el-tag>
                            </div>
                        </el-row>
                        <el-row class="art-body">
                            <div class="side-img hidden-sm-and-down"><img class="art-banner" src="../../assets/laravel.png"></div>
                            <div class="side-abstract">
                                <div class="art-abstract">
                                    Laravel 是 Taylor Otwell 开发的一款基于 PHP 语言的 Web 开源框架，采用了 MVC 的架构模式，在 2011 年 6 月正式发布了首个版本。由于 Laravel 具备 Rails 敏捷开发等优秀特质，深度集成 PHP 强大的扩展包（Composer）生态与 PHP 开发者广大的受众群，让 Laravel 在发布之后的短短几年时间得到了极其迅猛的发展，Laravel 在国内的生态圈发展也日趋成熟，你可以很轻松的在网上找到很多 Laravel 相关的中文学习资料、技术讨论社区。
                                </div>
                                <div class="art-more">
                                    <router-link to="/index" tag="span">
                                        <el-button plain>阅读全文</el-button>
                                    </router-link>
                                    <div class="view"><i class="el-icon-view"></i>12414</div>
                                </div>
                            </div>
                        </el-row>
                    </el-card>
                    <img class="star" src="../../assets/star.png" />
                </el-row>
                <el-row class="art-item">
                    <el-card shadow="hover">
                        <h5><router-link to="/index" tag="span" class="art-title">Vue.js 是什么</router-link></h5>
                        <el-row class="art-info d-flex align-items-center justify-content-start">
                            <div class="art-time"><i class="el-icon-time"></i>：2019-08-29</div>
                            <div class="d-flex align-items-center"><img class="tag" src="../../assets/tag.png" />：
                                <el-tag size="mini">Vue</el-tag>
                            </div>
                        </el-row>
                        <el-row class="art-body">
                            <div class="side-img hidden-sm-and-down"><img class="art-banner" src="../../assets/vue.jpg"></div>
                            <div class="side-abstract">
                                <div class="art-abstract">
                                    Vue (读音 /vjuː/，类似于 view) 是一套用于构建用户界面的渐进式框架。与其它大型框架不同的是，Vue 被设计为可以自底向上逐层应用。Vue 的核心库只关注视图层，不仅易于上手，还便于与第三方库或既有项目整合。另一方面，当与现代化的工具链以及各种支持类库结合使用时，Vue 也完全能够为复杂的单页应用提供驱动。
                                </div>
                                <div class="art-more">
                                    <router-link to="/index" tag="span">
                                        <el-button plain>阅读全文</el-button>
                                    </router-link>
                                    <div class="view"><i class="el-icon-view"></i>12414</div>
                                </div>
                            </div>
                        </el-row>
                    </el-card>
                    <img class="star" src="../../assets/star.png" />
                </el-row>
                <el-row class="art-item">
                    <el-card shadow="hover">
                        <h5><router-link to="/index" tag="span" class="art-title">MVVM 设计模式</router-link></h5>
                        <el-row class="art-info d-flex align-items-center justify-content-start">
                            <div class="art-time"><i class="el-icon-time"></i>：2019-08-29</div>
                            <div class="d-flex align-items-center"><img class="tag" src="../../assets/tag.png" />：
                                <el-tag size="mini">MVVM</el-tag><el-tag size="mini">设计模式</el-tag>
                            </div>
                        </el-row>
                        <el-row class="art-body">
                            <div class="side-img hidden-sm-and-down"><img class="art-banner" src="../../assets/mvvm.png"></div>
                            <div class="side-abstract">
                                <div class="art-abstract">
                                    在 MVVM 设计模式中，也有 Model 层，负责存储数据。有 View 层，用于显示数据。但 MVVM 设计模式中，没有 Presenter 层。取而代之的是 V-Model 层级。
                                    而 V-Model 并不需要我们来 进行编写，使用 MVVM 设计模式进行编码的时候，无需关注 V-Model 这一层是如何实现的，它完全是 Vue 内置的（因为涉及到Vue框架源码的实现，不做讲解）。而我们只需要更多的关注 M 层与 V层，即模型层和视图层。
                                </div>
                                <div class="art-more">
                                    <router-link to="/index" tag="span">
                                        <el-button plain>阅读全文</el-button>
                                    </router-link>
                                    <div class="view"><i class="el-icon-view"></i>12414</div>
                                </div>
                            </div>
                        </el-row>
                    </el-card>
                    <img class="star" src="../../assets/star.png" />
                </el-row>
                <el-row class="art-item">
                    <el-card shadow="hover">
                        <h5><router-link to="/index" tag="span" class="art-title">鼠标悬浮时显示</router-link></h5>
                        <el-row class="art-info d-flex align-items-center justify-content-start">
                            <div class="art-time"><i class="el-icon-time"></i>：2019-08-29</div>
                            <div class="d-flex align-items-center"><img class="tag" src="../../assets/tag.png" />：
                                <el-tag size="mini">swagger2</el-tag>
                            </div>
                        </el-row>
                        <el-row class="art-body">
                            <div class="side-img hidden-sm-and-down"><img class="art-banner" src="../../assets/vue.jpg"></div>
                            <div class="side-abstract">
                                <div class="art-abstract">
                                    Iconfont-国内功能很强大且图标内容很丰富的矢量图标库, 提供矢量图标下载、在快照 在小程序中使用阿里文字图标在小程序中使用阿里文字图标库前在小程序中使用阿里文字图标库前库前端开发的便捷工具 - AndrewNeo - CSDN博客
                                </div>
                                <div class="art-more">
                                    <router-link to="/index" tag="span">
                                        <el-button plain>阅读全文</el-button>
                                    </router-link>
                                    <div class="view"><i class="el-icon-view"></i>12414</div>
                                </div>
                            </div>
                        </el-row>
                    </el-card>
                    <img class="star" src="../../assets/star.png" />
                </el-row>
                <div class="block pagination">
                    <el-pagination background="" layout="prev, pager, next" :total="50">
                    </el-pagination>
                </div>
            </el-col>
            <el-col :span="6" class="hidden-sm-and-down" id="side">
                <div class="item">
                    <Tag></Tag>
                </div>
                <div class="item">
                    <Friend></Friend>
                </div>
            </el-col>
        </el-row>

    </div>
</template>
<script>
    import Friend from '../components/friend'
    import Tag from '../components/tag'

    export default {
        name: 'index',
        components: {
            Friend,
            Tag,

        },
    }
</script>