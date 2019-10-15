<style scoped lang="scss">
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
    .tag{
        margin-right: 5px;
    }
    img.tag {
        width: 16px;
        height: 16px;
    }
    .clear-title{
        border-left: 3px solid #F56C6C;
        padding-left: 5px;
        margin-top: 15px;
        margin-bottom: 0;
    }
    .art-title {
        cursor: pointer;
    }
    .art-title:hover {
        color: #409EFF;
    }

    .art-time {
        margin: 6px 0;
    }
    .art-time-small {
        margin: 0;
        display: none;
    }
    .art-body {
        display: flex;
        padding: 10px 0;
    }

    .art-category {
        float: left;
        padding-left: 5px;
    }

    .side-img {
        height: 150px;
        width: 270px;
        overflow: hidden;
        margin-right: 10px;
    }
    .art-banner {
        width: 100%;
        height: 100%;
        transition: all 0.6s;
    }
    .art-banner:hover  {
        transform: scale(1.4);
    }
    .side-abstract {
        flex: 1;
        display: flex;
        flex-direction: column;
        color: #aaa;
    }
    .art-abstract{
        padding: 10px 0;
    }
    .art-more {
        display: flex;
        justify-content: space-between;
        flex: 1 auto;
        align-items: flex-end;
    }
    .art-more .view {
        color: #aaa;
    }
    .art-more .art-more-button-sm{
        display: none;
    }
    h5{
        font-size: 18px;
    }
    .pagination {
        background-color: #F9F9F9;
    }
    ul{
        list-style:none;
        margin:0; padding:0;
    }
    .infinite-list-wrapper p{
        text-align: center;
    }
    .blog{
        padding-top: 20px;
    }
    .lv-blog-side{
        padding-bottom: 10px;
    }
    .lv-margin-top{
        margin-top:20px;
    }
    .image-slot{
        height: 150px;
    }
    .el-image{
        display: block;
    }
    .phone-tab{
        display: none;
    }
    @media only screen and (max-width: 683px){
        .lv-blog-side{
            width: 100%;
        }
        .lv-blog-middle{
            width: 100%;
        }
        .lv-tag-side{
            display: none;
            width: 100%;
        }
        .lv-tag-side-sm{
            width: 100%;
        }
        .lv-row-bg{
            display: block;
        }
        .art-body {
            display: block;
            padding: 10px 0;
        }
        .art-time{
            display: none;
        }
        .art-time-small{
            display: block;
        }
        .side-img {
            height: auto;
            width: 100%;
            overflow: hidden;
            margin-right: 10px;
        }
        #side{
            max-height: none!important;
            margin-top: 20px;
        }
        .art-category {
            clear: both;
            padding: 0;
        }
        .phone-tab{
            display: block;
        }
        .lv-margin-top{
            margin-top:0;
        }
        .el-card__header{
            display: none;
        }
        .art-item {
            font-size: 14px;
        }
        .art-more-button{
            display: none;
        }
        .art-more-button-sm{
            color: orange;
            display:block!important;
        }
    }
