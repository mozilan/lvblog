<style lang="scss">
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
</style>

<template>
    <el-dialog title="用户注册" :visible.sync="registerDialogFormVisible">
        <el-container style="display:block">
            <el-row>
                <el-form :model="form">
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="手机号" :label-width="formLabelWidth">
                            <el-input
                                    placeholder="请输入手机号"
                                    suffix-icon="el-icon-mobile-phone"
                                    v-model="phone">
                            </el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="验证码" :label-width="formLabelWidth">
                            <el-button type="primary" style="float: right;" @click="getCaptchas" v-show="captcha_button_show" :loading="captcha_loading">{{ captcha_loading ? '获取中 ...' : '获取验证码' }}</el-button>
                            <el-image
                                    style="width:auto; height: 40px;float:right"
                                    :src="captchas_url"
                                    v-show="captcha_show"
                                    @click="getCaptchas"
                            >
                            </el-image>
                            <el-input
                                    placeholder="请输入图片验证码"
                                    suffix-icon="el-icon-picture"
                                    v-model="captcha_code"
                                    style="width:50%;float:left;"

                            >
                            </el-input>
<!--                            <el-input-->
<!--                                    :value="captchas.captcha_key"-->
<!--                                    v-model="captcha_key"-->
<!--                                    style="display:none"-->
<!--                            >-->
<!--                            </el-input>-->
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="短信码" :label-width="formLabelWidth">
                            <el-input
                                    placeholder="请输入短信验证码"
                                    suffix-icon="el-icon-message"
                                    v-model="verification_code"
                                    @focus=""
                                    style="width: 50%;float: left;"
                            >
                            </el-input>
                            <el-button type="primary" @click="getMessages" :loading="message_loading" style="float: right">{{ message_loading ? '10秒倒计时 ...' : '发送短信码' }}</el-button>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="用户名" :label-width="formLabelWidth">
                            <el-input
                                    placeholder="请输入用户名"
                                    suffix-icon="el-icon-user"
                                    v-model="name">
                            </el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="密码" :label-width="formLabelWidth">
                            <el-input
                                    placeholder="请输入密码"
                                    suffix-icon="el-icon-key"
                                    v-model="password">
                            </el-input>
                        </el-form-item>
                    </el-col>
                </el-form>
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-button @click="registerDialogFormVisible = false" style="float:left">取 消</el-button>
                        <el-button class="bl-right" type="primary" @click="submitRegisterByPhone" style="float:right">确定</el-button>
                </el-col>
                <span
                        v-loading.fullscreen.lock="fullscreenLoading">

                </span>
                <span
                        v-show="registerByPhoneStatus == 1">
                </span>
                <span
                        v-show="captchaLoadStatus == 1">
                </span>
                <span
                        v-show="verificationCodeLoadStatus == 1">
                </span>
                <span
                    v-show="captchas">
                </span>
                <span
                    v-show="messages">
                </span>
            </el-row>
        </el-container>
    </el-dialog>

