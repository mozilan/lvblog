<template>
    <div class="art" :style="{'height':art_height}">
        <el-backtop target=".page-component__scroll .el-scrollbar__wrap"></el-backtop>
        <el-row class="main page-component__scroll" type="flex" justify="center">
            <el-col :span="16" class="el-scrollbar__wrap">
                <div id="artcle-info" :style="{'background-image':bg_url}">
                    <h2 class="text-center"><strong>{{article.data.title}}</strong></h2>
                    <!-- 描述：文章信息 -->
                    <div class="text-center timeAndView">
						<span class="article-time">
							<i class="el-icon-time"></i>
							发表于：<span>{{article.data.created_at}}</span>
						</span>
                        &#12288;|&#12288;
                        <span class="article-views">
							<i class="el-icon-view"></i>
							阅读量：<span>{{article.data.view_count}}</span>
						</span>
                    </div>
                    <p class="abstract">
                        {{article.data.excerpt}}
                    </p>
                </div>
                <hr />
                <div id="artcle-content"  class="content markdown-body" v-highlight v-html="article.data.body">
                </div>
                <div id="statement">
                    <div class="lv-item">作者：{{article.data.user.name}}</div>
                    <div class="lv-item">本文链接：
                        <a :href="url">{{url}}</a>
                    </div>
                    <div class="lv-item">注：本博客所有文章除特别声明外,转载请注明出处!</div>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import {mavonEditor} from 'mavon-editor';
    import marked from 'marked';
    import 'mavon-editor/dist/css/index.css';
    import 'highlight.js/styles/monokai-sublime.css';
    import 'github-markdown-css';
    export default {
        name: 'art',
        data () {
            return {
                url:'',
                bg_url:'https://s0.xinger.ink/acgimg/acgurl.php?',
                art_height:'',
            }
        },
        created() {
            this.$store.dispatch('loadArticle',{
                art_id : this.$route.params.art_id
            });
            this.url= window.location.href;
            this.bg_url = "url(" + this.bg_url + this.$route.params.art_id+")";

        },
        mounted(){+
            console.log(window.innerHeight);
            this.art_height = window.innerHeight-130+'px';
        },
        computed:{
            article(){
                if(this.$store.getters.getArticle.data !== undefined){
                    this.$store.getters.getArticle.data.body = marked(this.$store.getters.getArticle.data.body);
                }
                return this.$store.getters.getArticle;
            }
        }
    }
</script>

<style lang="scss" scoped>
    #artcle-info {
        padding: 20px;
        //background-image: url(https://s0.xinger.ink/acgimg/acgurl.php?678);
        margin-bottom: 40px;
        background-size: cover;
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
    .lv-item{
        margin-top: 6px;
    }
    .main{
        height: inherit;
    }
</style>