</style>
<template>
    <el-row type="flex" class="row-bg" justify="center">
        <el-col :xs="24" :sm="24" :md="16" :lg="16">
        <div class="blog" style="overflow:auto">
        <el-backtop target=".blog-component__scroll .blog-scrollbar__wrap"></el-backtop>
            <el-row type="flex" class="row-bg lv-row-bg" justify="space-between">
                <el-collapse accordion class="phone-tab">
                    <el-collapse-item>
                        <template slot="title">
                            归类<i class="header-icon el-icon-info"></i>
                        </template>
                        <template>
                            <el-tabs v-model="activeName">
                                <el-tab-pane label="标签" name="first">
                                    <el-col :span="6" class="hidden-sm-and-down lv-tag-side-sm" :style="infinite_side" >
                                        <div class="item">
                                            <FTag></FTag>
                                        </div>
                                        <div class="lv-clear-both"></div>
                                    </el-col>
                                </el-tab-pane>
                                <el-tab-pane label="分类" name="second">
                                    <div class="lv-clear-both"></div>
                                    <div class="item lv-margin-top">
                                        <FCategory></FCategory>
                                    </div>
                                </el-tab-pane>
                            </el-tabs>
                        </template>
                    </el-collapse-item>
                </el-collapse>
                <el-col :span="7" class="hidden-sm-and-down lv-tag-side" id="side" :style="infinite_side" >
                    <div class="item">
                        <Tag></Tag>
                    </div>
                    <div class="lv-clear-both"></div>
                    <div class="item lv-margin-top">
                        <Category></Category>
                    </div>
                    <div class="lv-clear-both"></div>
                </el-col>
                <el-col :span="16"  class="lv-blog-side blog-component__scroll" v-loading="loading">
                    <div class="infinite-list-wrapper blog-scrollbar__wrap" :style="infinite_box"  >
                            <ul
                                class="list"
                                v-infinite-scroll="load"
                                infinite-scroll-disabled="disabled">
                            <li v-for="(i , index) in articles.data">
                                <el-row class="art-item">
                                    <el-card shadow="hover">
                                        <h5 class="clear-title"><router-link :to="{name:'查看文章',params: {art_id:i.id}}" tag="span" class="art-title">{{i.title}}</router-link></h5>
                                        <el-row class="art-info d-flex align-items-center justify-content-start">
                                            <div class="art-time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                            <div class="lv-clear-both"></div>
                                            <div class="d-flex align-items-center lv-float-left">
                                                <i class="el-icon-collection-tag"></i>：
                                                <span v-for="t in i.tag">
                                                        <router-link :to="{name:'标签文章',params: {tag:t.id},query:{user:i.user_id}}">
                                                            <el-tag size="mini" class="tag">{{t.name}}</el-tag>
                                                        </router-link>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center art-category">
                                                <i class="el-icon-folder-opened"></i>：
                                                <span>
                                                    <span>
                                                        <router-link :to="{name:'分类文章',params: {category:i.category.data.id},query:{user:i.user_id}}" >
                                                            <el-tag size="mini">{{i.category.data.name}}</el-tag>
                                                        </router-link>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="lv-clear-both"></div>
                                        </el-row>
                                        <el-row class="art-body">
                                            <div class="side-img hidden-sm-and-down"><el-image class="art-banner" :src="img_src+i.id">
                                                <div slot="placeholder" class="image-slot">
                                                    <img class="art-banner" src="https://mozilan.geekadpt.cn/img/other/orange.progress-bar-stripe-loader.svg">
                                                </div>
                                            </el-image></div>
                                            <div class="side-abstract">
                                                <router-link :to="{name:'查看文章',params: {art_id:i.id}}">
                                                    <div class="art-abstract">
                                                        {{i.excerpt}}
                                                    </div>
                                                </router-link>
                                                <div class="art-more">
                                                    <router-link :to="{name:'查看文章',params: {art_id:i.id}}" tag="span">
                                                        <el-button plain  class="art-more-button">阅读全文</el-button>
                                                        <span class="art-more-button-sm">阅读全文</span>
                                                    </router-link>
                                                    <div class="art-time-small"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                    <div class="view"><i class="el-icon-view"></i>&#8194;{{i.view_count}}</div>
                                                </div>
                                            </div>

                                        </el-row>
                                    </el-card>
                                    <img v-show="index <= 3" class="star" src="../../assets/star.png" />
                                </el-row>
                            </li>
                        </ul>
                        <p v-if="loading">加载中...</p>
                        <p v-if="noMore">很高兴你翻到这里，但是真的没有了...</p>
                    </div>
                </el-col>
                <Oauth></Oauth>
            </el-row>
            </div>
        </el-col>
    </el-row>
