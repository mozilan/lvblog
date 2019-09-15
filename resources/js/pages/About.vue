<template>
    <div class="about">
        <el-row class="main" type="flex" justify="center">
            <el-col :span="16">
                <h5 class="title"><i class="el-icon-star-on"></i>关于自己</h5>
                <div class="statement">
                    <div class="item">开源爱好者，程序人生</div>
                    <div class="item">座右铭：当你的才华满足不了你的野心时，你就应该去提升自己。</div>
                </div>
                <div class="statement">
                    <div class="item">Email：mozilan@aliyun.com</div>
                    <div class="item">QQ：609961022</div>
                    <div class="item">CSDN：
                        <a target="_blank" href="https://blog.csdn.net/geeksoarsky">https://blog.csdn.net/geeksoarsky</a>
                    </div>
                </div>
                <h5 class="title"><i class="el-icon-star-on"></i>关于博客</h5>
                <el-card shadow="always">
                    <dl class="dl-blog">
                        <dt>博客开源</dt>
                        <dd>
                            <a target="_blank" href="https://github.com/mozilan/LvBlog"><img class="icon" src="../../assets/github.jpg" alt="GitHub" /></a>
                        </dd>
                        <dt>涉及技术</dt>
                        <dd>Laravel、Vue 全家桶、Element-ui</dd>
                        <dt>其它</dt>
                        <dd>前后端分离的 SPA 应用</dd>
                    </dl>
                </el-card>
                <h5 class="title"><i class="el-icon-star-on"></i>联系我：</h5>
                <el-card shadow="always">
                    <el-form label-position="left" :rules="rules" label-width="80px" ref="formLabelAlign" :model="formLabelAlign">
                        <el-form-item label='你的名字' prop="name">
                            <el-input v-model="formLabelAlign.name"></el-input>
                        </el-form-item>
                        <el-form-item label='你的邮箱' prop="email">
                            <el-input v-model="formLabelAlign.email"></el-input>
                        </el-form-item>
                        <el-form-item label='留言内容' prop="content">
                            <el-input type="textarea" v-model="formLabelAlign.content"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="submitForm('formLabelAlign')">提交留言</el-button>
                        </el-form-item>
                    </el-form>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: 'about',
        data() {
            return {
                formLabelAlign: {
                    name: '',
                    email: '',
                    content: ''
                },
                rules: {
                    name: [{
                        required: true,
                        trigger: 'blur'
                    }],
                    email: [{
                        required: true,
                        trigger: 'blur'
                    },
                        {
                            type: 'email',
                            trigger: ['blur', 'change']
                        }
                    ],
                    content: [{
                        required: true,
                        trigger: 'blur'
                    }]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if(valid) {
                        alert('submit!');
                    } else {
                        return false;
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .dl-blog dd {
        margin-left: 30px;
    }

    .dl-blog .icon {
        width: 20px;
        height: 20px;
    }

    .title {
        margin-top: 40px;
    }

    .statement {
        border-left: 3px solid #F56C6C;
        padding: 20px;
        background-color: #EBEEF5;
        margin-top: 20px;
    }
</style>