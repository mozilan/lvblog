<template>
    
</template>

<script>
    import  _urls from '../utils/url';
    export default {
        name: "Oauth",
        methods:{

        },
        created(){
            if(_urls.getUrlParams('code') != null && this.$store.getters. getLoginStatus !== 2){
                this.$store.dispatch('loginByOauth', {
                    social_type : _urls.getUrlParams('social_type'),
                    code : _urls.getUrlParams('code'),
                });
            }
        },
    }
</script>

<style scoped>

</style>