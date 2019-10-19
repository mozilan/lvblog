<template>
    <div class="art" :style="styles.art_style">
        <el-backtop target=".page-component__scroll .el-scrollbar__wrap"></el-backtop>
        <el-row class="main page-component__scroll" type="flex" justify="center">
            <el-col :xs="24" :sm="24" :md="16" :lg="16" class="el-scrollbar__wrap">
                <div id="artcle-info" :style="{'background-image':bg_url}" @load="handleLoad" v-loading="bg_loading">
                    <h2 class="text-center art-title">{{article.title}}</h2>
                    <!-- 描述：文章信息 -->
                    <div class="text-center timeAndView">
                        <router-link :to="{ name:'主页' ,params:{'user':article.user.data.id}}"><el-avatar :size="35" :src="article.user.data.avatar"></el-avatar></router-link>
                        ·
                        <span class="article-time">
							<i class="el-icon-time"></i>
							<span>{{article.created_at}}</span>
						</span>
                        ·
                        <span class="article-views">
							<i class="el-icon-view"></i>
							<span>{{article.view_count}}</span>次阅读
						</span>
                    </div>
                    <p class="abstract">
                        {{article.excerpt}}
                    </p>
                </div>
                <hr />
                <mavon-editor
                        class="markdown-body"
                        :value="article.body"
                        :subfield = "false"
                        :defaultOpen = "'preview'"
                        :toolbarsFlag = "false"
                        :editable="false"
                        :scrollStyle="true"
                        :ishljs = "true"
                ></mavon-editor>
                <!--<div id="artcle-content"  class="content markdown-body" v-highlight v-html="article.body">-->

                <div id="statement">
                    <div class="lv-article">
                        <router-link :to="{ name:'主页' ,params:{'user':article.user_id},query:{user:article.user_id}}">
                        作者：{{article.user.data.name}}
                        </router-link>
                    </div>
                    <div class="lv-article">本文链接：
                        <a :href="url">{{url}}</a>
                    </div>
                    <div class="lv-article">版权声明：本博客所有文章除特别声明外,转载请注明出处!</div>
                </div>
                <el-divider style="margin: 24px 0"></el-divider>
                <div class="comment">
                    <comment></comment>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import {mavonEditor} from 'mavon-editor';
    import 'mavon-editor/dist/css/index.css';
    import 'mavon-editor/dist/css/index.css';
    import 'highlight.js/styles/monokai-sublime.css';
    import comment from '../components/Art/comment'
    // import 'github-markdown-css';
    export default {
        name: 'art',
        data () {
            return {
                styles:{
                    art_style:{
                        height:''
                    }
                },
                url:'',
                bg_url:'https://s0.xinger.ink/acgimg/acgurl.php?',
                art_height:'',
                bg_loading:true,
                imgUrl: '',
            }
        },
        components:{
            mavonEditor,
            comment,
        },
        created() {
            this.$store.dispatch('patchUpdateViewCount',{
                art_id:this.$route.params.art_id
            });
            this.$store.dispatch('loadArticle',{
                art_id : this.$route.params.art_id
            });
            this.url= window.location.href;
            this.imgUrl = this.bg_url+ this.$route.params.art_id;
            this.bg_url = "url(" + this.bg_url + this.$route.params.art_id+")";
            this.styles.art_style.height = window.innerHeight-152+'px';
        },
        mounted(){
            this.art_height = window.innerHeight-130+'px';
            let bgImg = new Image();
            console.log(this.imgUrl);
            bgImg.src = this.imgUrl; // 获取背景图片的url
            bgImg.onerror = () => {
                console.log('img onerror')
            };
            bgImg.onload = () => { // 等背景图片加载成功后 去除loading
                this.bg_loading = false
            }
        },
        computed:{
            article(){
                return this.$store.getters.getArticle.data;
            }
        },
        methods:{
            handleLoad(e){
                console.log(e)
            }
        }
    }
</script>

<style lang="scss" scoped>
    .art{
        margin-top: 20px;
    }
    .main{
        padding-bottom: 30px;
    }
    #artcle-info {
        padding: 20px;
        //background-image: url(https://s0.xinger.ink/acgimg/acgurl.php?678);
        margin-bottom: 40px;
        background-size: cover;
        color: #ffffff;
    }

    #artcle-info .abstract {
        color: #ffffff;
        border-left: 3px solid #F56C6C;
        padding: 10px;
        background-color: rgba(126, 129, 135, 0.3);
    }

    #artcle-info .timeAndView {
        padding: 20px 20px 20px 0;
        line-height: 30px;
        font-size: 16px;
        color: #ffffff;
    }
    #artcle-info .text-center{
        display: flex;
        justify-content: center;
        align-articles: center;
    }
    pre.has {
        color: #ffffff;
        background-color: rgba(0, 0, 0, 0.8);
    }

    img.has {
        width: 100%;
    }

    #statement {
        font-size: 14px;
        margin-top: 20px;
        border-left: 3px solid #F56C6C;
        padding: 5px;
        background-color: #EBEEF5;
    }
    .lv-article{
        margin-top: 6px;
    }
    .main{
        height: inherit;
    }

    @media only screen and (max-width: 683px){
        .abstract{
            display: none;
        }
    }
</style>