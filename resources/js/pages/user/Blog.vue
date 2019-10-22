<template>
    <div class="blog" style="overflow:auto">
        <el-row type="flex" class="row-bg" justify="center">
            <el-col :xs="24" :sm="24" :md="16" :lg="16">
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
                        <template>
                            <div class="item" :key="refresh_side">
                                <Tag></Tag>
                            </div>
                        </template>
                        <div class="lv-clear-both"></div>
                        <template>
                            <div class="item lv-margin-top" :key="refresh_side">
                                <Category></Category>
                            </div>
                        </template>
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
                                        <el-popover
                                                placement="bottom"
                                                width="200"
                                                trigger="hover">
                                            <router-link :to="{name:'编辑文章',params: {art:i.id},query:{user:i.user_id}}" ><el-button>编辑</el-button></router-link>
                                            <el-button @click="deleteArticle(i.id)">删除</el-button>
                                            <div class="lv-card-shadow" slot="reference" :style="showModel.body">
                                                    <h5 :style="showModel.title" class="clear-title lv-border-left"><router-link :to="{name:'查看文章',params: {art_id:i.id}}"    class="art-title">{{i.title}}</router-link></h5>
                                                    <el-row class="art-info d-flex align-items-center justify-content-start">
                                                        <div class="art-time" :style="showModel.time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
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
                                                    <el-row class="art-body" :style="showModel.abstract">
                                                        <div class="side-img hidden-sm-and-down" :style="showModel.image"><el-image class="art-banner" :src="configs.IMG_API+i.id">
                                                            <div slot="placeholder" class="image-slot">
                                                                <img class="art-banner" src="https://mozilan.geekadpt.cn/img/other/orange.progress-bar-stripe-loader.svg">
                                                            </div>
                                                        </el-image></div>
                                                        <div class="side-abstract">
                                                            <router-link :to="{name:'查看文章',params: {art_id:i.id}}">
                                                                <div class="art-abstract" :style="showModel.abstract">
                                                                    {{i.excerpt}}
                                                                </div>
                                                            </router-link>
                                                        </div>
                                                    </el-row>
                                                    <div style="display: block;width: 100%">
                                                        <div class="art-more">
                                                            <router-link :to="{name:'查看文章',params: {art_id:i.id}}"    >
                                                                <el-button plain  class="art-more-button" :style="showModel.read">阅读全文</el-button>
                                                                <span class="art-more-button-sm">阅读全文</span>
                                                                <span class="art-more-simple" :style="showModel.simple_read">阅读全文</span>
                                                            </router-link>
                                                            <div class="art-time-small"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                            <div class="art-time-simple" :style="showModel.simple_time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                            <div class="view"><i class="el-icon-view"></i>&#8194;{{i.view_count}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </el-popover>
                                        <img v-show="index <= 3" class="star" src="../../../assets/star.png" />
                                    </el-row>
                                </li>
                            </ul>
                            <p v-if="loading">加载中...</p>
                            <p v-if="noMore">很高兴你翻到这里，但是真的没有了...</p>
                        </div>
                    </el-col>
                    <Oauth></Oauth>
                </el-row>
            </el-col>
        </el-row>
        <whell-menu></whell-menu>
    </div>
</template>
<script>
    import Friend from '../../components/Friend'
    import Tag from '../../components/User/Tag'
    import FTag from '../../components/SmallCreen/Tag'
    import Category from '../../components/User/Category'
    import FCategory from '../../components/SmallCreen/Category'
    import Oauth from '../../components/Oauth'
    import LFooter from '../../components/L-footer'
    import WhellMenu from '../../components/Wheel-menu'
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
                activeName: 'first',
                refresh_side:1,
            }
        },
        name: 'my-blog',
        components: {
            Friend,
            Tag,
            Category,
            FTag,
            FCategory,
            Oauth,
            LFooter,
            WhellMenu
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
            },
            showModel(){
                return this.$store.getters.getArticleShowModel;
            },
            configs(){
                return this.$store.getters.getConfigs;
            }
        },
        watch: {
            // 如果路由有变化，会再次执行该方法
            "$route": "getArticles"
        },
        created(){
            //console.log(this.$route.params.owner+' '+this.$route.params.draft+' '+this.$route.params.private);
            this.getArticles();
            this.infinite_box.maxHeight = this.infinite_side.maxHeight = window.innerHeight-152 +'px';
        },
        methods: {
            getArticles(){
                if(this.$route.params.owner !== undefined && this.$route.params.draft ===undefined && this.$route.params.private === undefined)
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
                    //console.log("没有检测到any属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadArticles',{
                        user:this.$route.params.owner ? this.$route.params.owner : '',
                    });
                }else if(this.$route.params.owner === undefined && this.$route.params.draft ===undefined && this.$route.params.private !==undefined){
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    //console.log("检测到private属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadPrivateArticles',{
                        page:'',
                    });
                }else if(this.$route.params.owner === undefined&& this.$route.params.draft !==undefined && this.$route.params.private ===undefined){
                    // const loading = this.$loading({
                    //     lock: true,
                    //     text: 'Loading',
                    //     spinner: 'el-icon-loading',
                    //     background: 'rgba(0, 0, 0, 0.7)'
                    // });
                    // setTimeout(() => {
                    //     loading.close();
                    // }, 800);
                    //console.log("检测到draft属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadDraftArticles',{
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
                        user:this.$route.params.owner ? this.$route.params.owner : '',
                    });
                }
            },
            load () {
                this.loading = true;
                setTimeout(() => {
                    if(this.$route.params.owner !== undefined && this.$route.params.draft === undefined&& this.$route.params.private === undefined)
                    {
                        this.$store.dispatch('loadArticles',{
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,

                        });
                    }else if(this.$route.params.owner === undefined&& this.$route.params.draft === undefined && this.$route.params.private !== undefined){
                        this.$store.dispatch('loadPrivateArticles',{
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else if(this.$route.params.owner === undefined && this.$route.params.draft !==undefined && this.$route.params.private === undefined){
                        this.$store.dispatch('loadDraftArticles',{
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else{
                        this.$store.dispatch('loadArticles',{
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
                                ++this.refresh_side;
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