<template>
    <el-col class="tag">
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <i class="el-icon-data-board"></i>
                <span>LvBlog-极简博客发布平台</span>
            </div>
            <div class="text">
                LvBlog 是我们应用的名称，“L” 是 Laravel 的缩写 , “v” 是 Vue 的缩写，本项目是基于 Laravel 5.8 + Vue 2 开发， 实现了 API 驱动和前后端分离，支持响应式的单页面博客类 WEB 应用。
            </div>
            <div class="clear"></div>
        </el-card>
    </el-col>
</template>

<script>
    export default {
        name: 'tag',
        data () {
            return {
            }
        },
    }
</script>

<style scoped>
    .box-card .item:hover {
        color: #409EFF;
        cursor: pointer;
    }
    .text{
        font-size: 14px;
    }
    .clear{
        clear: both;
    }
</style>