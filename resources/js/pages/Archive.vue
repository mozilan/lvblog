<template>
    <div class="archive">
        <el-row type="flex" justify="center">
            <el-col :xs="24" :sm="24" :md="20" :lg="20">
                <div class="count">归档：{{archives.meta.count}}篇</div>
                <div class="block">
                    <el-timeline v-for="(activity, index) in archives.data">
                        <el-timeline-item :timestamp="activity.created_at" placement="top">
                            <router-link :to="{name:'查看文章',params: {art_id:activity.article_id}}" tag="span">
                                <el-card>
                                    <h4> {{activity.title}}</h4>
                                    <p>{{activity.user.name}} 提交于 {{activity.created_at}}</p>
                                </el-card>
                            </router-link>
                        </el-timeline-item>
                        <!--<el-timeline-item timestamp="2018/4/3" placement="top">-->
                            <!--<el-card>-->
                                <!--<h4>更新 Github 模板</h4>-->
                                <!--<p>王小虎 提交于 2018/4/3 20:46</p>-->
                            <!--</el-card>-->
                        <!--</el-timeline-item>-->
                        <!--<el-timeline-item timestamp="2018/4/2" placement="top">-->
                            <!--<el-card>-->
                                <!--<h4>更新 Github 模板</h4>-->
                                <!--<p>王小虎 提交于 2018/4/2 20:46</p>-->
                            <!--</el-card>-->
                        <!--</el-timeline-item>-->
                    <!--</el-timeline>-->
                <!--</div>-->

                <!--<el-timeline>-->
                    <!--<el-timeline-item v-for="(activity, index) in archives.data" :key="index" color="grey" :timestamp="activity.created_at" placement="top" @mouseenter="hoverLine(activity)">-->
                        <!--<div class="line-item">-->
                            <!--<router-link :to="{name:'查看文章',params: {art_id:activity.article_id}}" tag="span">{{activity.title}}</router-link>-->
                        <!--</div>-->
                    <!--</el-timeline-item>-->
                <!--</el-timeline>-->
                        </el-timeline>
                    </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        name: 'archive',
        data () {
            return {
            }
        },
        computed:{
            archives(){
                return this.$store.getters.getArchives;
            }
        },
        created(){
            this.$store.dispatch('loadArchives',{
                user : this.$route.params.user ? this.$route.params.user : 1
            });
        }
    }
</script>

<style scoped lang="scss">
    .archive{
        padding-top: 20px;
        .line-item {
            display: inline-block;
        }

        .line-item:hover {
            cursor: pointer;
            color: #409EFF;
        }

        .count {
            margin-bottom: 20px;
            font-size: 20px;
            color: #E6A23C;
        }
        @media only screen and (max-width: 683px){
            ul,li {
                margin: 0;
                padding: 0;
            }
        }
    }

</style>