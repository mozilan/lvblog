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
            <Notification></Notification>
            <el-row type="flex" justify="center" class="breadcrumb">
                <el-col :xs="24" :sm="24" :md="16" :lg="16" style="padding: 6px 0 6px 0;">
                    <el-breadcrumb separator="/" class="breadcrumb-inner">
                        <el-breadcrumb-item v-for="(item,index) in $route.matched" :key="index">
                            <router-link class="lv-breadcrumb-a" :to="{ name:item.name }">{{ item.name }}</router-link>
                        </el-breadcrumb-item>
                    </el-breadcrumb>
                </el-col>
            </el-row>
            <router-view></router-view>
        </div>
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
                loader:'',
                minHeight: 0,
            };
        },
        created(){
            if(this.$route.query.article){
                var type = this.$route.query.type;
                var location = this.$route.query.location;
                switch (type) {
                    case 'comment': this.$router.push({path:'/art/'+this.$route.query.article,query:{anchor:'comment' + location}});
                    break;
                    case 'reply': this.$router.push({path:'/art/'+this.$route.query.article,query:{anchor:'rely' + location}});
                    break;
                }
            }
            var target = this.$route.query.target;
            if(target){
                switch(target){
                    case 'blog' : this.$router.push({name:'用户文章',params:{user:this.$route.query.user},query:{user:this.$route.query.user}});
                    break;
                }
            }
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