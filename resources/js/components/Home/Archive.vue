<template>
    <div class="archive">
        <div class="count">归档：{{archives.meta.count}}篇</div>
        <div class="block">
            <el-timeline v-for="(activity, index) in archives.data"  :key="index">
                <el-timeline-item :timestamp="activity.created_at" placement="top">
                    <router-link :to="{name:'查看文章',params: {art_id:activity.article_id}}">
                        <el-card>
                            <h4> {{activity.title}}</h4>
                            <p>{{activity.user.data.name}} 提交于 {{activity.created_at}}</p>
                        </el-card>
                    </router-link>
                </el-timeline-item>
            </el-timeline>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'archive',
        data () {
            return {
                meta:{
                    count:0,
                }
            }
        },
        computed:{
            archives(){
                if(this.$store.getters.getArchives.data === undefined){
                    this.$store.getters.getArchives.meta = this.meta;
                }
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
            font-size: 18px;
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