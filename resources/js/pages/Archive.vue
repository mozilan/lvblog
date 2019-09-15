<template>
    <div class="archive">
        <div class="count">归档：234天</div>
        <el-timeline>
            <el-timeline-item v-for="(activity, index) in activities" :key="index" :color="activity.color" :timestamp="activity.timestamp" placement="top" @mouseenter="hoverLine(activity)">
                <div class="line-item">
                    <router-link to="/article" tag="span">{{activity.content}}</router-link>
                </div>
            </el-timeline-item>
        </el-timeline>
    </div>
</template>

<script>
    export default {
        name: 'archive',
        data() {
            return {
                activities: [{
                    content: 'Laravel+Vue构建API应用',
                    timestamp: '2019-04-15'
                }, {
                    content: 'Linux系统运维',
                    timestamp: '2019-04-13'
                }, {
                    content: 'PHP从入门到出家',
                    timestamp: '2019-04-11'
                }]
            };
        },
        methods: {
            hoverLine(activity) {
                activity.color = "#409eff"
            }
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