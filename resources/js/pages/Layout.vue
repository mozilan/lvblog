<style type="">
    #chang-jian-ye-mian-bu-ju + .demo-container .el-footer, #chang-jian-ye-mian-bu-ju + .demo-container .el-header {
        text-align: center;
    }
    #chang-jian-ye-mian-bu-ju + .demo-container .el-main {
        background-color: #e9eef3;
        color: #333;
        text-align: center;
        line-height: 160px;
    }
     .app{
         font-family: "microsoft yahei";
     }
    #content{
        background-color: #f9f9f9;
        padding: 30px 0;
    }
</style>

<template>
    <div id="app-layout" class="app">
        <el-container>
            <el-header>
                <Navigation></Navigation>
            </el-header>
            <el-row type="flex" justify="center" id="content">
                <el-col :xs="20" :md="20" :style="{'minHeight':minHeight+'px'}">
                    <router-view></router-view>
                </el-col>
            </el-row>
            <LFooter></LFooter>
        </el-container>
        <Register></Register>
    </div>
</template>

<script>
    import LFooter from '../components/L-footer'
    import Navigation from '../components/global/NavigationModal';
    //import LoginModal from '../../../../CloudStation/blumer-blog/resources/js/components/global/RegisterModal.vue';
    import Register from '../components/global/RegisterModal';
    export default {
        data() {
            return {
                minHeight: 0,
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                //console.log(key, keyPath);
            }
        },
        components: {
            Navigation,
            //LoginModal,
            Register,
            LFooter,
        }
    }
</script>