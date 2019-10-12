<template>
    <div class="contact">
        <el-col class="tag">
            <el-card class="box-card">
                <div slot="header" class="d-flex align-items-center">
                    <i class="el-icon-folder-opened"></i>
                    <span>联系我们</span>
                </div>
                <div class="lv-clear-both"></div>
                <div class="item">
                    <el-col :span="24">
                        <el-tooltip class="item" effect="dark" content="点我放大哦～" placement="left-start">
                            <el-col :lg="11" :md="11" :sm="11" :xs="11" class="social">
                                <div class="lv-clear-both"></div>
                                <el-image
                                        style="width: 100%; height:100px"
                                        src="https://mozilan.geekadpt.cn/img/custom/wechat_pub.png"
                                        fit="contain"
                                        :preview-src-list="srcList">
                                >
                                </el-image>
                            </el-col>
                        </el-tooltip>
                        <el-col :lg="2" :md="2" :sm="2" :xs="2" class="middle">
                            你猜我是谁？
                        </el-col>
                        <el-col :lg="11" :md="11" :sm="11" :xs="11" class="social">
                            <div class="lv-clear-both"></div>
                            <el-image
                                    style="width: 100%; height: 100px"
                                    src="https://mozilan.geekadpt.cn//img/custom/wechat2.png"
                                    fit="contain"
                                    :preview-src-list="srcList">
                            >
                            </el-image>
                        </el-col>
                    </el-col>
                </div>
                <el-col :span="24" class="copyright">
                    <i class="el-icon-caret-right"></i>
					© 2019-2022<a href="https://www.mozilan.com">·蓝默空间·版权所有</a>
                   Powered by <span><a href="https://mozilan.com">Mozilan</a></span>
                </el-col>
                <el-col :span="24" class="copyright run">
                    <i class="el-icon-loading"></i>
                    本站已稳定运行23天4时36分22秒
                </el-col>
                <el-col :span="24" class="copyright run">
                    <i class="el-icon-coordinate"></i>
                    <a href="http://www.miit.gov.cn/">吉ICP备16007022号-5</a>
                </el-col>
            </el-card>
        </el-col>
    </div>
</template>

<script>
    export default {
        name: 'category',
        data(){
            return{
                srcList: [
                    'https://mozilan.geekadpt.cn/img/custom/wechat_pub.png',
                    'https://mozilan.geekadpt.cn/img/custom/wechat2.png'
                ]
            }
        },
    }
</script>

<style scoped lang="scss">
    .box-card{
        padding-bottom: 20px;
    }
    .box-card .item:hover {
        color: #409EFF;
        cursor: pointer;
    }
    .box-card .social{
        text-align: center;
        box-shadow: 2px 2px 2px 2px #f3926b;
    }
    .box-card .social img{
        border: #f3926b 2px solid;
    }
    .box-card .middle{
        visibility:hidden;
    }
    .card-icon {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }
    .copyright {
        text-align: center;
        font-size: 14px;
    }
    .run{
        margin-top: 2px;
    }
    .category-item {
        margin-right: 10px;
    }
    @media only screen and (max-width: 683px){
        .copyright{
            margin-top: 10px;
        }
    }
</style>