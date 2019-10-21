<style lang="scss" scoped>
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
    .error{
        text-align: center;
        margin-top: 25px;
        height: 600px;
        .aaa{

            font-size: 250px;
            color: white;
            font-family: '方正舒体'
        }
        .bbb{

            font-size: 80px;
            color: white;
            font-family: '方正舒体'
        }
    }
    @media only screen and (max-width: 683px){
        .breadcrumb{
            padding-top:0;
        }
    }
</style>
<template>
    <div id="app-layout" class="app">
        <el-header>
            <Navigation></Navigation>
        </el-header>
        <div class="lv-container">
            <div class="error">
                <span class="aaa">404</span> <br><br><br><br><br><br>
                <span class="bbb">您可以选择导航栏任意一项回到正确航线 </span>
            </div>
            <Notification></Notification>
        </div>
        <Register></Register>
        <Login></Login>
    </div>
</template>

<script>
    import Navigation from '../../components/global/NavigationModal';
    import Register from '../../components/global/RegisterModal';
    import Login from '../../components/global/LoginModal';
    import Notification from '../../components/global/Notification';
    export default {
        data() {
            return {
                loader:'',
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