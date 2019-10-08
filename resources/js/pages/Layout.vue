<style type="">
    #chang-jian-ye-mian-bu-ju + .demo-container .el-footer, #chang-jian-ye-mian-bu-ju + .demo-container .el-header {
        text-align: center;
    }
    #chang-jian-ye-mian-bu-ju + .demo-container .el-main {
        background-color: #ffffff;
        color: #333;
        text-align: center;
        line-height: 160px;
    }
     .app{
         font-family: "microsoft yahei";
     }
    .content{
        background-color: #ffffff;
    }
    .breadcrumb{
        background-color: #ffffff;
        padding-top: 20px;
    }
    .lv-breadcrumb-a{
        font-weight: 400!important;
    }
</style>

<template>
    <div id="app-layout" class="app">
        <el-container>
            <el-header>
                <Navigation></Navigation>
            </el-header>
            <Notification></Notification>
            <el-row type="flex" justify="center" class="breadcrumb">
                <el-col :xs="24" :sm="24" :md="20" :lg="20" style="padding: 6px 0 6px 0;">
                    <el-breadcrumb separator="/" class="breadcrumb-inner">
                        <el-breadcrumb-item v-for="item in $route.matched">
                            <router-link class="lv-breadcrumb-a" :to="{ name:item.name }">{{ item.name }}</router-link>
                        </el-breadcrumb-item>
                    </el-breadcrumb>
                </el-col>
            </el-row>
            <router-view></router-view>
        </el-container>
        <Register></Register>
        <Login></Login>
    </div>
</template>

<script>

    import Navigation from '../components/global/NavigationModal';
    import Register from '../components/global/RegisterModal';
    import Login from '../components/global/LoginModal';
    import Notification from '../components/global/Notification';
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
            Register,
            Login,
            Notification,
        }
    }
</script>