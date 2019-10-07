<template>
    <el-row type="flex" justify="center">
        <el-col :xs="23" :sm="22" :md="21" :lg="20">
            <div class="archive">
                <div class="count">归档：{{archives.meta.count}}篇</div>
                <el-timeline>
                    <el-timeline-item v-for="(activity, index) in archives.data" :key="index" color="grey" :timestamp="activity.created_at" placement="top" @mouseenter="hoverLine(activity)">
                        <div class="line-item">
                            <router-link :to="{name:'art',params: {art_id:activity.article_id}}" tag="span">{{activity.title}}</router-link>
                        </div>
                    </el-timeline-item>
                </el-timeline>
            </div>
        </el-col>
    </el-row>
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

<style scoped>
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
</style>