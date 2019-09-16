<template>
    <div class="edit">
        <Editor></Editor>
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <img class="card-icon" src="../../assets/lianjie.png"/>
                <span>写博客</span>
            </div>
        </el-card>
    </div>
</template>

<script>
    import Editor from '../components/Editor'
    export default {
        name: "Edit",
        data(){
            return{
                value:'',
            }
        },
        components: {
            Editor
            // or 'mavon-editor': mavonEditor
        }
    }
</script>

<style scoped>

</style>