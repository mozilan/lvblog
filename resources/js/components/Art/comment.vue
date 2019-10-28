<!--评论模块-->
<template>
    <div class="lv-comment">
        <div class="comment">
            <div class="reply" v-if="!showItemId">
                <div class="write-reply">
                    <i class="el-icon-edit"></i>
                    <span class="add-comment">评论文章</span>
                </div>
                <transition name="fade">
                    <div class="input-wrapper">
                        <el-input class="gray-bg-input"
                                  spellcheck="false"
                                  v-model="inputComment"
                                  type="textarea"
                                  resize="none"
                                  :rows="3"
                                  placeholder="提问的智慧 ? 评论 : 要知道,善良有时比聪明更重要.">
                        </el-input>
                        <div class="btn-control">
                            <span class="cancel" @click="cancel">取消</span>
                            <el-button class="btn" type="primary" round @click="commitComment()">确定</el-button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <div class="comment" v-for="item in comments">
            <div class="info" :id="'comment'+item.id">
                <img class="avatar" :src="item.fromAvatar" width="36" height="36"/>
                <div class="right">
                    <div class="name">{{item.fromName}}
                        <el-badge v-if="item.fromId == article.user_id" class="item">
                            <i style="color: #E6A23C;" class="el-icon-star-on"></i>
                        </el-badge>
                    </div>
                    <div class="date">{{item.date}}</div>
                </div>
            </div>
            <div class="content">{{item.contents}}</div>
            <div class="control">
                <span class="like" :class="{active: item.isLike}" @click="likeClick(item)">
                  <i class="iconfont icon-like"></i>
                  <span class="like-num">{{item.likeNum > 0 ? item.likeNum + '人赞' : '赞'}}</span>
                </span>
                <span class="comment-reply" @click="showCommentInput(item)">
                          <i class="el-icon-s-comment"></i>
                          <span>回复</span>
                </span>
                <span v-if="item.fromId == user.id" class="comment-reply comment-delete" @click="deleteComment(item)">
                          <i class="el-icon-remove"></i>
                          <span>删除</span>
                </span>
            </div>
            <div class="reply">
                <div class="item" v-for="reply in item.reply.data">
                    <div class="reply-content" :id="'reply'+reply.id">
                        <el-badge v-if="reply.fromId == article.user_id" class="item">
                            <i style="color: #E6A23C;" class="el-icon-star-on"></i>
                        </el-badge>
                        <el-badge v-if="reply.fromId != article.user_id" class="item">
                            <i style="color: rgb(64, 158, 255);" class="el-icon-position"></i>
                        </el-badge>
                        <span class="from-name">{{reply.fromName}}</span>
                        <span class="to-name" v-if="reply.fromId != reply.toId">@{{reply.toName}}</span>
                        <span>:&#8194;</span>
                        <span>{{reply.contents}}</span>
                    </div>
                    <div class="reply-bottom">
                        <span>{{reply.date}}</span>
                        <span v-if='validateReply(reply)' class="reply-text" @click="showCommentInput(item, reply)">
                          <i  class="el-icon-s-comment"></i>
                          <span >回复</span>
                        </span>
                        <span v-if="reply.fromId == user.id" class="reply-text " @click="deleteComment(item, reply)">
                          <i class="el-icon-remove"></i>
                          <span>删除</span>
                        </span>
                    </div>
                </div>
                <div class="write-reply" v-if="item.reply.data.length > 0" @click="showCommentInput(item)">
                    <i class="el-icon-edit"></i>
                    <span class="add-comment">添加新评论</span>
                </div>
                <transition name="fade">
                    <div class="input-wrapper" v-if="showItemId === item.id">
                        <el-input class="gray-bg-input"
                                  spellcheck="false"
                                  v-model="inputReply"
                                  type="textarea"
                                  resize="none"
                                  :rows="3"
                                  placeholder="提问的智慧 ? 评论 : 要知道,善良有时比聪明更重要.">
                        </el-input>
                        <div class="btn-control">
                            <span class="cancel" @click="cancel">取消</span>
                            <el-button class="btn" type="success" round @click="commitComment()">确定</el-button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    import {EventBus} from '../../event-bus.js';
    export default {
        name: "comment",
        data() {
            return {
                loader:'',
                tar:'',
                inputComment: '',
                inputReply:'',
                showItemId: '',

                //发布评论
                //发布评论占用信号量,PV操作
                comment_buss: 1,
                isReply: 0,
                idReply: 0,
                idComment:0,

                //删除评论
                //删除评论占用信号量,PV操作
                delete_buss: 1,
                interval:'',
                jumped:0,
            }
        },
        created(){
            this.$store.dispatch('loadComments',{
                art_id: this.$route.params.art_id,
            });
            this.$watch(this.$store.getters.getCommentsLoadStatus, function () {
                if (this.$store.getters.getCommentsLoadStatus() == 3) {
                    console.log('comment.vue:评论模块未能成功加载！')
                }
            });
        },
        mounted(){
            this.anchor();
        },
        watch: {
            // 如果路由有变化，会再次执行该方法
            "jumped": "stopInterval"
        },
        computed:{
            comments(){
                return this.$store.getters.getComments.data;
            },
            user(){
                return this.$store.getters.getUser;
            },
            article(){
                return this.$store.getters.getArticle.data;
            }
        },
        methods: {
            stopInterval(){
                window.clearInterval(this.interval);
            },
            anchor(){
                if(this.$route.query.reply !== undefined){
                    let type = this.$route.query.reply;
                    let location = this.$route.query.location;
                    let anchor = '#'+type+location;
                    let jump = '';
                    this.$nextTick(()=> {
                        this.interval = setInterval(()=> {
                            jump = document.querySelectorAll(anchor);
                            if(jump.length!=0) {
                                // 滚动到目标位置
                                //document.querySelector(anchor).scrollIntoView(true);
                                this.jumped = 1;
                            }
                        })
                    },500);
                }
            },
            /**
             * 点赞
             */
            likeClick(item) {
                if(!this.$store.getters.getUser){
                    this.login();
                }
                if (!item.isLike) {
                    this.$store.dispatch('likeComment',{
                        comment_id:item.id
                    });
                    this.$watch(this.$store.getters.getCommentLikeStatus, function () {
                        if (this.$store.getters.getCommentLikeStatus() == 2) {
                            this.$set(item, "isLike", true);
                            item.likeNum++;
                        }
                        if (this.$store.getters.getCommentLikeStatus() == 3) {
                            this.$message.warning('点赞失败了,请稍后重试！');
                        }
                    });
                } else {
                    this.$message.info('你已经赞过了哦~');
                    // if (item.isLike) {
                    //     item.likeNum--
                    // } else {
                    //     item.likeNum++
                    // }
                    // item.isLike = !item.isLike;
                }
            },

            /**
             * 点击取消按钮
             */
            cancel() {
                this.showItemId = '';
                this.inputComment = this.inputReply = '';
                ++this.comment_buss;

            },

            /**
             * 提交评论
             */
            commitComment() {
                if(!this.$store.getters.getUser){
                    this.login();
                    return false;
                }
                --this.comment_buss;
                if(this.comment_buss<0){
                    this.message.warning('有其他进程在执行评论操作,请稍候重试！')
                }else{
                    if(this.isReply == 1){
                        if(this.inputReply == ''){
                            this.$message.warning('回复内容不能为空');
                            return false;
                        }
                        this.$store.dispatch('postReply',{
                            comment_id:this.idComment,
                            contents:this.inputReply,
                            toUser : this.idReply,
                            art_id : this.$route.params.art_id,
                        });
                        this.loader = this.$loading({
                            lock: true,
                            text: '发布回复中...',
                            spinner: 'el-icon-loading',
                            background: 'rgba(0, 0, 0, 0.7)'
                        });
                        this.$watch(this.$store.getters.getReplyPostStatus, function () {
                            if (this.$store.getters.getReplyPostStatus() == 2) {
                                this.loader.close();
                                this.isReply = 0;
                                this.idReply = 0;
                                this.cancel();
                                this.$message.success('回复成功！');
                            }
                            if (this.$store.getters.getReplyPostStatus() == 3) {
                                this.loader.close();
                                this.$message.warning('回复失败了,请稍后重试！');
                            }
                        });

                    }else{
                        if(this.inputComment == ''){
                            this.$message.warning('评论内容不能为空');
                            return false;
                        }
                        this.$store.dispatch('postComment',{
                            art_id:this.$route.params.art_id,
                            contents:this.inputComment
                        });
                        this.loader = this.$loading({
                            lock: true,
                            text: '发布评论中...',
                            spinner: 'el-icon-loading',
                            background: 'rgba(0, 0, 0, 0.7)'
                        });
                        this.$watch(this.$store.getters.getCommentPostStatus, function () {
                            if (this.$store.getters.getCommentPostStatus() == 2) {
                                this.loader.close();
                                this.$message.success('评论成功!');
                            }
                            if (this.$store.getters.getCommentPostStatus() == 3) {
                                this.loader.close();
                                this.$message.warning('评论失败了,请稍后重试！');
                            }
                        });
                    }
                    ++this.comment_buss;
                }

            },
            deleteComment(item, reply){
                if(!this.$store.getters.getUser){
                    this.login();
                    return false;
                }
                --this.delete_buss;
                if(this.delete_buss < 0){
                    this.$message.error('有其他进程在执行删除操作,请稍后重试！')
                }else{
                    if (reply) {
                        this.$confirm('此操作将永久删除此回复, 是否继续?', '提示', {
                            confirmButtonText: '确定',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }).then(() => {
                            this.$store.dispatch('deleteReply', {
                                reply_id: reply.id,
                                art_id : this.$route.params.art_id,
                            });
                            this.loader = this.$loading({
                                lock: true,
                                text: '删除中...',
                                spinner: 'el-icon-loading',
                                background: 'rgba(0, 0, 0, 0.7)'
                            });
                            this.$watch(this.$store.getters.getReplyDeleteStatus, function () {
                                if (this.$store.getters.getReplyDeleteStatus() == 2) {
                                    this.loader.close();
                                    this.$message.success('已删除');
                                }
                                if (this.$store.getters.getReplyDeleteStatus() == 3) {
                                    this.loader.close();
                                    this.$message.error('删除回复失败了！')
                                }
                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: '已取消删除'
                            });
                        });

                    } else {
                        this.$confirm('此操作将永久删除此评论, 是否继续?', '提示', {
                            confirmButtonText: '确定',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }).then(() => {
                            this.$store.dispatch('deleteComment',{
                                comment_id:item.id,
                                art_id : this.$route.params.art_id,
                            });
                            this.loader = this.$loading({
                                lock: true,
                                text: '删除中...',
                                spinner: 'el-icon-loading',
                                background: 'rgba(0, 0, 0, 0.7)'
                            });
                            this.$watch(this.$store.getters.getCommentDeleteStatus,function () {
                                if(this.$store.getters.getCommentDeleteStatus() == 2){
                                    this.loader.close();
                                    this.$message.success('已删除');
                                }
                                if(this.$store.getters.getCommentDeleteStatus() == 3){
                                    this.loader.close();
                                    this.$message.error('删除评论失败了！')
                                }
                            });
                        }).catch(() => {
                            this.$message({
                                type: 'info',
                                message: '已取消删除'
                            });
                        });
                    }
                    ++this.delete_buss;
                }
            },
            /**
             * 点击评论按钮显示输入框
             * item: 当前大评论
             * reply: 当前回复的评论
             */
            showCommentInput(item, reply) {
                if(!this.$store.getters.getUser){
                    this.login();
                    return false;
                }else{
                    this.idComment = item.id;
                    this.isReply = 1;
                    if (reply) {
                        this.idReply = reply.fromId;
                        this.inputReply = "@" + reply.fromName + " "
                    } else {
                        this.idReply = item.fromId;
                        this.inputReply = ''
                    }
                    this.showItemId = item.id
                }
            },
            login(){
                EventBus.$emit('prompt-login');
            },
            validateReply(reply){
                if (this.$store.getters.getUser){
                    return reply.fromId != this.$store.getters.getUser.id;
                }else{
                    return true;
                }
            }
        }
    }
