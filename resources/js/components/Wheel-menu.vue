<template>
    <div id='ss_menu'>
        <div>
            <i class="el-icon-chat-dot-round"></i>
        </div>
        <div>
            <i class="el-icon-s-operation"></i>
        </div>
        <div>
            <i class="el-icon-menu"></i>
        </div>
        <div>
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
        }
    }
</script>

<style scoped>
    #ss_menu {
        bottom: 30px;
        width: 60px;
        height: 60px;
        color: #fff;
        position: fixed;
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        transition: all 1s ease;
        right: 30px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
    }
    #ss_menu > .menu {
        display: block;
        position: absolute;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.23), 0 3px 10px rgba(0, 0, 0, 0.16);
        color: #fff;
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        transition: all 1s ease;
    }
    #ss_menu > .menu .share {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        -ms-transform: rotate(180deg);
        -o-transform: rotate(180deg);
        transform: rotate(180deg);
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        transition: all 1s ease;
    }
</style>