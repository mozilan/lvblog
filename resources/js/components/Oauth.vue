<template>
    
</template>

<script>
    import  _urls from '../utils/url';
    export default {
        name: "Oauth",
        data() {
            return {
                loader: {},
            };
        },
        created(){
            if(_urls.getUrlParams('code') != null && this.$store.getters. getLoginStatus != 2){
                this.loader = this.$loading({
                    lock: true,
                    text: '正在登录',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
                this.$store.dispatch('loginByOauth', {
                    social_type : _urls.getUrlParams('social_type'),
                    code : _urls.getUrlParams('code'),
                });
                this.$watch(this.$store.getters.getLoginStatus, function () {
                    if (this.$store.getters.getLoginStatus() == 2) {
                        this.loader.close();
                        // this.$message.success('登录成功,正在穿越宇宙弦跳跃到蓝默空间...');
                        // setTimeout(()=>{
                        //     window.location.href = '/';
                        // },3000);
                        this.$message.success('登陆成功');
                        if(this.$store.getters.getLastPath){
                            this.$route.push({path:this.$store.getters.getLastPath});
                        }
                    }
                    if (this.$store.getters.getLoginStatus() == 3) {
                        this.loader.close();
                        this.$message.error(this.$store.getters.getLoginErrors());
                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>