</template>
<script>
    import { EventBus } from '../../event-bus.js';
    export default {
        data() {
            return {
                captcha_button_show:true,
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
                //Label宽度
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
            getCaptchas:function(){
                if(this.phone.trim() === ''){
                    this.validations.phone.text = '请输入手机号';
                    this.openMessage(this.validations.phone.text,'warning');
                    return false;
                }
                this.$store.dispatch('freshVerificationCodeStatus');
                this.captcha_loading=true;
                this.$store.dispatch('loadCaptchas',{
                    phone: this.phone,
                });
            },
            getMessages:function(){
                if(this.captcha_code.trim() === ''){
                    this.validations.captcha_code.text = '请输入图形验证码';
                    this.openMessage(this.validations.captcha_code.text,'warning');
                    return false;
                }
                this.captcha_button_show = true;
                this.captcha_show = false;
                this.$store.dispatch('freshCaptchaStatus');
                this.message_loading = true;
                this.$store.dispatch('loadVerificationCodes',{
                    phone: this.phone,
                    captcha_key: this.captcha_key,
                    captcha_code : this.captcha_code,
                });
                setTimeout(() => {
                    this.message_loading = false;
                }, 10000);
            },
            openMessage:function(title,type){
                this.$message({
                    message:title,
                    type: type
                });
            },
            submitRegisterByPhone: function () {
                if(this.validateRegisterByPhone()) {
                    this.$store.dispatch('freshVerificationCodeStatus');
                    this.$store.dispatch('registerByPhone', {
                        name: this.name,
                        password: this.password,
                        verification_key: this.verification_key,
                        verification_code: this.verification_code,
                    });
                }
            },
            validateRegisterByPhone: function () {
                let validateRegisterForm  = true;
                if(this.phone.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.phone.is_valid = false;
                    this.validations.phone.text = '请输入手机号';
                    this.openMessage(this.validations.phone.text,'warning');
                    return validateRegisterForm;
                }
                if(!this.phone.trim().match(/^1[3456789]\d{9}$/)){
                    validateRegisterForm = false;
                    this.validations.phone.is_valid = false;
                    this.validations.phone.text = '手机号格式不正确';
                    this.openMessage(this.validations.phone.text,'warning');
                    return validateRegisterForm;
                }
                if(this.captcha_code.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.captcha_code.is_valid = false;
                    this.validations.captcha_code.text = '请输入图形验证码';
                    this.openMessage(this.validations.captcha_code.text,'warning');
                    return validateRegisterForm;
                }
                if(this.verification_code.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.verification_code.is_valid = false;
                    this.validations.verification_code.text = '请输入手机验证码';
                    this.openMessage(this.validations.verification_code.text,'warning');
                    return validateRegisterForm;
                }
                if(this.name.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = '请输入用户名';
                    this.openMessage(this.validations.name.text,'warning');
                    return validateRegisterForm;
                }
                if(!this.name.trim().match(/(^[a-zA-Z0-9_-]{6,12}$)/)){
                    validateRegisterForm = false;
                    this.validations.name.is_valid = false;
                    this.validations.name.text = '用户名必须 6到12位,字母,数字,下划线,减号';
                    this.openMessage(this.validations.name.text,'warning');
                    return validateRegisterForm;
                }
                if(this.password.trim() === ''){
                    validateRegisterForm = false;
                    this.validations.password.is_valid = false;
                    this.validations.password.text = '请输入密码';
                    this.openMessage(this.validations.password.text,'warning');
                    return validateRegisterForm;
                }
                if(!this.password.trim().match(/(^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z_]{6,20}$)/)){
                    validateRegisterForm = false;
                    this.validations.password.is_valid = false;
                    this.validations.password.text = '密码最少6位，要同时含有数字和字母';
                    this.openMessage(this.validations.password.text,'warning');
                    return validateRegisterForm;
                }
                return validateRegisterForm;
            }
        },
        computed: {
            captchaLoadStatus(){
                if (this.$store.getters.getCaptchaLoadStatus == 1){
                    this.loader = this.$loading({
                        lock: true,
                        text: '正在获取图形验证码',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                }
                if (this.$store.getters.getCaptchaLoadStatus == 2){
                    this.loader.close();
                    this.openMessage('获取图形验证码成功！','success');
                    this.captcha_button_show = false;
                    this.captcha_show = true;
                    this.captcha_loading=false;
                }
                if (this.$store.getters.getCaptchaLoadStatus == 3){
                    this.loader.close();
                    this.openMessage('此手机号已经注册!','error');
                    this.captcha_loading = false;
                }
                return this.$store.getters.getCaptchaLoadStatus;
            },
            captchas(){
                const captchas = this.$store.getters.getCaptchas;
                this.captcha_key =captchas.captcha_key;
                this.captchas_url = captchas.captcha_image_content;
            },
            verificationCodeLoadStatus(){
                if (this.$store.getters.getVerificationCodeLoadStatus == 1){
                    this.loader = this.$loading({
                        lock: true,
                        text: '正在发送短信验证码',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                }
                if (this.$store.getters.getVerificationCodeLoadStatus == 2){
                    this.loader.close();
                    this.openMessage('短信验证码已发送到您的手机！','success');
                }
                if (this.$store.getters.getVerificationCodeLoadStatus == 3){
                    this.loader.close();
                    this.openMessage('图形验证码不正确！','error');
                }
                return this.$store.getters.getVerificationCodeLoadStatus;
            },
            messages(){
                const messages = this.$store.getters.getVerificationCodes;
                this.verification_key = messages.key;
            },
            registerByPhoneStatus(){
                if (this.$store.getters.getRegisterByPhoneStatus == 1){
                    this.loader = this.$loading({
                        lock: true,
                        text: 'Loading',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                }
                if (this.$store.getters.getRegisterByPhoneStatus == 2){
                    //this.fullscreenLoading = false;
                    this.phone='';
                    this.captcha_code= '';
                    this.captchas_url='';
                    this.captcha_key='';
                    this.verification_key='';
                    this.verification_code='';
                    this.name='';
                    this.password= '';
                    this.captcha_button_show = true;
                    this.captcha_show = false;
                    this.loader.close();
                    this.openMessage('注册成功！','success');
                    this.registerDialogFormVisible = false;
                    this.$store.dispatch('freshRegisterByPhoneStatus');
                }
                if (this.$store.getters.getRegisterByPhoneStatus == 3){
                    //this.fullscreenLoading = false;
                    this.loader.close();
                    this.openMessage('注册失败!','error');
                    this.$store.dispatch('freshRegisterByPhoneStatus');
                }
                return this.$store.getters.getRegisterStatus;
            },
        },
        mounted() {
            EventBus.$on('prompt-register', function () {
                this.registerDialogFormVisible = true;
            }.bind(this));
        },
    }
</script>