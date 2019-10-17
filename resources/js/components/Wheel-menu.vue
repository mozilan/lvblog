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
        <div @click="backtop">
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
            simplify(){
                this.$store.dispatch('simplify');
            },
            gorgeous(){
                this.$store.dispatch('gorgeous');
            },
            backtop(){
                $(".el-backtop").click();
            }
        }
    }
</script>

<style scoped>
   @import "../../sass/wheel-menu/animate.min.css";
   /*@import "../../sass/wheel-menu/normalize.css";*/
   @import "../../sass/wheel-menu/styles.css";
</style>