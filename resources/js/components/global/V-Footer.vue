<template>
    <el-col class="tag">
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <i class="el-icon-folder-opened"></i>
                <span>联系我们</span>
            </div>
            <div v-for="category in categories" class="text item">
                <router-link :to="{name:'分类文章',params: {category:category.id}}">
                    <a href="#"><span style="float: left;">{{category.name}}</span></a>
                    <el-tag style="float: right" size="mini" class="category-item" type="success"  @click="">[{{category.count}}]</el-tag>
                    <div style="clear:both;"></div>
                </router-link>
            </div>
        </el-card>
    </el-col>
</template>

<script>
    export default {
        name: 'category',
        data(){
            return{

            }
        },
        computed:{
        },
        created() {
        }
    }
</script>

<style scoped>
    .box-card .item:hover {
        color: #409EFF;
        cursor: pointer;
    }

    .box-card span {
        font-weight: bold;
    }

    .card-icon {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }

    .category-item {
        margin-right: 10px;
    }
</style>