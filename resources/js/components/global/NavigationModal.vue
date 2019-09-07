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
            <el-menu-item index="8" @click="signin">注册
            </el-menu-item>
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
            signin() {
                EventBus.$emit('prompt-signin');
            },
            handleSelect(key, keyPath) {
                // console.log(key, keyPath);
            },
        },
    }
</script>