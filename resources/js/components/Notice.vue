<template>
    <el-col class="tag">
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <i class="el-icon-data-board"></i>
                <span>LvBlog-小白板</span>
            </div>
            <div class="text">
                {{configs.notice}}
                <!--LvBlog 是我们应用的名称，“L” 是 Laravel 的缩写 , “v” 是 Vue 的缩写，本项目是基于 Laravel 5.8 + Vue 2 开发， 实现了 API 驱动和前后端分离，支持响应式的单页面博客类 WEB 应用。-->
            </div>
            <div class="clear"></div>
        </el-card>
    </el-col>
</template>

<script>
    export default {
        name: 'tag',
        computed:{
            configs(){
                let configs = this.$store.getters.getConfigs;
                let hasMessage =  localStorage.getItem('Message');
                let hasUrgentMessage = localStorage.getItem('UrgentMessage');
                if(configs.message && configs.message != hasMessage){
                    localStorage.setItem('Message', configs.message);
                    this.$notify({
                        title: '你好,',
                        message: configs.message,
                        type: 'info',
                        duration:6000
                    });
                }
                if(configs.urgent_message && configs.urgent_message != hasUrgentMessage) {
                    localStorage.setItem('UrgentMessage', configs.urgent_message);
                    this.$notify({
                        title: '紧急通知',
                        message: configs.urgent_message,
                        type: 'warning',
                        offset: 100,
                        dangerouslyUseHTMLString: true,
                        duration:0
                    });
                }
                return this.$store.getters.getConfigs;
            }
        }
    }
</script>

<style scoped lang="scss">
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