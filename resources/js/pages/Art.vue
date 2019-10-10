<template>
    <div class="art" :style="{'height':art_height}">
        <el-backtop target=".page-component__scroll .el-scrollbar__wrap"></el-backtop>
        <el-row class="main page-component__scroll" type="flex" justify="center">
            <el-col :xs="24" :sm="24" :md="20" :lg="20" class="el-scrollbar__wrap">
                <div id="artcle-info" :style="{'background-image':bg_url}">
                    <h2 class="text-center art-title">{{article.data.title}}</h2>
                    <!-- 描述：文章信息 -->
                    <div class="text-center timeAndView">
                        <el-avatar :size="35" :src="article.data.user.avatar"></el-avatar>
                        ·
                        <span class="article-time">
							<i class="el-icon-time"></i>
							<span>{{article.data.created_at}}</span>
						</span>
                        ·
                        <span class="article-views">
							<i class="el-icon-view"></i>
							<span>{{article.data.view_count}}</span>次阅读
						</span>
                    </div>
                    <p class="abstract">
                        {{article.data.excerpt}}
                    </p>
                </div>
                <hr />
                <mavon-editor
                        class="markdown-body"
                        :value="article.data.body"
                        :subfield = "false"
                        :defaultOpen = "'preview'"
                        :toolbarsFlag = "false"
                        :editable="false"
                        :scrollStyle="true"
                        :ishljs = "true"
                ></mavon-editor>
                <!--<div id="artcle-content"  class="content markdown-body" v-highlight v-html="article.data.body">-->

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
    import 'mavon-editor/dist/css/index.css';
    import 'mavon-editor/dist/css/index.css';
    import 'highlight.js/styles/monokai-sublime.css';
    // import 'github-markdown-css';
    export default {
        name: 'art',
        data () {
            return {
                url:'',
                bg_url:'https://s0.xinger.ink/acgimg/acgurl.php?',
                art_height:'',
            }
        },
        components:{
          mavonEditor
        },
        created() {
            this.$store.dispatch('loadArticle',{
                art_id : this.$route.params.art_id
            });
            this.url= window.location.href;
            this.bg_url = "url(" + this.bg_url + this.$route.params.art_id+")";

        },
        mounted(){
            console.log(this.$refs.md.d_render);
            console.log(window.innerHeight);
            this.art_height = window.innerHeight-130+'px';
        },
        computed:{
            article(){
                return this.$store.getters.getArticle;
            }
        }
    }
</script>

<style lang="scss" scoped>
    .art{
        margin-top: 20px;
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
        align-items: center;
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

    @media only screen and (max-width: 683px){
        .abstract{
            display: none;
        }
    }
</style>