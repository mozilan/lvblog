<style lang="scss">
    .bl-logo{
        float:left;
    }
    .bl-logo:hover{
        background-color:#ffffff;
    }
    .bl-logo a{
        font-size:16px;
        color:#909399;
        text-decoration: none;
    }
    .bl-logo a:hover{
        color:#303133;
    }
    .el-menu-blumer{
        float:right;
    }
</style>
<template>
    <div class="bl-header">
        <h5 class="bl-logo "><a href="#">LvBlog</a></h5>
        <el-menu :default-active="activeIndex" class="el-menu-blumer" mode="horizontal" @select="handleSelect">
            <el-menu-item index="1"><a href="/">首页</a></el-menu-item>
            <el-menu-item index="2"><a href="/">编程</a></el-menu-item>
            <el-menu-item index="3"><a href="/">运维</a></el-menu-item>
            <el-menu-item index="4"><a href="/">算法</a></el-menu-item>
            <el-menu-item index="5"><a href="/">分享</a></el-menu-item>
            <el-menu-item index="6" @click="register" v-if="tokenStatus == '' ">注册</el-menu-item>
            <el-menu-item index="7" @click="login" v-if="tokenStatus == '' ">登录</el-menu-item>
            <el-submenu index="8" v-if="tokenStatus != '' ">
                <template slot="title">
                    <el-image style="width: 40px; height: 40px;border:3px solid #409eff;border-radius:30px" :src="user.avatar">
                    </el-image>
                </template>
                <el-menu-item index="8-1">写博客</el-menu-item>
                <el-menu-item index="8-2">个人中心</el-menu-item>
                <el-menu-item index="8-3" @click="logout()">退出登录</el-menu-item>
            </el-submenu>
        </el-menu>
    </div>
</template>
<script>
    import {EventBus} from '../../event-bus.js';
    export default {
        name:'Navigation',
        data() {
            return {
                activeIndex: '1',
                avatar_url: "https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg",
            };
        },
        methods: {
            showLoginForm(){
                if(this.$route.query.login != null){
                    this.login();
                }
            },
            register() {
                EventBus.$emit('prompt-register');
            },
            login() {
                EventBus.$emit('prompt-login');
            },
            handleSelect(key, keyPath) {
                // console.log(key, keyPath);
            },
            logout(){

            }
        },
        computed:{
            tokenStatus(){
                return this.$store.getters.getLoginToken;
            },
            user(){
                return this.$store.getters.getUser;
            }
        },
        created:function () {
            if(localStorage.getItem('Authorization') != null && this.$store.getters.getUserLoadStatus() != 2){
                this.$store.dispatch('loadUser');
            }
            this.showLoginForm();
        },
        watch:{
            '$route':'showLoginForm'
        },
    }
</script>