<style scoped lang="scss">
    @import "../../../sass/jside-menu";
    @import "../../../sass/jside-skins";
    .lv-logo{
        float:left;
        line-height: 60px;
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
    .el-menu-blumer{
        float:right;
    }
    .row{
        display: table-cell;
    }
    .lv-jside{
        display: none;
    }

</style>
<style lang="scss">
    .el-menu-item{
        padding: 0 20px;
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
    <div class="header">
        <el-row type="flex" class="lv-header" justify="space-between">
            <h5 class="lv-logo "><a id="index" href="/">{{configs.title}}</a></h5>
            <el-menu :default-active="activeIndex" class="el-menu-blumer" mode="horizontal" @select="handleSelect">
                <el-menu-item index="1"><router-link :to="{ name:'首页' }"><i class="el-icon-s-home"></i>首页</router-link></el-menu-item>
                <el-menu-item index="9"><router-link :to="{ name:'文章' }"><i class="el-icon-notebook-2"></i>博客园</router-link></el-menu-item>
                <el-menu-item index="2"><router-link :to="{ name:'写作',query:{user:user.id} }"><i class="el-icon-edit"></i>写博客</router-link></el-menu-item>
                <el-menu-item index="6" @click="register" v-if="tokenStatus === '' " icon="el-icon-promotion"><i class="el-icon-circle-plus-outline"></i>注册</el-menu-item>
                <el-menu-item index="7" @click="login" v-if="tokenStatus === '' " icon="el-icon-user"><i class="el-icon-user"></i>登录</el-menu-item>
                <el-submenu index="8" v-if="tokenStatus !== '' ">
                    <template slot="title">
                        <el-avatar v-if="!user.avatar" style="width: 40px; height: 40px;border:3px solid #409eff;border-radius:30px">{{user.name}}</el-avatar>
                        <el-image v-if="user.avatar" style="width: 40px; height: 40px;border:3px solid #409eff;border-radius:30px" :src="user.avatar"></el-image>
                    </template>
                    <el-menu-item index="8-1"><router-link :to="{ name:'我的文章',params:{'owner':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-tickets"></i>我的博客</router-link></el-menu-item>
                    <el-menu-item index="8-2"><router-link :to="{ name:'私有文章',params:{'private':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-lock"></i>私有文章</router-link></el-menu-item>
                    <el-menu-item index="8-3"><router-link :to="{ name:'草稿箱',params:{'draft':user.id ? user.id:''},query:{user:user.id}}"><i class="el-icon-document"></i>草稿箱</router-link></el-menu-item>
                    <!--<el-menu-item index="8-7"><router-link :to="{ name:'关于我' }">关于我</router-link></el-menu-item>-->
                    <el-menu-item index="8-4"><router-link :to="{ name:'归档',params:{'user':user.id?user.id:1}}"><i class="el-icon-notebook-1"></i>我的归档</router-link></el-menu-item>
                    <el-menu-item index="8-5"><router-link :to="{ name:'主页' ,params:{'user':user.id?user.id:1},query:{user:user.id}}"><i class="el-icon-setting"></i>个人中心</router-link></el-menu-item>
                    <el-menu-item index="8-6" @click="logout()"><i class="el-icon-right"></i>退出登录</el-menu-item>
                </el-submenu>
            </el-menu>
        </el-row>
        <div class="lv-jside">
            <div class="menubar sticky default-skin">
                <div>
                    <el-button class="menu-trigger left" icon="el-icon-s-grid"> </el-button>
                </div>
                <div class="logo" title="Your Logo Goes Here">
                    <a href="#1"><img src="file:///home/wunian/PhpstormProjects/opt/%E4%BE%A7%E8%BE%B9%E6%A0%8F/image/jside-menu.png" alt="jSide Menu"> </a>
                </div>
            </div>
            <div class="menu-head">
                  <span class="layer">
                    <div class="el-col-24">
                        <div class="row for-pic">
                           <div class="profile-pic">
                           <img src="https://fp1.fghrsh.net/2019/02/14/b0db15fe7ed1cf69fdcc7a86898389a4.jpg!q90.jpeg" alt="Asif Mughal" />
                                 </div>
                          </div>
                                 <div class="row for-name">
                           <h3 title="User Name"> Asif Mughal </h3>
                                <span class="tagline"> Tagline text goes here</span>
                                  </div>
                    </div> <!--//col-->
                  </span>
                <div class="lv-clear-both"></div>
                <el-divider></el-divider>
            </div>
            <div class="menu-container">
                <ul class="menu-items">
                    <li><span class="item-icon"><i class="zmdi zmdi-android"></i></span> <a href="#1"> Main item one </a></li>
                    <li> <span class="item-icon"> <i class="zmdi zmdi-apple"></i> </span> <a href="#1"> Main item two </a></li>
                    <li class="has-sub"> <span class="item-icon"> <i class="zmdi zmdi-windows"></i> </span> <span class="dropdown-heading"> Item three with dropdown </span>
                        <ul>
                            <li> <a href="#2">dropdown sub item 1 </a> </li>
                            <li> <a href="#2"> dropdown sub item 2 </a> </li>
                            <li> <a href="#2"> dropdown sub item 3 </a> </li>
                            ...
                        </ul>
                    </li>
                    <li class="has-sub"> <span class="item-icon"> <i class="zmdi zmdi-devices"></i> </span> <span class="dropdown-heading"> Item four with dropdown </span>
                        <ul>
                            <li> <a href="#2">sub item 1 </a> </li>
                            <li> <a href="#2">sub item 2 </a> </li>
                            <li> <a href="#2">sub item 3 </a> </li>
                            ...
                        </ul>
                    </li>
                    <li> <span class="item-icon"> <i class="zmdi zmdi-keyboard"></i> </span> <a href="#1"> Main item four </a></li>
                    <li> <span class="item-icon"> <i class="zmdi zmdi-dock"></i> </span> <a href="#1"> Main item five </a></li>
                </ul>
            </div>
            <div class="dim-overlay"></div>
        </div>
    </div>
</template>
<script>
    import '../../utils/jquery.jside.menu'
    import {EventBus} from '../../event-bus.js';
    export default {
        name:'Navigation',
        data() {
            return {
                activeIndex: '1',
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
                this.$store.dispatch('logout');
                this.$router.push({name:'首页'});
            },
            loadUser(){
                this.$store.dispatch('loadUser')
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
                return this.$store.getters.getConfigs.data;
            }
        },
        created(){
            if(this.$store.getters.getUserLoadStatus() === 0){
                this.loadUser();
            }
        },
        mounted() {
            $(".menu-container").jSideMenu({
                jSidePosition: "position-left",
                jSideSticky: false,
                jSideSkin:"endless-river",
            });
        }
    }
</script>