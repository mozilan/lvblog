<style lang="scss" scoped>
    .register-modal{
        div#login-modal {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, .6);

            div.login-box {
                max-width: 370px;
                min-width: 320px;
                padding: 0 10px;
                background-color: #fff;
                border: 1px solid #ddd;
                -webkit-box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
                box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
                -webkit-border-radius: 4px;
                border-radius: 4px;
                font-size: 16px;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

                a {
                    display: block;
                    margin: auto;
                    width: 230px;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }
            }
        }
        .bl-right{
            float:right;
        }
        .get-button{
            position: absolute;
            right: 0;
            bottom: 0;
            padding: 20px 0;
            width: 75px;
        }
    }
</style>
<template>
    <el-dialog class="register-modal"  :before-close="handleClose" title="用户注册" :visible.sync="registerDialogFormVisible">
        <el-container style="display:block">
            <el-row>
                <el-form :model="form">
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item>
                            <effect-input class="effect-input" v-model="phone" type="hoshi" label="手机号" name="手机号"></effect-input>
                        </el-form-item>
                    </el-col>
                    <div @click="getCaptchas" style="min-height:40px">
                        <el-image
                                :src="captchas_url"
                                v-show="captcha_show"

                        >
                        </el-image>
                    </div>

                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item>
                            <el-button class="get-button" type="info" cirtle style="float: right;" @click="getCaptchas" v-show="captcha_button_show" :loading="captcha_loading">{{ captcha_loading ? '获取中 ...' : '点我获取' }}</el-button>
                            <effect-input class="effect-input" v-model="captcha_code" type="hoshi" label="图形验证码" name="图形验证码"></effect-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item>
                            <effect-input class="effect-input" v-model="verification_code" type="hoshi" label="短信验证码" name="短信验证码"></effect-input>
                            <el-button class="get-button" type="info" cirtle  @click="getMessages" :loading="message_loading" style="float: right">{{ message_loading ? counter : '点我获取' }}</el-button>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item>
                            <effect-input class="effect-input" v-model="name" type="hoshi" label="昵称" name="昵称"></effect-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item>
                            <effect-input @keyup.enter.native="submitRegisterByPhone" class="effect-input" v-model="password" type="kaede" label="密码" name="密码"></effect-input>
                        </el-form-item>
                    </el-col>
                </el-form>
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-button @click="toLogin" style="float:left">登陆</el-button>
                        <el-button class="bl-right" type="primary" @click="submitRegisterByPhone" style="float:right">确定</el-button>
                </el-col>
            </el-row>
        </el-container>
    </el-dialog>

