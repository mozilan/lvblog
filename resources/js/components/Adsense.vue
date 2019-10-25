<template>
    <el-col class="tag">
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <i class="el-icon-magic-stick"></i>
                <span>广告位</span>
            </div>
            <div class="text item">
                <div class="ui card responsive" style="background-color: transparent;padding: 0px;    margin-top: 2px;">
                    <div class="content" style="padding: 0px;">
                        <el-popover
                                placement="top-start"
                                title="Hexo静态博客"
                                width="200"
                                trigger="hover"
                                content="我的博客-蓝默空间">
                            <a slot="reference" class="" href="https://mozilan.com" target="_blank" style="margin-top: 10px;display: block;border-top: 1px solid #d3e0e9;border-bottom: 1px solid #d3e0e9;">
                                <img src="https://mozilan.geekadpt.cn/2019-10-09%2023-00-00%20%E7%9A%84%E5%B1%8F%E5%B9%95%E6%88%AA%E5%9B%BE.png" class="ui popover" data-variation="inverted" data-content="Composer 镜像赞助商：又拍云" width="100%">
                            </a>
                        </el-popover>
                        <el-tooltip class="item" effect="dark" content="Laravel-China 社区" placement="left">
                            <a class="" href="https://learnku.com" target="_blank" style="display: block;border-top: 1px solid #d3e0e9;border-bottom: 1px solid #d3e0e9;">
                                <img src="https://mozilan.geekadpt.cn/2019-10-09%2023-00-00%20%E7%9A%84%E5%B1%8F%E5%B9%95%E6%88%AA%E5%9B%BE.png" class="ui popover" data-variation="inverted" data-content="" width="100%">
                            </a>
                        </el-tooltip>
                    </div>
                </div>
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

<style scoped lang="scss">
    .box-card .item:hover {
        color: #409EFF;
        cursor: pointer;
    }
    .item{
        float: left;
    }
    .clear{
        clear: both;
    }
</style>