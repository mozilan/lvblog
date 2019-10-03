<template>
          <el-container style="display:block">
               <el-row>
                    <el-form :model="form">
                         <el-col :xs="24" :sm="24" :md="24" :lg="24" class="bl-margin_bottom-title">
                              <el-form-item label="">
                                   <el-input
                                           placeholder="请输入文章标题"
                                           suffix-icon="el-icon-bank-card"
                                           v-model="form.title">
                                   </el-input>
                              </el-form-item>
                         </el-col>
                              <mavon-editor ref=md :toolbars="markdownOption" v-model="form.handbook" :ishljs = "true" @imgAdd="$imgAdd"  style="height: 100%"></mavon-editor>
                         <el-col :xs="24" :sm="24" :md="18" :lg="12" class="bl-margin-top">
                              <el-form-item label="文章标签：">
                                   <div class="tag">
                                        <el-tag
                                                :key="tag"
                                                v-for="tag in form.tagDynamicTags"
                                                closable
                                                :disable-transitions="false"
                                                @close="tagHandleClose(tag)">
                                             {{tag}}
                                        </el-tag>
                                        <el-input
                                                class="input-new-tag"
                                                v-if="tagInputVisible"
                                                v-model="tagInputValue"
                                                ref="saveTagInput"
                                                size="small"
                                                @keyup.enter.native="tagHandleInputConfirm"
                                                @blur="tagHandleInputConfirm"
                                        >
                                        </el-input>
                                        <el-button v-else class="button-new-tag" size="small" @click="tagShowInput">+ 添加标签</el-button>
                                   </div>
                              </el-form-item>
                         </el-col>
                         <el-col :xs="24" :sm="24" :md="18" :lg="12" class="bl-margin-top">
                              <el-form-item label="文章分类：">
                                   <div class="category">
                                        <el-tag
                                                :key="category"
                                                v-for="category in categoryDynamicTags"
                                                closable
                                                :disable-transitions="false"
                                                @close="handleClose(category)">
                                             {{category}}
                                        </el-tag>
                                        <el-input
                                                class="input-new-tag"
                                                v-if="categoryInputVisible"
                                                v-model="categoryInputValue"
                                                ref="saveCategoryInput"
                                                size="small"
                                                @keyup.enter.native="handleInputConfirm"
                                                @blur="handleInputConfirm"
                                        >
                                        </el-input>
                                        <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加分类</el-button>
                                        <el-select v-model="form.category_id" placeholder="请选择">
                                             <el-option
                                                     v-for="item in categories"
                                                     :key="item.id"
                                                     :label="item.name"
                                                     :value="item.id">
                                             </el-option>
                                        </el-select>
                                   </div>
                              </el-form-item>
                         </el-col><el-col :xs="24" :sm="18" :md="12" :lg="6">
                              <el-form-item label="发布形式：">
                                   <div class="private">
                                        <el-switch
                                                style="display: block;line-height:40px;"
                                                v-model="form.public"
                                                active-color="#13ce66"
                                                inactive-color="#ff4949"
                                                active-text="公开"
                                                inactive-text="私有">
                                        </el-switch>
                                   </div>
                              </el-form-item>
                         </el-col>
                          <el-col :xs="24" :sm="24" :md="24" :lg="24">
                              <el-button class="bl-public" type="primary" @click="publishArticle(0)">发布博客</el-button>
                              <el-button class="bl-save" type="primary" @click="publishArticle(1)">保存草稿</el-button>
                         </el-col>
                    </el-form>
               </el-row>
          </el-container>