</script>

<style scoped lang="scss">

    //仿简书评论定义变量
    $color-main: #409EFF;
    $color-success: #67C23A;
    $color-warning: #E6A23C;
    $color-danger: #F56C6C;
    $color-info: #909399;

    $text-main: #303133;
    $text-normal: #606266;
    $text-minor: #909399;  //次要文字
    $text-placeholder: #C0C4CC;
    $text-333: #333;

    $border-first: #DCDFE6;
    $border-second: #E4E7ED;
    $border-third: #EBEEF5;
    $border-fourth: #F2F6FC;

    $content-bg-color: #fff;
    .lv-comment {
        /*padding: 0 10px;*/
        box-sizing: border-box;
        .comment {
            display: flex;
            flex-direction: column;
            /*padding: 10px;*/
            border-bottom: 1px solid $border-fourth;
            .info {
                display: flex;
                align-items: center;
                .avatar {
                    border-radius: 50%;
                }
                .right {
                    display: flex;
                    flex-direction: column;
                    margin-left: 10px;
                    .name {
                        font-size: 16px;
                        color: $text-main;
                        margin-bottom: 5px;
                        font-weight: 500;
                    }
                    .date {
                        font-size: 12px;
                        color: $text-minor;
                    }
                }
            }
            .content {
                font-size: 16px;
                color: $text-main;
                line-height: 20px;
                padding: 10px 0;
            }
            .control {
                display: flex;
                align-items: center;
                font-size: 14px;
                color: $text-minor;
                .like {
                    display: flex;
                    align-items: center;
                    margin-right: 20px;
                    cursor: pointer;
                    &.active, &:hover {
                        color: $color-main;
                    }
                    .iconfont {
                        font-size: 14px;
                        margin-right: 5px;
                    }
                }
                .comment-reply {
                    padding:0 5px;
                    display: flex;
                    align-items: center;
                    cursor: pointer;
                    &:hover {
                        color: $text-333;
                    }
                    .iconfont {
                        font-size: 16px;
                        margin-right: 5px;
                    }
                    .comment-delete{
                        &:hover {
                            color: #F56C6C;
                        }
                    }
                }

            }
            .reply {
                margin: 10px 0;
                border-left: 2px solid $border-first;
                .item {
                    margin: 0 10px;
                    padding: 10px 0;
                    border-bottom: 1px dashed $border-third;
                    .reply-content {
                        display: flex;
                        align-items: center;
                        font-size: 14px;
                        color: $text-main;
                        .from-name {
                            color: $color-main;
                        }
                        .to-name {
                            color: $color-main;
                            margin-left: 5px;
                            margin-right: 5px;
                        }
                    }
                    .reply-bottom {
                        display: flex;
                        align-items: center;
                        margin-top: 6px;
                        font-size: 12px;
                        color: $text-minor;
                        .reply-text {
                            display: flex;
                            align-items: center;
                            margin-left: 10px;
                            cursor: pointer;
                            &:hover {
                                color: $text-333;
                            }
                            .icon-comment {
                                margin-right: 5px;
                            }
                        }
                    }
                }
                .write-reply {
                    display: flex;
                    align-items: center;
                    font-size: 14px;
                    color: $text-minor;
                    padding: 10px;
                    cursor: pointer;
                    &:hover {
                        color: $text-main;
                    }
                    .el-icon-edit {
                        margin-right: 5px;
                    }
                }
                .fade-enter-active, fade-leave-active {
                    transition: opacity 0.5s;
                }
                .fade-enter, .fade-leave-to {
                    opacity: 0;
                }
                .input-wrapper {
                    padding: 10px;
                    .gray-bg-input, .el-input__inner {
                        /*background-color: #67C23A;*/
                        background-color: #f2f2f2;
                    }
                    .btn-control {
                        display: flex;
                        justify-content: flex-end;
                        align-items: center;
                        padding-top: 10px;
                        .cancel {
                            font-size: 16px;
                            color: $text-normal;
                            margin-right: 20px;
                            cursor: pointer;
                            &:hover {
                                color: $text-333;
                            }
                        }
                        .confirm {
                            font-size: 16px;
                        }
                    }
                }
            }
        }
    }
    @media only screen and (max-width: 683px) {
        .lv-comment .comment .reply .input-wrapper .btn-control{
            justify-content: flex-start;
        }
    }

</style>