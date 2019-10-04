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
    <el-dialog title="用户登录" :close="redirectToIndex" :visible.sync="loginDialogFormVisible">
        <el-container style="display:block">
        <el-row>
            <div @click="toRescue" style="display: block;" ref="toRescue">
            </div>
            <el-form :model="form">
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                    <el-form-item label="用户名" :label-width="formLabelWidth">
                        <el-input
                                placeholder="请输入邮箱或者手机号"
                                suffix-icon="el-icon-user"
                                v-model="username">
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
<!--            <el-col :xs="4" :sm="4" :md="4" :lg="4" :offset="1">-->
<!--                <span>第三方登录:</span>-->
<!--            </el-col>-->
<!--            <el-col :xs="4" :sm="4" :md="4" :lg="4" class="bl-right">-->
<!--                <el-link href="/auth/github" v-on:click.stop="">-->
<!--                    <el-image style="width: 30px; height: 30px" src="/img/github/github-login.jpg"/>-->
<!--                </el-link>-->
<!--            </el-col>-->
<!--            <el-col :xs="4" :sm="4" :md="4" :lg="4" class="bl-right">-->
<!--                <el-link href="/auth/weixin-web" v-on:click.stop="">-->
<!--                    <el-image style="width: 30px; height: 30px" src="/img/weixin/weixin-login.jpg"/>-->
<!--                </el-link>-->
<!--            </el-col>-->
<!--            <el-col :xs="4" :sm="4" :md="4" :lg="4" class="bl-right">-->
<!--                <el-link href="/auth/qq" v-on:click.stop="">-->
<!--                    <el-image style="width: 30px; height: 30px" src="/img/qq/qq-login.jpg"/></el-link>-->
<!--            </el-col>-->
<!--            <el-col :xs="4" :sm="4" :md="4" :lg="4" class="bl-right">-->
<!--                <el-link href="/auth/weibo" v-on:click.stop="">-->
<!--                    <el-image style="width: 30px; height: 30px" src="/img/weibo/weibo-login.jpg"/>-->
<!--                </el-link>-->
<!--            </el-col>-->
            <el-col :xs="24" :sm="24" :md="24" :lg="24">
                <el-button @click="hideLoginDialogForm">取 消</el-button>
                <el-button class="bl-right" type="primary" @click="submitLogin">确 定</el-button>
            </el-col>
            <span
                    v-show="loginStatus == 1">
            </span>
        </el-row>
        </el-container>
    </el-dialog>
</template>
<script>
    import { EventBus } from '../../event-bus.js';
    import  _urls from '../../utils/url';
    export default {
        data() {
            return {
                url: '/',
                loader: '',
                loginDialogFormVisible: false,
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
                username: '',
                password: '',
                validations: {
                    username: {
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
        methods: {
            toRescue() {
                window.location.href = this.url;
            },
            openMessage: function (title, type) {
                this.$message({
                    message: title,
                    type: type
                });
            },
            redirectToIndex(){
                if(this.$route.query.login != null){
                    this.$router.push({name:'index'});
                }
            },
            hideLoginDialogForm(){
                this.loginDialogFormVisible = false;
                this.$router.push({name:'index'});
            },
            showLoginForm(){
                if(this.$route.query.login != null){
                    this.loginDialogFormVisible = true;
                }
            },
            submitLogin: function () {
                if (this.validateLogin()) {
                    this.$store.dispatch('login', {
                        username: this.username,
                        password: this.password,
                    });
                }
            },
            validateLogin: function () {
                let validateLoginForm = true;
                if (this.username.trim() === '') {
                    validateLoginForm = false;
                    this.validations.username.is_valid = false;
                    this.validations.username.text = '请输入用户名';
                    this.openMessage(this.validations.username.text, 'warning');
                    return validateLoginForm;
                }
                if (this.password.trim() === '') {
                    validateLoginForm = false;
                    this.validations.password.is_valid = false;
                    this.validations.password.text = '请输入密码';
                    this.openMessage(this.validations.password.text, 'warning');
                    return validateLoginForm;
                }
                return validateLoginForm;
            },
        },
        computed: {
            loginStatus() {
                if (this.$store.getters.getLoginStatus == 1) {
                    this.loader = this.$loading({
                        lock: true,
                        text: '正在登录',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                }
                if (this.$store.getters.getLoginStatus == 2) {
                    this.loader.close();
                    this.openMessage('登录成功！', 'success');
                    if(_urls.getUrlParams('code') !== null){
                        window.location.href = '/';
                    }
                }
                if (this.$store.getters.getLoginStatus == 3) {
                    this.loader.close();
                    this.openMessage(this.$store.getters.getLoginErrors, 'error');
                }
                return this.$store.getters. getLoginStatus;
            }
        },
        mounted() {
            EventBus.$on('prompt-login', function () {
                this.loginDialogFormVisible = true;
            }.bind(this));
        },
        created() {
            this.showLoginForm();
        },
        watch:{
            '$route':'showLoginForm'
        },
    }
</script>