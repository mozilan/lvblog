<style scoped lang="scss">
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
        <h5 class="bl-logo "><a id="index" href="/">LvBlog</a></h5>
        <el-menu :default-active="activeIndex" class="el-menu-blumer" mode="horizontal" @select="handleSelect">
            <el-menu-item index="1"><router-link :to="{ name:'index' }">首页</router-link></el-menu-item>
            <el-menu-item index="9"><router-link :to="{ name:'blog' }">博客</router-link></el-menu-item>
            <el-menu-item index="8-1"><router-link :to="{ name:'edit' }">写博客</router-link></el-menu-item>
            <el-menu-item index="6" @click="register" v-if="tokenStatus === '' ">注册</el-menu-item>
            <el-menu-item index="7" @click="login" v-if="tokenStatus === '' ">登录</el-menu-item>
            <el-submenu index="8" v-if="tokenStatus !== '' ">
                <template slot="title">
                    <el-image style="width: 40px; height: 40px;border:3px solid #409eff;border-radius:30px" :src="user.avatar"></el-image>
                </template>
                <el-menu-item index="9"><router-link :to="{ name:'blog.user',params:{'user':user.id ? user.id:''}}">我的博客</router-link></el-menu-item>
                <el-menu-item index="3"><router-link :to="{ name:'about' }">关于我</router-link></el-menu-item>
                <el-menu-item index="2"><router-link :to="{ name:'archive',params:{'user':user.id?user.id:1}}">我的归档</router-link></el-menu-item>
                <el-menu-item index="8-2"><router-link :to="{ name:'home' }">个人中心</router-link></el-menu-item>
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
                this.$router.push({name:'index'});
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
            }
        },
        created(){
            if(this.$store.getters.getUserLoadStatus() === 0){
                this.loadUser();
            }
    },
    }
</script>