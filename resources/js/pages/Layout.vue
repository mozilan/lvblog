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
     }
    .lv-container{
        padding: 0 10px 0 10px;
    }
    .breadcrumb{
        background-color: #ffffff;
        padding-top: 20px;
    }
    .lv-breadcrumb-a{
        font-weight: 400!important;
    }
    .header-bread{
        position:fixed;
        left:5px;
        top:60px;
        width: 100%;
        z-index:100;
    }
    .header-bread-fillbg{
        display: block!important;
        background-color: white;
    }
    .content{
        height: 35px;
        padding: 6px 0 6px 0;
        background-color: white;
    }
    @media only screen and (max-width: 683px){
        .breadcrumb{
            left: 0;
            padding-top:0;
        }
        .content{
            margin-right: 20px;
            border-bottom: 1px #dcdfe6 solid;
        }
    }
</style>
<template>
    <div id="app-layout" class="app">
        <Navigation></Navigation>
        <div class="lv-container page-component__scroll el-scrollbar wrapper" ref="wrapper">
            <Notification></Notification>
            <div class="header-bread">
                <div class="header-bread-fillbg">
                    <el-row type="flex" class="breadcrumb" justify="center">
                        <el-col :lg="16" :md="16" :sm="24" :xs="24" class="content" :style="edit.styles.bread">
                            <el-breadcrumb separator="/" class="breadcrumb-inner">
                                <el-breadcrumb-item v-for="(item,index) in $route.matched" :key="index">
                                    <router-link class="lv-breadcrumb-a" :to="{ name:item.name }">{{ item.name }}</router-link>
                                </el-breadcrumb-item>
                            </el-breadcrumb>
                        </el-col>
                    </el-row>
                </div>
            </div>
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
        },
        computed:{
            edit(){
                return this.$store.getters.getScreenEditor;
            }
        }
    }
</script>