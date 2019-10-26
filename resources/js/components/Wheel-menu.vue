<template>
    <div id='ss_menu'>
        <div>
            <a href="http://wpa.qq.com/msgrd?v=3&uin=609961022&site=qq&menu=yes">
                <i class="el-icon-chat-dot-round"></i>
            </a>
        </div>
        <div @click="simplify">
            <i class="el-icon-s-operation"></i>
        </div>
        <div @click="gorgeous">
            <i class="el-icon-menu"></i>
        </div>
        <div @click="scrollToTop">
            <i class="el-icon-top"></i>
        </div>
        <div class='menu'>
            <div class='share' id='ss_toggle' data-rot='180'>
                <div class='circle'></div>
                <div class='bar'></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Wheel-menu",
        data() {
            return {
                scrollTop:0,
                interval:'',
                jumped:0,
            }
        },
        mounted() {
            var toggle = $('#ss_toggle');
            var menu = $('#ss_menu');
            var rot;
            $('#ss_toggle').on('click', function (ev) {
                rot = parseInt($(this).data('rot')) - 180;
                menu.css('transform', 'rotate(' + rot + 'deg)');
                menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
                if (rot / 180 % 2 == 0) {
                    toggle.parent().addClass('ss_active');
                    toggle.addClass('close');
                } else {
                    toggle.parent().removeClass('ss_active');
                    toggle.removeClass('close');
                }
                $(this).data('rot', rot);
            });
        },
        methods:{
            stopInterval(){
                //已废弃
                // console.log('power on'+document.getElementsByTagName('html')[0].scrollTop);
                //
                // if(document.getElementsByClassName('lv-scrollbar__wrap')[0].scrollTop == 0){
                //     console.log('我被激活了');
                //      window.clearInterval(this.interval);
                // }
                if(document.getElementsByTagName('html')[0].scrollTop == 0){
                    window.clearInterval(this.interval);
                    console.log('已清除interval');
                }
            },
            scrollToTop(){
                            //已废弃
                            // jump = document.querySelectorAll(anchor);
                            // console.log(jump);
                            // if(jump.length!=0) {
                            //     // 滚动到目标位置
                            //     console.log(jump);
                            //     document.querySelector(anchor).scrollIntoView(true);
                            //     ++this.jumped;
                            // }
                            // let instance = document.getElementsByClassName('lv-scrollbar__wrap');
                            // if (instance.length > 0) {
                            //     let rapid = instance[0].scrollTop / 200;
                            //     this.interval = setInterval(() => {
                            //         document.getElementsByClassName('lv-scrollbar__wrap')[0].scrollTop -= rapid;
                            //         console.log(document.getElementsByClassName('lv-scrollbar__wrap')[0].scrollTop);
                            //         ++this.jumped;
                            //     }, 10);
                            // }
                            let instance = document.getElementsByTagName('html');
                            if(instance.length > 0 && instance[0].scrollTop >360){
                                let rapid = instance[0].scrollTop/50;
                                    this.interval = setInterval(() => {
                                        //console.log(document.getElementsByTagName('html')[0].scrollTop);
                                        document.getElementsByTagName('html')[0].scrollTop -= rapid;
                                        ++this.jumped;
                                    },10);
                            }
            },
            simplify(){
                if(this.$store.getters.getSimplifyStatus == 2){
                    this.$message.warning('已开启精简模式！');
                }else{
                    this.$store.dispatch('simplify');
                    this.$message.info('已开启精简模式');
                }
            },
            gorgeous(){
                if(this.$store.getters.getGorgeousStatus == 2){
                    this.$message.warning('已开启大图模式！');
                }else{
                    this.$store.dispatch('gorgeous');
                    this.$message.success('已开启大图模式');
                }
            },
        },
        watch: {
            // 如果jumped有变化，会再次执行stopInterval
            "jumped": "stopInterval"
        }
    }
</script>

<style scoped>
   @import "../../sass/wheel-menu/animate.min.css";
   /*@import "../../sass/wheel-menu/normalize.css";*/
   @import "../../sass/wheel-menu/styles.css";
   #ss_menu > div{
       cursor: pointer;
   }
   #ss_menu > div a{
       vertical-align: middle;
   }
</style>