</template>
<script>
     // Local Registration
     import {mavonEditor} from 'mavon-editor';
     import 'mavon-editor/dist/css/index.css';
     export default {
          name: 'editor',
          components: {
               mavonEditor
               // or 'mavon-editor': mavonEditor
          },
          data() {
               return {
                    markdownOption: {
                         bold: true, // 粗体
                         italic: true, // 斜体
                         header: true, // 标题
                         underline: true, // 下划线
                         strikethrough: true, // 中划线
                         mark: true, // 标记
                         superscript: true, // 上角标
                         subscript: true, // 下角标
                         quote: true, // 引用
                         ol: true, // 有序列表
                         ul: true, // 无序列表
                         link: true, // 链接
                         imagelink: true, // 图片链接
                         code: true, // code
                         table: true, // 表格
                         fullscreen: true, // 全屏编辑
                         readmodel: true, // 沉浸式阅读
                         htmlcode: true, // 展示html源码
                         help: true, // 帮助
                         /* 1.3.5 */
                         undo: true, // 上一步
                         redo: true, // 下一步
                         trash: true, // 清空
                         save: true, // 保存（触发events中的save事件）
                         /* 1.4.2 */
                         navigation: true, // 导航目录
                         /* 2.1.8 */
                         alignleft: true, // 左对齐
                         aligncenter: true, // 居中
                         alignright: true, // 右对齐
                         /* 2.2.1 */
                         subfield: true, // 单双栏模式
                         preview: true, // 预览
                    },
                    categoryDynamicTags: [],
                    categoryInputVisible: false,
                    categoryInputValue: '',
                    tagInputVisible: false,
                    tagInputValue: '',
                    form: {
                         title: '',
                         handbook: "#### 开始你的创作",
                         category_id:'',
                         tagDynamicTags: [],
                         public:true,
                    },
                    categoryNameArr:[],
               };
          },
          watch: {
          },
          computed:{
               categories(){
                  this.categoryNameArr = [];
                  let catArrObj = this.$store.getters.getCategories;
                  for (let i in  catArrObj) {
                       this.categoryNameArr.push(catArrObj[i].name);
                  }
                  return this.$store.getters.getCategories;
               },
          },
          methods: {
               initCategoryAddStatus(){
                 this.$store.dispatch('initCategoryAddStatus');
               },
               // 绑定@imgAdd event
               $imgAdd(pos, $file) {
                    // 第一步.将图片上传到服务器.
                    var formdata = new FormData();
                    formdata.append('upload_file', $file);
                    this.$store.dispatch('upLoadImages',formdata);
                    this.$watch(this.$store.getters.getImagesUpLoadStatus, function () {
                         if (this.$store.getters.getImagesUpLoadStatus() === 2) {
                              this.$refs.md.$img2Url(pos, this.$store.getters.getImages);
                         }else if (this.$store.getters.getImagesUpLoadStatus() === 3) {
                              this.$message({
                                   message: "上传失败",
                                   type: 'error'
                              });
                              this.$refs.md.$img2Url(pos, null);
                         }
                    });
               },
               tagHandleClose(tag) {
                    this.form.tagDynamicTags.splice(this.form.tagDynamicTags.indexOf(tag), 1);
               },
               tagShowInput() {
                    this.tagInputVisible = true;
                    this.$nextTick(_ => {
                         this.$refs.saveTagInput.$refs.input.focus();
                    });
               },
               tagHandleInputConfirm() {
                    let tagInputValue = this.tagInputValue;
                    if(tagInputValue.length > 10){
                         this.$message({
                              message: "标签名称不能超过10个单位长度",
                              type: 'warning'
                         });
                         this.tagInputVisible = false;
                         this.tagInputValue = '';
                         return 0;
                    }
                    if(tagInputValue && this.form.tagDynamicTags.length < 3 && !this.form.tagDynamicTags.includes(tagInputValue)) {
                         this.form.tagDynamicTags.push(tagInputValue);
                    }
                    this.tagInputVisible = false;
                    this.tagInputValue = '';
               },
               handleClose(category) {
                    this.categoryDynamicTags.splice(this.categoryDynamicTags.indexOf(category), 1);
               },
               showInput() {
                    this.categoryInputVisible = true;
                    this.$nextTick(_ => {
                         this.$refs.saveCategoryInput.$refs.input.focus();
                    });
               },
               handleInputConfirm() {
                    let categoryInputValue = this.categoryInputValue;
                    if(categoryInputValue === ''){
                         this.$message({
                              message: "分类名称不能为空",
                              type: 'warning'
                         });
                         this.categoryInputVisible = false;
                         this.categoryInputValue = '';
                         return 0;
                    }else if(categoryInputValue.length > 10){
                         this.$message({
                              message: "分类名称不能超过10个单位长度",
                              type: 'warning'
                         });
                         this.categoryInputVisible = false;
                         this.categoryInputValue = '';
                         return 0;
                    }
                    else if(this.categoryDynamicTags.length === 1){
                         this.$message({
                              message: "一次只能添加一个分类",
                              type: 'warning'
                         });
                         this.categoryInputVisible = false;
                         this.categoryInputValue = '';
                    }
                    else{
                         if (categoryInputValue && !this.categoryNameArr.includes(categoryInputValue)){
                              this.initCategoryAddStatus();
                              this.$store.dispatch('addCategories', {
                                   name: categoryInputValue,
                              });
                              this.$watch(this.$store.getters.getCategoriesAddStatus, function () {
                                   if (this.$store.getters.getCategoriesAddStatus() === 2) {
                                        this.categoryDynamicTags.push(categoryInputValue);
                                        this.$store.dispatch('loadCategories', {
                                             id: this.$store.getters.getUser.id,
                                        });
                                   }
                                   if (this.$store.getters.getCategoriesAddStatus() === 3) {
                                        this.categoryDynamicTags = [];
                                        this.$message({
                                             message: this.$store.getters.getCategoriesAddResponseMessages(),
                                             type: 'error'
                                        });
                                   }
                              });
                         }else{
                              this.$message({
                                   message: "分类名称已存在",
                                   type: 'warning'
                              });
                         }
                    }
                    this.categoryInputVisible = false;
                    this.categoryInputValue = '';
               },
               publishArticle(target){
                    console.log(this.form.tags);
                    this.$store.dispatch('addArticle',{
                         title:this.form.title,
                         body:this.form.handbook,
                         tags:this.form.tagDynamicTags,
                         category_id:this.form.category_id,
                         target: !this.form.public && target === 0 ? 2 : target
                    })
               },
          },
          created() {
               this.$store.dispatch('loadCategories',{
                    id:this.$store.getters.getUser.id,
               });
          }
     }
</script>
<style>
     #editor {
          margin: auto;
          width: 80%;
          height: 580px;
     }
     .el-tag + .el-tag {
          margin-left: 10px;
     }
     .button-new-tag {
          margin-left: 10px;
          height: 32px;
          line-height: 30px;
          padding-top: 0;
          padding-bottom: 0;
     }
     .input-new-tag {
          width: 90px;
          margin-left: 10px;
          vertical-align: bottom;
     }
     .bl-public{
          float: left;
     }
     .bl-save{
          float: right;
     }
     .bl-margin-top{
          margin-top: 40px ;
     }
     .button-new-tag{
          margin-left:0;
          height:40px;
     }
     .el-input--small .el-input__inner{
          height: 40px;
     }
     .el-switch__label{
          height:auto;
     }
     .bl-margin_bottom-title{
          margin-bottom:15px;
     }
</style>