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
    <el-dialog title="用户注册" :visible.sync="dialogFormVisible">
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
                            <el-image
                                    style="width: 45%; height: 40px;float:left"
                                    :src="captcha_code_url"
                                    >
                            </el-image>
                            <el-input
                                    placeholder="图片验证码"
                                    suffix-icon="el-icon-picture"
                                    v-model="captcha_code"
                                    style="width:50%;float:left;margin-left: 5px"
                            >
                            </el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="24" :sm="24" :md="24" :lg="24">
                        <el-form-item label="短信" :label-width="formLabelWidth">
                            <el-input
                                    placeholder="请输入短信验证码"
                                    suffix-icon="el-icon-message"
                                    v-model="verification_code">
                            </el-input>
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
                        <el-button @click="dialogFormVisible = false" style="float:left">取 消</el-button>
                        <el-button class="bl-right" type="primary" @click="dialogFormVisible = false" style="float:right">确 定</el-button>
                </el-col>
            </el-row>
        </el-container>
    </el-dialog>
</template>
<script>
    import { EventBus } from '../../event-bus.js';
    export default {
        data() {
            return {
                dialogFormVisible: false,
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
                captcha_code_url:'data:image/jpeg;base64,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',
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
        mounted() {
            EventBus.$on('prompt-signin', function () {
                this.dialogFormVisible = true;
            }.bind(this));
        }
    }
</script>