</template>
<script>
    import { EventBus } from '../../event-bus.js';
    import {EffectInput} from 'effect-input'
    import 'effect-input/dist/index.css';
    export default {
        name:'register_modal',
        components:{
            EffectInput:EffectInput,
        },
        data() {
            return {
                intervalInstance:1,
                captcha_button_show:true,
                counter:-1,
                counterConf: 60,
                captcha_loading:false,
                message_loading:false,
                loader:'',
                captcha_show: false,
                fullscreenLoading: false,
                registerDialogFormVisible: false,
                form: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                formLabelWidth: '55px',
                phone: '',
                captcha_code: '',
                captchas_url:'',
                captcha_key:'',
                verification_key:'',
                verification_code:'',
                name: '',
                password: '',
                validations: {
                    phone: {
                        id_valid: true,
                        text: ''
                    },
                    captcha_code: {
                        id_valid: true,
                        text: ''
                    },
                    verification_code: {
                        id_valid: true,
                        text: ''
                    },
                    name: {
                        id_valid: true,
                        text: ''
                    },
                    password: {
                        id_valid: true,
                        text: ''
                    },
                }
            }
        },
        methods:{
            stopInterval(){
                if(this.counter == 0){
                    window.clearInterval(this.intervalInstance);
                }
            },
            hideRegisterDialogForm(){
                this.registerDialogFormVisible = false;
            },
            toLogin(){
                this.hideRegisterDialogForm();
                setTimeout(()=>{
                    EventBus.$emit('prompt-login');
                },800);
            },
            handleClose(done) {
                this.$confirm('确认关闭？')
                    .then(_ => {
                        this.clearForm();
                        done();
                    })
                    .catch(_ => {});
            },
            clearForm(){
                this.phone='';
                this.captcha_code= '';
                this.captchas_url='';
                this.captcha_key='';
                this.verification_key='';
                this.verification_code='';
                this.name='';
                this.password= '';
                this.captcha_button_show = false;
                this.captcha_show = false;
                this.captcha_loading=false;
            },
            getCaptchas:function(){
                if(this.phone.trim() === ''){
                    this.validations.phone.text = '请输入手机号';
                    this.$message.warning(this.validations.phone.text,'warning');
                    return false;
                }
                this.captcha_loading=true;
                this.$store.dispatch('loadCaptchas',{
                    phone: this.phone,
                });
                this.loader = this.$loading({
                    lock: true,
                    text: '正在获取图形验证码',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
                this.$watch(this.$store.getters.getCaptchaLoadStatus, function () {
                    if (this.$store.getters.getCaptchaLoadStatus() == 2) {
                        const captchas = this.$store.getters.getCaptchas;
                        this.captcha_key =captchas.captcha_key;
                        this.captchas_url = captchas.captcha_image_content;
                        this.loader.close();
                        this.$message.success('获取图形验证码成功！');
                        this.captcha_button_show = false;
                        this.captcha_show = true;
                        this.captcha_loading=false;

                    }else if (this.$store.getters.getCaptchaLoadStatus() == 3) {
                        this.captcha_loading=false;
                        this.loader.close();
                        this.$message.error(this.$store.getters.getCaptchaError);
                    }
                });
            },
            getMessages:function(){
                this.counter = this.counterConf;
                var that = this;
                if(this.captcha_code.trim() === ''){
                    this.validations.captcha_code.text = '请输入图形验证码';
                    this.$message.warning(this.validations.captcha_code.text);
                    return false;
                }
                this.$store.dispatch('loadVerificationCodes',{
                    phone: this.phone,
                    captcha_key: this.captcha_key,
                    captcha_code : this.captcha_code,
                });
                this.loader = this.$loading({
                    lock: true,
                    text: '正在发送短信验证码',
                    spinner: 'el-icon-loading',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
                this.$watch(this.$store.getters.getVerificationCodeLoadStatus, function () {
                    if (this.$store.getters.getVerificationCodeLoadStatus() == 2) {
                        this.loader.close();
                        this.verification_key = this.$store.getters.getVerificationCodes;
                        this.$message.success('短信验证码已发送到您的手机！');
                        this.captcha_button_show = true;
                        this.captcha_show = false;
                        this.message_loading = true;
                        if(this.intervalInstance){
                            window.clearInterval(this.intervalInstance);
                        }
                        this.intervalInstance =  setInterval(function () {
                            if (that.counter <= 0) {
                                //index 秒结束后的操作
                                that.message_loading = false;
                            }else {
                                //console.log(that.counter);
                                --that.counter;
                            }
                        }, 1000);
                        //console.log(this.intervalInstance);
                    }else if (this.$store.getters.getVerificationCodeLoadStatus() == 3) {
                        this.loader.close();
                        this.$message.error(this.$store.getters.getVerificationCodeError);

                    }
                });
            },

            openMessage:function(title,type){
                this.$message({
                    message:title,
                    type: type
                });
            },
            submitRegisterByPhone: function () {
                if(this.validateRegisterByPhone()) {
                    this.$store.dispatch('registerByPhone', {
                        name: this.name,
                        password: this.password,
                        verification_key: this.verification_key,
                        verification_code: this.verification_code,
                    });
                    this.loader = this.$loading({
                        lock: true,
                        text: '注册中...',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                    this.$watch(this.$store.getters.getRegisterByPhoneStatus, function () {
                        if (this.$store.getters.getRegisterByPhoneStatus () == 2) {
                            this.clearForm();
                            this.captcha_button_show = true;
                            this.captcha_show = false;
                            //清除倒计时示例
                            if(this.intervalInstance){
                                window.clearInterval(this.intervalInstance);
                            }
                            this.loader.close();
                            this.$message.success('注册成功！');
                            this.registerDialogFormVisible = false;
                        }else if (this.$store.getters.getRegisterByPhoneStatus () == 3) {
                            this.loader.close();
                            this.$message.error(this.$store.getters.getRegisterByPhoneError);

                        }
                    });
                }
            },
            validateRegisterByPhone: function () {
                let validateRegisterForm  = true;
                if(this.phone.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.phone.is_valid = false;
                    this.validations.phone.text = '请输入手机号';
                    this.$message.warning(this.validations.phone.text);
                    return validateRegisterForm;
                }
                if(!this.phone.trim().match(/^1[3456789]\d{9}$/)){
                    validateRegisterForm = false;
                    this.validations.phone.is_valid = false;
                    this.validations.phone.text = '手机号格式不正确';
                    this.$message.warning(this.validations.phone.text);
                    return validateRegisterForm;
                }
                if(this.captcha_code.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.captcha_code.is_valid = false;
                    this.validations.captcha_code.text = '请输入图形验证码';
                    this.$message.warning(this.validations.captcha_code.text);
                    return validateRegisterForm;
                }
                if(this.verification_code.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.verification_code.is_valid = false;
                    this.validations.verification_code.text = '请输入手机验证码';
                    this.$message.warning(this.validations.verification_code.text);
                    return validateRegisterForm;
                }
                if(this.name.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = '请输入用户名';
                    this.$message.warning(this.validations.name.text);
                    return validateRegisterForm;
                }
                if(!this.name.trim().length > 15){
                    validateRegisterForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = '用户名最长只能15位';
                    this.$message.warning(this.validations.name.text);
                    return validateRegisterForm;
                }
                if(this.password.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.password.is_valid = false;
                    this.validations.password.text = '请输入密码';
                    this.$message.warning(this.validations.password.text);
                    return validateRegisterForm;
                }
                if(!this.password.trim().match(/(^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$)/)){
                    validateRegisterForm = false;
                    this.validations.password.is_valid = false;
                    this.validations.password.text = '密码最少6位，要同时含有数字和字母';
                    this.$message.warning(this.validations.password.text);
                    return validateRegisterForm;
                }
                return validateRegisterForm;
            }
        },
        mounted() {
            EventBus.$on('prompt-register', function () {
                this.registerDialogFormVisible = true;
            }.bind(this));
        },
        watch: {
            // 如果counter有变化，会再次执行stopInterval
            "counter": "stopInterval"
        }
    }
</script>