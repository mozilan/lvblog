<style scoped lang="scss">
    @import "../../../sass/jside-menu";
    @import "../../../sass/jside-skins";
    button.lv-trigger{
        position: fixed;
    }
    .header{
        position: fixed;
        width: 100%;
        left: 0;
        top: 0;
        z-index: 900;
        background-color: white;
    }
    .lv-header{
        display: block;
    }
    .lv-logo{
        float:left;
        line-height: 60px;
        margin-left: 30px;
    }
    .lv-logo:hover{
        background-color:#ffffff;
    }
    .lv-logo a{
        font-size:16px;
        color:#909399;
        text-decoration: none;
    }
    .lv-logo a:hover{
        color:#303133;
    }
    .lv-logo img{
        width: 60px;
        height: 60px;
    }
    .logo img{
        width: 50px;
        height: 50px;
        margin-top: 0;
    }
    .el-menu-blumer{
        list-style-type: none;
        margin: 0;
        padding: 0;
        position: absolute;
        right: 30px;
        height: 60px;
        line-height: 60px;
    }
    .lv-search-query{
        max-width: 270px;
        padding: 0 10px;
        vertical-align: bottom;
    }
    .lv-search-input{
        margin: 7px 0;
        vertical-align: bottom;
    }
    .lv-search-input > input{
        border-radius: 500rem;
        height: 60px;
        line-height: 30px;
        box-sizing: border-box;
        /*padding: 0 15px 0 30px;*/
        border: 1px solid #c0c4cc;
        color: #273849;
        outline: none;
        margin-right: 10px;
        transition: border-color 0.2s ease;
        /*background: #fff url("../images/search.png") 8px 5px no-repeat;*/
        background-size: auto;
        background-size: 20px;
        vertical-align: bottom;
    }
    .lv-search-input > span{
        padding-top: 18px;
    }
    .row{
        display: table-cell;
    }
    .lv-jside{
        display: none;
    }
    .lv-jside .profile-pic .el-image{
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.01);
        object-fit: cover;
    }
    /*.lv-jside .dim-overlay{*/
        /*z-index: 1400;*/
    /*}*/
    .tagline{
        font-size: 14px;
    }
    .for-name{
        max-width: 200px;
    }
    .lv-pic{
        padding: 20px 0;
    }
    .menubar{
        z-index: 1400;
    }
    .menu-head .layer{
        background: none;
    }
    .up-z-index{
        z-index: 19981022;
    }
    @media only screen and (max-width: 683px) {
        .lv-header{
            display: none;
        }
    }
</style>
<style lang="scss">
    .lv-search-input .el-input__inner{
        height: 40px;
    }
    .el-menu-item{
        padding: 0 20px;
    }
    .lv-jside .menu-container{
        z-index: 19981022;
    }
    button.lv-trigger{
        -webkit-appearance: none;
        border: 0;
        outline: 0;
        background: transparent;
        padding: 15px;
        color: var(--skin-color);
    }
    button.lv-trigger:hover{
        background-color: transparent;
    }
    .el-menu.el-menu--horizontal{
        border: none;
    }
    @media only screen and (max-width: 683px){
        .lv-header{
            display: none;
        }
        .lv-jside{
            display: block!important;
        }
        .el-header{
            padding: 0;
        }
        .el-menu-item{
            padding: 0 10px;
        }
    }
