<style lang="scss" scoped>
    .login-modal{
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
                    width: 220px;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }
            }
        }
        .bl-left{
            float:left;
        }
        .bl-right{
            float:right;
        }

        .oauth{
            text-align: center;
            padding-top: 3px;
        }
        .effect-input{
            width: 100%;
        }
    }
</style>

<template>
    <el-dialog class="login-modal" title="用户登录" :before-close="handleClose" :close="redirectToIndex" :visible.sync="loginDialogFormVisible">
        <el-container style="display:block">
        <el-row>
            <el-form :model="form">
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                    <el-form-item>
                        <effect-input @keyup.enter.native="submitLogin" class="effect-input" v-model="username" type="ichiro" label="用户名" name="用户名"></effect-input>
                    </el-form-item>
                </el-col>
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                    <el-form-item>
                        <effect-input @keyup.enter.native="submitLogin" class="effect-input" v-model="password" type="kaede" label="密码" name="密码"></effect-input>
                    </el-form-item>
                </el-col>
                <el-col :xs="24" :sm="24" :md="24" :lg="24">
                    <el-form-item>
                        <el-col :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link @click="setLastPath" href="/auth/github" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/github.png"/>
                            </el-link>
                        </el-col>
                        <el-col :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link  @click="setLastPath" href="/auth/weibo" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/sina.png"/>
                            </el-link>
                        </el-col>
                        <el-col @click="tips" :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link href="#" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/wechat.png"/>
                            </el-link>
                        </el-col>
                        <el-col @click="tips" :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link href="#" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/qq.png"/></el-link>
                        </el-col>
                        <el-col @click="tips" :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link href="#" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/twitter.png"/>
                            </el-link>
                        </el-col>
                        <el-col @click="tips" :xs="6" :sm="6" :md="4" :lg="4" class="bl-left oauth">
                            <el-link href="#" v-on:click.stop="">
                                <el-image style="width: 20px; height: 20px" src="https://mozilan.geekadpt.cn/img/social/facebook.png"/>
                            </el-link>
                        </el-col>
                    </el-form-item>
                </el-col>
            </el-form>
            <el-col :xs="24" :sm="24" :md="24" :lg="24">
                <el-button @click="toRegister">注册</el-button>
                <el-button class="bl-right" type="primary" @click="submitLogin">确 定</el-button>
            </el-col>
        </el-row>
        </el-container>
    </el-dialog>
</template>
<script>
    import { EventBus } from '../../event-bus.js';
    import  _urls from '../../utils/url';
    import {EffectInput} from 'effect-input'
    import 'effect-input/dist/index.css';
    export default {
        name:'login_modal',
        components:{
            EffectInput:EffectInput,
        },
        data() {
            return {
                loader: {},
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
            tips(){
                this.$message.info('该版本第三方登陆只支持 GitHub 和 微博 ');
            },
            toRegister() {
                this.hideLoginDialogForm();
                setTimeout(()=>{
                    EventBus.$emit('prompt-register');
                },800);
            },
            openMessage: function (title, type) {
                this.$message({
                    message: title,
                    type: type
                });
            },
            handleClose(done) {
                this.$confirm('确认关闭？')
                    .then(_ => {
                        this.username = '';
                        this.password = '';
                        this.loginDialogFormVisible=false;
                        done();
                    })
                    .catch(_ => {});
            },
            redirectToIndex(){
                if(this.$route.query.login != null){
                    this.$router.push({name:'首页'});
                }
            },
            hideLoginDialogForm(){
                this.loginDialogFormVisible = false;
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
                    this.loader = this.$loading({
                        lock: true,
                        text: '正在登录',
                        spinner: 'el-icon-loading',
                        background: 'rgba(0, 0, 0, 0.7)'
                    });
                    this.$watch(this.$store.getters.getLoginStatus, function () {
                        if (this.$store.getters.getLoginStatus() === 2) {
                            this.loader.close();
                            this.username= '';
                            this.password = '';
                            this.$message.success('登陆成功！');
                            this.hideLoginDialogForm();
                        }
                        if (this.$store.getters.getLoginStatus() === 3) {
                            this.loader.close();
                            this.$message.error(this.$store.getters.getLoginErrors());
                        }
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
            setLastPath(){
                this.$store.dispatch('setLastPath',{
                    params:this.$route.fullPath,
                })
            }
        },
        computed: {
            loginStatus() {
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
            '$route':'showLoginForm',
        },
    }
</script>