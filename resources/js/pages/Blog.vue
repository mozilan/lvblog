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
    .clear-title{
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .art-title {
        border-left: 3px solid #F56C6C;
        padding-left: 5px;
        cursor: pointer;
    }

    .art-title:hover {
        color: #409EFF;
    }

    .art-time {
        margin: 6px 0;
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
    ul{
        list-style:none;
        margin:0; padding:0;
    }
    .infinite-list-wrapper p{
        text-align: center;
    }
</style>
<template>
    <div class="blog" style="overflow:auto">
        <el-backtop target=".blog-component__scroll .blog-scrollbar__wrap"></el-backtop>
        <el-row id="artList" type="flex" justify="space-around">
            <el-col :span="16" class="blog-component__scroll" v-loading="loading">
                <div class="infinite-list-wrapper blog-scrollbar__wrap" :style="infinite_box"  >
                        <ul
                            class="list"
                            v-infinite-scroll="load"
                            infinite-scroll-disabled="disabled">
                        <li v-for="i in articles.data">
                            <el-row class="art-item">
                                <el-card shadow="hover">
                                    <h5 class="clear-title"><router-link :to="{name:'art',params: {art_id:i.id}}" tag="span" class="art-title">{{i.title}}</router-link></h5>
                                    <el-row class="art-info d-flex align-items-center justify-content-start">
                                        <div class="art-time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                        <div class="d-flex align-items-center">
                                            <img class="tag" src="../../assets/tag.png" style="float:left;margin-right:0;margin-top: 5px;"/>
                                            <span style="float: left;">：</span>
                                            <div v-for="t in i.tag" style="float:left;margin-left: 2px;">
                                                <el-tag size="mini">{{t.name}}</el-tag>
                                            </div>
                                        </div>
                                    </el-row>
                                    <el-row class="art-body">
                                        <div class="side-img hidden-sm-and-down"><img class="art-banner" :src="img_src+i.id"></div>
                                        <div class="side-abstract">
                                            <div class="art-abstract">
                                                {{i.excerpt}}
                                            </div>
                                            <div class="art-more">
                                                <router-link :to="{name:'art',params: {art_id:i.id}}" tag="span">
                                                    <el-button plain>阅读全文</el-button>
                                                </router-link>
                                                <div class="view"><i class="el-icon-view"></i>{{i.view_count}}</div>
                                            </div>
                                        </div>
                                    </el-row>
                                </el-card>
                                <img class="star" src="../../assets/star.png" />
                            </el-row>
                        </li>
                    </ul>
                    <p v-if="loading">加载中...</p>
                    <p v-if="noMore">很高兴你翻到这里，但是真的没有了...</p>
                </div>
            </el-col>
            <el-col :span="6" class="hidden-sm-and-down" id="side">
                <div class="item">
                    <Tag></Tag>
                </div>
                <div class="item">
                    <Category></Category>
                </div>
                <div class="item">
                    <Friend></Friend>
                </div>
            </el-col>
            <Oauth></Oauth>
        </el-row>
    </div>
</template>
<script>
    import Friend from '../components/friend'
    import Tag from '../components/tag'
    import Oauth from '../components/Oauth'
    import Category from '../components/Category'
    import LFooter from '../components/L-footer'
    export default {
        data () {
            return {
                loading: false,
                infinite_box:{
                    height:'',
                    overflow: 'auto',
                },
                img_src:'https://s0.xinger.ink/acgimg/acgurl.php?',
            }
        },
        name: 'blog',
        components: {
            Friend,
            Tag,
            Oauth,
            Category,
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
        created(){
            this.$store.dispatch('clearArticles');
            this.$store.dispatch('loadArticles',{
                id:'',
            });
            var h = window.innerHeight-128;//可见区域高度
            this.infinite_box.height = h+'px';
        },
        methods: {
            load () {
                this.loading = true;
                setTimeout(() => {
                    this.$store.dispatch('loadArticles',{
                        id:'',
                        page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                    });
                    this.$watch(this.$store.getters.getArticlesLoadStatus, function () {
                        if(this.$store.getters.getArticlesLoadStatus() === 2) {
                            this.loading = false
                        }
                        if(this.$store.getters.getArticlesLoadStatus() === 3) {
                            this.$message.error('错了哦，懒加载文章失败了');
                        }
                    });
                }, 2000);
            }
        }
    }
</script>