</style>
<template>
    <el-header class="header">
        <div class = lv-header>
            <el-row type="flex" justify="space-between">
                <h5 class="lv-logo" title="蓝默空间"><a id="index" href="/"><img src="https://mozilan.geekadpt.cn/www/img/logo.png" alt="LvBlog logo"></a></h5>
                <el-menu :default-active="activeIndex" class="el-menu-blumer" mode="horizontal" @select="handleSelect">
                    <el-menu-item class="lv-search-query">
                        <el-input
                                class="lv-search-input"
                                @keyup.enter.native="searchArticles"
                                placeholder="搜文章"
                                prefix-icon="el-icon-search"
                                v-model="searchContent">
                        </el-input>
                    </el-menu-item>
                    <el-menu-item index="1"><router-link :to="{ name:'首页' }"><i class="el-icon-s-home"></i>首页</router-link></el-menu-item>
                    <el-menu-item index="2"><router-link :to="{ name:'博客园' }"><i class="el-icon-eleme"></i>博客园</router-link></el-menu-item>
                    <el-menu-item index="3"><router-link :to="{ name:'写作',query:{user:user.id} }"><i class="el-icon-edit"></i>写博客</router-link></el-menu-item>
                    <el-menu-item index="4" @click="register" v-if="!tokenStatus" icon="el-icon-promotion"><i class="el-icon-circle-plus-outline"></i>注册</el-menu-item>
                    <el-menu-item index="5" @click="login" v-if="!tokenStatus" icon="el-icon-user"><i class="el-icon-user"></i>登录</el-menu-item>
                    <el-submenu index="6" v-if="tokenStatus">
                        <template slot="title">
                            <el-image v-if="user.avatar" class="lv-avatar" :src="user.avatar"></el-image>
                        </template>
                        <el-menu-item index="6-1"><router-link :to="{ name:'我的文章',params:{'owner':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-tickets"></i>我的博客</router-link></el-menu-item>
                        <el-menu-item index="6-2"><router-link :to="{ name:'私有文章',params:{'private':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-lock"></i>私有文章</router-link></el-menu-item>
                        <el-menu-item index="6-3"><router-link :to="{ name:'草稿箱',params:{'draft':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-document"></i>草稿箱</router-link></el-menu-item>
                        <!--<el-menu-item index="8-7"><router-link :to="{ name:'关于我' }">关于我</router-link></el-menu-item>-->
                        <el-menu-item index="6-4"><router-link :to="{ name:'归档',params:{'user':user.id?user.id:1}}"><i class="el-icon-notebook-1"></i>我的归档</router-link></el-menu-item>
                        <el-menu-item index="6-5"><router-link :to="{ name:'主页' ,params:{'user':user.id?user.id:1},query:{user:user.id}}"><i class="el-icon-setting"></i>个人中心</router-link></el-menu-item>
                        <el-menu-item index="6-6" @click="logout()"><i class="el-icon-right"></i>退出登录</el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-row>
        </div>
        <div class="lv-jside">
            <div :class="menu_bar_class" >
                <div>
                    <el-button class="left lv-trigger" icon="el-icon-s-grid"> </el-button>
                </div>
                <div class="logo" title="蓝默空间">
                    <a href="#"><img src="https://mozilan.geekadpt.cn/www/img/logo.png" alt="LvBlog Menu"/> </a>
                </div>
            </div>
            <div :class="menu_head_class" style="z-index: 19981022" @click="toggleStyle">
                  <span class="layer">
                    <div class="el-col-24 lv-pic">
                        <div class="row for-pic">
                           <div class="profile-pic">
                               <el-image v-if="user" :src="user.avatar" :alt="user.name">
                                    <div slot="placeholder" class="image-slot">
                                         <img class="art-banner" src="https://mozilan.geekadpt.cn/img/loader/trans.ajax-spinner-preloader.svg">
                                    </div>
                               </el-image>
                               <el-image v-if="!user" src="https://mozilan.geekadpt.cn/img/custom/avatar.jpg"></el-image>
                           </div>
                          </div>
                                 <div class="row for-name" v-if="user">
                                       <h3 :title="user.name"> {{user.name}} </h3>
                                            <span class="tagline"> {{user.introduction}}</span>
                                  </div>
                                <div class="row for-name" v-if="!user">
                                       <h3 :title="user.name">未登陆</h3>
                                            <span class="tagline">把酒祝东风,且共从容.</span>
                                </div>
                    </div> <!--//col-->
                  </span>
            </div>
            <div :class="menu_container_class">
                <el-divider></el-divider>
                <ul class="menu-items">
                    <li @click="toggle()"><span class="item-icon"><i class="el-icon-edit"></i></span> <router-link :to="{ name:'写作',query:{user:user.id} }">写博客</router-link></li>
                    <li @click="toggle()"><span class="item-icon"><i class="el-icon-eleme"></i></span> <router-link :to="{ name:'博客园',query:{user:user.id} }">博客园</router-link></li>
                    <li class="has-sub"> <span class="item-icon"> <i class="el-icon-more"></i></span> <span class="dropdown-heading">站内搜索</span>
                        <ul>
                            <li class="lv-search-query">
                                <el-input
                                        class="lv-search-input"
                                        @keyup.enter.native="searchArticles"
                                        placeholder="搜文章"
                                        prefix-icon="el-icon-search"
                                        v-model="searchContent">
                                </el-input>
                            </li>
                        </ul>

                    </li>
                    <li v-if="!user" @click="toggle()"><span class="item-icon"><i class="el-icon-user"></i></span> <router-link :to="{ name:'写作',query:{user:user.id} }">登陆/注册</router-link></li>
                    <li class="has-sub" v-if="tokenStatus"> <span class="item-icon"> <i class="el-icon-more"></i></span> <span class="dropdown-heading"> 文章管理 </span>
                        <ul>
                            <li @click="toggle()"><span class="item-icon"><i class="el-icon-tickets"></i></span> <router-link :to="{ name:'我的文章',params:{'owner':user.id ? user.id:''},query:{user:user.id}}">我的博客</router-link> </li>
                            <li @click="toggle()"><span class="item-icon"><i class="el-icon-lock"></i></span> <router-link :to="{ name:'私有文章',params:{'private':user.id ? user.id:''},query:{user:user.id}}">私有文章</router-link> </li>
                            <li @click="toggle()"><span class="item-icon"><i class="el-icon-document"></i></span> <router-link :to="{ name:'草稿箱',params:{'draft':user.id ? user.id:''},query:{user:user.id}}">草稿箱</router-link> </li>
                            ...
                        </ul>
                    </li>
                    <li @click="toggle()" v-if="tokenStatus"> <span class="item-icon"> <i class="el-icon-notebook-1"></i> </span>  <router-link :to="{ name:'归档',params:{'user':user.id?user.id:1}}">我的归档</router-link></li>
                    <li @click="toggle()" v-if="tokenStatus"> <span class="item-icon"> <i class="el-icon-setting"></i> </span> <router-link :to="{ name:'主页' ,params:{'user':user.id?user.id:1},query:{user:user.id}}">个人中心</router-link></li>
                    <li @click="logout()" v-if="tokenStatus"> <span class="item-icon"> <i class="el-icon-right"></i> </span><router-link :to="{name:'首页'}">退出登陆</router-link></li>
                </ul>
            </div>
            <!--<div class="dim-overlay"></div>-->
        </div>
        <div class="lv-clear-both"></div>
    </el-header>
