<template>
          <el-container style="display:block">
               <el-row>
                    <el-form :model="form">
                         <el-col :xs="24" :sm="24" :md="24" :lg="24">
                              <el-form-item label="">
                                   <el-input
                                           placeholder="请输入文章标题"
                                           suffix-icon="el-icon-bank-card"
                                           v-model="form.title">
                                   </el-input>
                              </el-form-item>
                         </el-col>
                              <mavon-editor ref=md :toolbars="markdownOption" v-model="form.handbook" :ishljs = "true" @imgAdd="$imgAdd"  style="height: 100%"></mavon-editor>
                         <div class="tag">
                              <el-tag
                                      :key="tag"
                                      v-for="tag in tagDynamicTags"
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
                              <el-button v-else class="button-new-tag" size="small" @click="tagShowInput">+ 新标签</el-button>
                         </div>
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
                              <el-button v-else class="button-new-tag" size="small" @click="showInput">+ New Tag</el-button>
                              <el-select v-model="form.category" placeholder="请选择">
                                   <el-option
                                           v-for="item in categories"
                                           :key="item.id"
                                           :label="item.name"
                                           :value="item.id">
                                   </el-option>
                              </el-select>
                         </div>
                         <div class="private">
                              <el-switch
                                      style="display: block"
                                      v-model="form.public"
                                      active-color="#13ce66"
                                      inactive-color="#ff4949"
                                      active-text="公开"
                                      inactive-text="私有">
                              </el-switch>
                         </div>

                          <el-col :xs="24" :sm="24" :md="24" :lg="24">
                              <el-button class="bl-right" type="primary" @click="publishArticle">发布博客</el-button>
                              <el-button class="bl-right" type="primary" @click="saveArticle">保存草稿</el-button>
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
                    tagDynamicTags: [],
                    form: {
                         title: '',
                         handbook: "#### 开始你的创作",
                         tags: '',
                         category:'',
                         public:true,
                    },
               };
          },
          watch: {
               categoryDynamicTags:function (val) {
                    this.$store.dispatch('addCategories', {
                         name: val[0],
                    })
               }
          },
          computed:{
               categories(){
                  return this.$store.getters.getCategories;
               }
          },
          methods: {
               // 绑定@imgAdd event
               $imgAdd(pos, $file) {
                    // 第一步.将图片上传到服务器.
                    var formdata = new FormData();
                    formdata.append('upload_file', $file);
                    this.$store.dispatch('upLoadImages',formdata);
                    this.$watch(this.$store.getters.getImagesUpLoadStatus, function () {
                         if (this.$store.getters.getImagesUpLoadStatus() === 2) {
                              this.$refs.md.$img2Url(pos, this.$store.getters.getImages);
                         }
                    });
               },
               tagHandleClose(tag) {
                    this.tagDynamicTags.splice(this.tagDynamicTags.indexOf(tag), 1);
               },
               tagShowInput() {
                    this.tagInputVisible = true;
                    this.$nextTick(_ => {
                         this.$refs.saveTagInput.$refs.input.focus();
                    });
               },
               tagHandleInputConfirm() {
                    let tagInputValue = this.tagInputValue;
                    if (tagInputValue && this.tagDynamicTags.length<3 && !this.tagDynamicTags.includes(tagInputValue)) {
                         this.tagDynamicTags.push(tagInputValue);
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
                    if (categoryInputValue && this.categoryDynamicTags.length < 1 && !this.categories.includes(categoryInputValue)){
                         this.categoryDynamicTags.push(categoryInputValue);
                         this.$store.dispatch('loadCategories', {
                              id: this.$store.getters.getUser.id,
                         });
                    }
                    this.categoryInputVisible = false;
                    this.categoryInputValue = '';
               },
               publishArticle(){

               },
               saveArticle(){

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
</style>