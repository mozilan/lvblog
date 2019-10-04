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
    ul{
        list-style:none;
        margin:0; padding:0;
    }
</style>

<template>
    <div class="blog">
        <el-row id="artList" type="flex" justify="space-around">
            <el-col :span="16">
                <div class="infinite-list-wrapper" style="overflow:auto">
                    <ul
                            class="list"
                            v-infinite-scroll="load"
                            infinite-scroll-disabled="disabled">
                        <div v-for="i in articles.data">
                            <el-row class="art-item">
                                <el-card shadow="hover">
                                    <h5><router-link to="/index" tag="span" class="art-title">{{i.title}}</router-link></h5>
                                    <el-row class="art-info d-flex align-items-center justify-content-start">
                                        <div class="art-time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                        <div class="d-flex align-items-center" >
                                            <img class="tag" src="../../assets/tag.png" style="float:left"/>：
                                            <div v-for="t in i.tag" style="float:left">
                                                <el-tag size="mini">{{t.name}}</el-tag>
                                            </div>
                                        </div>
                                    </el-row>
                                    <el-row class="art-body">
                                        <div class="side-img hidden-sm-and-down"><img class="art-banner" src="../../assets/laravel.png"></div>
                                        <div class="side-abstract">
                                            <div class="art-abstract">
                                                {{i.excerpt}}
                                            </div>
                                            <div class="art-more">
                                                <router-link to="/index" tag="span">
                                                    <el-button plain>阅读全文</el-button>
                                                </router-link>
                                                <div class="view"><i class="el-icon-view"></i>{{i.view_count}}</div>
                                            </div>
                                        </div>
                                    </el-row>
                                </el-card>
                                <img class="star" src="../../assets/star.png" />
                            </el-row>
                        </div>
                    </ul>
                    <p v-if="loading">加载中...</p>
                    <p v-if="noMore">没有更多了</p>
                </div>
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

    export default {
        data () {
            return {
                blogs:[],
                meta:'',
                count: 10,
                loading: false
            }
        },
        name: 'blog',
        components: {
            Friend,
            Tag,
            Oauth,
            Category
        },
        computed:{
            noMore () {
                return this.$store.getters.getArticles.meta.pagination.current_page >= this.$store.getters.getArticles.meta.pagination.total_pages;                // return this.count >= 20
            },
            disabled () {
                return this.loading || this.noMore
            },
            articles(){
                return this.$store.getters.getArticles;
            }
        },
        watch:{
            'blogs':'show'
        },
        created(){
            this.$store.dispatch('loadArticles',{
                id:'',
            });
            this.blogs = this.$store.getters.getArticles;
        },
        methods: {
            show(){
              // console.log(this.blogs);
            },
            load () {
                console.log(this.$store.getters.getArticles.meta.pagination.current_page);
                console.log(this.$store.getters.getArticles.meta.pagination.total_pages);
                this.loading = true;
                this.$store.dispatch('loadArticles',{
                    id:'',
                    page: ++this.$store.getters.getArticles.meta.pagination.current_page,
                });
                setTimeout(() => {
                    this.blogs += this.$store.getters.getArticles;
                    this.loading = false
                }, 2000)
            }
        }
    }
</script>