</template>
<script>
    import '../../utils/jquery.jside.menu'
    import {EventBus} from '../../event-bus.js';
    export default {
        name:'Navigation',
        data() {
            return {
                styleArr:['flickr','fb-messenger','moonlit','park-life','d2f','steel-man','amethyst','between-clouds',
                    'crazy-orange','endless-river','wood','greenish','gol-b','pink','black','orange'
                    ,'orange','bnp','blue','green','red','default-skin'
                ],
                menu_bar_class : 'menubar sticky default-skin',
                menu_head_class : 'menu-head position-left',
                menu_container_class :'menu-container position-left',

                activeIndex: '1',
                searchContent:'',
            };
        },
        methods: {
            openMessage: function (title, type) {
                this.$message({
                    message: title,
                    type: type
                });
            },
            register() {
                EventBus.$emit('prompt-register');
            },
            login(){
                EventBus.$emit('prompt-login');
            },
            handleSelect(key, keyPath) {
                // console.log(key, keyPath);
            },
            logout(){
                $(".lv-trigger").click();
                this.$store.dispatch('logout');
                this.$router.push({name:'首页'});
            },
            loadUser(){
                this.$store.dispatch('loadUser')
            },
            toggle(){
                $(window).click();
            },
            toggleStyle(){
                let style = '';
                style = this.styleArr[Math.floor((Math.random()*this.styleArr.length))];
                localStorage.setItem('JsideStyle',style);
                this.menu_bar_class = "menubar stiky default-skin " + style;
                this.menu_head_class = "menu-head position-left open " +style;
                this.menu_container_class = "menu-container position-left open " +style;
            },
            searchArticles(){
                this.toggle();
                if(this.searchContent){
                    let content = this.searchContent;
                    this.searchContent = '';
                    this.$router.push({name:'查找文章',params: {search:1},query: {search:content}});
                }else{
                    this.$message.warning('查找内容不能为空');
                }
            }
        },
        computed:{
            tokenStatus(){
                return this.$store.getters.getLoginToken;
            },
            user(){
                return this.$store.getters.getUser;
            },
            configs() {
                return this.$store.getters.getConfigs;
            }
        },
        created(){
            if(this.$store.getters.getUserLoadStatus() === 0){
                this.loadUser();
            }
        },
        mounted(){
            let style = localStorage.getItem('JsideStyle');
            $(".menu-container").jSideMenu({
                jSidePosition: "position-left",
                jSideSticky: true,
                jSideSkin: style ? style: "default-skin",
            });
            //更新导航click
            switch (this.$route.name) {
                case '博客园' : this.activeIndex = '2';break;
                case '写作' : this.activeIndex = '3';break;
                default : this.activeIndex = '1';
            }
        }
    }
</script>