</template>
<script>
    import Friend from '../components/friend'
    import Tag from '../components/User/Tag'
    import FTag from '../components/SmallCreen/Tag'
    import Category from '../components/User/Category'
    import FCategory from '../components/SmallCreen/Category'
    import Oauth from '../components/Oauth'
    import LFooter from '../components/L-footer'
    export default {
        data () {
            return {
                loader:{},
                loading: false,
                infinite_box:{
                    maxHeight:'',
                    overflow: 'auto',
                },
                infinite_side:{
                    maxHeight:'',
                    overflow: 'auto',
                },
                img_src:'https://s0.xinger.ink/acgimg/acgurl.php?',
                activeName: 'first'
            }
        },
        name: 'blog',
        components: {
            Friend,
            Tag,
            Category,
            FTag,
            FCategory,
            Oauth,
            LFooter
        },
        computed:{
            noMore () {
                if(this.$store.getters.getArticles.meta === undefined || this.$store.getters.getArticles.meta === undefined ){
                    return true;
                }else{
                    return this.$store.getters.getArticles.meta.pagination.current_page >= this.$store.getters.getArticles.meta.pagination.total_pages;
                }
            },
            disabled () {
                return this.loading || this.noMore
            },
            articles(){
                return this.$store.getters.getArticles;
            }
        },
        watch: {
            // 如果路由有变化，会再次执行该方法
            "$route": "getArticles"
        },
        created(){
            this.getArticles();
            this.infinite_box.maxHeight = this.infinite_side.maxHeight = window.innerHeight-152 +'px';

        },
        methods: {
            getArticles(){
                if(this.$route.params.user !== undefined && this.$route.params.tag ===undefined && this.$route.params.category === undefined)
                {
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    // console.log("检测到user属性，没检测到tag属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadArticles',{
                    user:this.$route.params.user ? this.$route.params.user : '',
                    });
                }else if(this.$route.params.user === undefined && this.$route.params.tag !==undefined && this.$route.params.category ===undefined){
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    // console.log("检测到tag属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadUserTagArticles',{
                        user:this.$route.params.user,
                        tag:this.$route.params.tag,
                        page:'',
                    });
                }else if(this.$route.params.user === undefined&& this.$route.params.tag ===undefined && this.$route.params.category !==undefined){
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    // console.log("检测到cat属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadUserCategoryArticles',{
                        user:this.$route.params.user,
                        category:this.$route.params.category,
                        page:'',
                    });
                }else{
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadArticles',{
                        user:this.$route.params.user ? this.$route.params.user : '',
                    });
                }

            },
            load () {
                this.loading = true;
                setTimeout(() => {
                    if(this.$route.params.user !== undefined && this.$route.params.tag === undefined&& this.$route.params.category ===undefined)
                    {
                        this.$store.dispatch('loadArticles',{
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,

                        });
                    }else if(this.$route.params.user === undefined&& this.$route.params.tag !== undefined && this.$route.params.category ===undefined){
                        this.$store.dispatch('loadUserTagArticles',{
                            tag:this.$route.params.tag,
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else if(this.$route.params.user === undefined&& this.$route.params.tag ===undefined && this.$route.params.category !==undefined){
                        this.$store.dispatch('loadUserCategoryArticles',{
                            category:this.$route.params.category,
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else{
                        this.$store.dispatch('loadArticles',{
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }
                    this.$watch(this.$store.getters.getArticlesLoadStatus, function () {
                        if(this.$store.getters.getArticlesLoadStatus() === 2) {
                            this.loading = false
                        }
                        if(this.$store.getters.getArticlesLoadStatus() === 3) {
                            this.$message.error('错了哦，加载文章失败了');
                        }
                    });
                }, 800);
            },
            deleteArticle(id){
                this.$confirm('确认删除？')
                .then(_ => {
                    this.loader = this.$loading({
                        lock: true,
                        text: '正在删除...',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                    this.$store.dispatch('deleteArticle',{
                        id:id
                    });
                    this.$watch(this.$store.getters.getArticleDeleteStatus, function () {
                        if(this.$store.getters.getArticleDeleteStatus() === 2) {
                            this.loader.close();
                            this.$message.success('文章已删除！');
                            this.getArticles();
                        }
                        if(this.$store.getters.getArticleDeleteStatus() === 3) {
                            this.loader.close();
                            this.$message.error('错了哦，文章删除失败了');
                        }
                    });
                    done();
                })
                .catch(_ => {});
            }
        }
    }
</script>