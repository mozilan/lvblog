<template>
    <div class="edit el-scrollbar__wrap">
        <el-backtop target=".page-component__scroll .el-scrollbar__wrap"></el-backtop>
    <el-row type="flex" justify="center" style="padding-bottom:30px">
        <el-col :xs="24" :sm="24" :md="16" :lg="16" :style="edit.styles.col">
                    <div class="title-animate">
                         <div :class="ffl_input">
                              <label for="title" class="ffl-label">文章标题</label>
                              <input type="text" id="title" name="title" v-model="form.title">
                         </div>
                    </div>
                    <el-form :model="form" :style="form_style">
                         <mavon-editor ref=md :toolbars="markdownOption" v-model="form.handbook" :ishljs = "true" @imgAdd="$imgAdd" :style="styles.mavon_style"></mavon-editor>
                         <div class="title-animate bl-margin_bottom-title bl-margin-top">
                              <div :class="ffl_input">
                                   <label for="excerpt" class="ffl-label">文章摘要 <span>(可选)</span></label>
                                   <textarea id="excerpt" name="excerpt" v-model="form.excerpt"></textarea>
                              </div>
                         </div>
                         <div class="bl-margin-top">
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
                                        <el-button v-else class="button-new-tag" size="mini" round @click="tagShowInput">+ 添加标签</el-button>
                                   </div>
                              </el-form-item>
                         </div>
                         <div class="bl-margin-top">
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
                                        <el-button v-else class="button-new-tag" size="mini" round @click="showInput">+ 添加分类</el-button>
                                        <el-select v-model="form.category_id" placeholder="请选择" style="width: 100px">
                                             <el-option
                                                     v-for="item in categories"
                                                     :key="item.id"
                                                     :label="item.name"
                                                     :value="item.id">
                                             </el-option>
                                        </el-select>
                                   </div>
                              </el-form-item>
                         </div>

                         <div>
                              <el-form-item label="发布形式：" id="btn1">
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
                         </div>
                          <div>
                              <el-button v-if="this.$route.params.art" class="bl-public" type="primary" size="medium" round @click="updateArticle(0)">更新博客</el-button>
                              <el-button v-if="!this.$route.params.art" class="bl-public" type="primary" size="medium" round @click="publishArticle(0)">发布博客</el-button>
                              <el-button v-if="!this.$route.params.art"  class="bl-save" type="" size="medium" round @click="publishArticle(1)">保存草稿</el-button>
                              <el-button v-if="this.$route.params.art"  class="bl-save" type="" size="medium" round @click="updateArticle(1)">保存草稿</el-button>
                         </div>
                    </el-form>
            </el-col>
        </el-row>
        <WhellMenu></WhellMenu>
    </div>
</template>
<script>
     // Local Registration
     import {mavonEditor} from 'mavon-editor'
     import 'mavon-editor/dist/css/index.css'
     import { EventBus } from '../event-bus'
     import floating_form_labels from 'floating-form-labels'
     import WhellMenu from '../components/Wheel-menu'
     export default {
          name: 'editor',
          components: {
              floating_form_labels,
              mavonEditor,
              WhellMenu
          },
          data() {
               return {
                   styles:{
                       mavon_style:{
                           minHeight :'',
                           zIndex:900,
                       },
                   },
                    ffl_input:'ffl-wrapper bl-margin_bottom-title',
                    form_style:{
                         height:'',
                    },
                    loader:'',
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
                         excerpt:'',
                    },
                    categoryNameArr:[],
               };
          },
          mounted(){
               $('.ffl-wrapper').floatingFormLabels();
               this.$nextTick(() => {
                   this.scroll = new Bscroll(this.$refs.wrapper, {})
               });
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
               edit(){
                   //console.log(this.$store.getters.getScreenEditor);
                   return this.$store.getters.getScreenEditor;
               }
          },
          methods: {
               initCategoryAddStatus(){-
                 this.$store.dispatch('initCategoryAddStatus');
               },
               // 绑定@imgAdd event
               $imgAdd(pos, $file) {
                    // 第一步.将图片上传到服务器.
                    var formdata = new FormData();
                    formdata.append('image', $file);
                    formdata.append('type', 'article');
                    this.$store.dispatch('upLoadImages',formdata);
                    this.$watch(this.$store.getters.getImagesUpLoadStatus, function () {
                         if (this.$store.getters.getImagesUpLoadStatus() === 2) {
                              this.$refs.md.$img2Url(pos, this.$store.getters.getImages.data.path);
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
                    if(tagInputValue.length > 18){
                         this.$message({
                              message: "标签名称不能超过18个单位长度",
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
                    this.categoryInputValue = '';
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
                                        EventBus.$emit('open-message', {
                                             notification: this.$store.getters.getCategoriesAddResponseMessages(),
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
                    this.loader = this.$loading({
                         lock: true,
                         text: '发布中...',
                         spinner: 'el-icon-loading',
                         background: 'rgba(0, 0, 0, 0.7)'
                    });
                    this.$store.dispatch('addArticle',{
                         title:this.form.title,
                         body:this.form.handbook,
                         tags:this.form.tagDynamicTags,
                         category_id:this.form.category_id,
                         excerpt:this.form.excerpt,
                         target: !this.form.public && target === 0 ? 2 : target
                    });
                    this.$watch(this.$store.getters.getArticleAddStatus, function () {
                         if (this.$store.getters.getArticleAddStatus()  === 2) {
                              this.loader.close();
                              if(this.form.title.toString().length >  15){
                                   this.form.title = this.form.title.toString().substring(0,15)+'...  ';
                              }
                              EventBus.$emit('open-message', {
                                   notification: this.form.title + (target===0 ? ' 发布成功!' :' 已保存到草稿箱'),
                                   type: 'success'
                              });
                              this.$store.dispatch('initArticleAddStatus');
                              this.form.title = '';
                              this.form.handbook = '';
                              this.form.tagDynamicTags = '';
                              this.form.excerpt= '';
                              this.$router.push('/blog');
                         }
                         if (this.$store.getters.getArticleAddStatus()  === 3) {
                              this.loader.close();
                              EventBus.$emit('open-message', {
                                   notification: this.$store.getters.getArticleAddResponseMessages(),
                                   type: 'error'
                              });
                         }
                    });
               },
               updateArticle(target){
                   this.loader = this.$loading({
                       lock: true,
                       text: '更新中...',
                       spinner: 'el-icon-loading',
                       background: 'rgba(0, 0, 0, 0.7)'
                   });
                   this.$store.dispatch('updateArticle',{
                       id:this.$route.params.art,
                       title:this.form.title,
                       body:this.form.handbook,
                       tags:this.form.tagDynamicTags,
                       category_id:this.form.category_id,
                       excerpt:this.form.excerpt,
                       target: !this.form.public && target === 0 ? 2 : target
                   });
                   this.$watch(this.$store.getters.getArticleUpdateStatus, function () {
                       if (this.$store.getters.getArticleUpdateStatus()  === 2) {
                           this.loader.close();
                           if(this.form.title.toString().length >  15){
                               this.form.title = this.form.title.toString().substring(0,15)+'...  ';
                           }
                           EventBus.$emit('open-message', {
                               notification: this.form.title + (target===0 ? ' 更新成功!' :' 已保存到草稿箱'),
                               type: 'success'
                           });
                           this.$store.dispatch('initArticleUpdateStatus');
                           this.form.title = '';
                           this.form.handbook = '';
                           this.form.tagDynamicTags = '';
                           this.form.excerpt= '';
                           this.$router.push('/blog');
                       }
                       if (this.$store.getters.getArticleUpdateStatus()  === 3) {
                           this.loader.close();
                           EventBus.$emit('open-message', {
                               notification: this.$store.getters.getArticleUpdateResponseMessages(),
                               type: 'error'
                           });
                       }
                   });
               }
          },
          created(){
               if(window.innerWidth > 683){
                   this.$store.dispatch('fullScreenEditor');
               }
               this.$store.dispatch('loadCategories',{
                    id:this.$store.getters.getUser.id,
               });
               if(this.$route.params.art && (this.$route.query.user == this.$store.getters.getUser.id )){
                   this.$store.dispatch('loadArticle',{
                       art_id : this.$route.params.art
                   });
                   this.$watch(this.$store.getters. getArticleLoadStatus, function () {
                       if(this.$store.getters. getArticleLoadStatus() === 2) {
                           let article = this.$store.getters.getArticle.data;
                           this.form.handbook = article.body;
                           this.form.title = article.title;
                           this.form.excerpt = article.excerpt;
                           this.form.category_id = article.category_id;
                           let i = 0;
                           while (i < article.tag.length){
                               this.form.tagDynamicTags.push(article.tag[i].name);
                               ++i;
                           }
                           this.form.public = article.target === 0 ? true : false;
                           this.ffl_input = 'ffl-wrapper bl-margin_bottom-title ffl-floated';
                       }
                       else if(this.$store.getters. getArticleLoadStatus() === 3) {
                           this.$message.error('文章不存在或网络连接失败');
                       }
                   });
               }else {
                   if(this.$route.params.art){
                       this.$message.warning('不要抄袭别人的文章哦！来自己写一篇叭～')
                   }
               }
               var h = window.innerHeight-430;//可见区域高度
               // this.form_style.height = h+'px';
               this.styles.mavon_style.minHeight = window.innerHeight-500+'px';
          },
         destroyed() {
             if(window.innerWidth > 683){
                 this.$store.dispatch('cancelScreenEditor');
             }
         }
     }
</script>
<style scoped lang="scss">
     .edit{
         padding-bottom: 30px;
         #excerpt{
             font-size: 14px;
         }

         .title-animate {
             .ffl-wrapper {
                 position: relative;
                 display: block;
                 padding-top: 1rem;
             }
             .ffl-wrapper .ffl-label {
                 transition-property: all;
                 transition-duration: 200ms;
                 transition-timing-function: ease;
                 transition-delay: 0s;
                 position: absolute;
                 white-space: nowrap;
                 max-width: 100%;
                 text-overflow: ellipsis;
                 overflow: hidden;
                 pointer-events: none;
                 top: 1.25rem;
             }
             .ffl-wrapper.ffl-floated .ffl-label {
                 top: 0;
             }

             .ffl-label {
                 color: #909090;
                 line-height: 1.2;
             }
             .ffl-floated .ffl-label {
                 color: #0289f3;
                 font-size: 0.75rem;
             }

             form {
                 max-width: 30rem;
                 margin: 2rem auto 0;
                 background-color: #ffffff;
                 padding: 1rem;
             }
             form:after {
                 content: "";
                 display: block;
                 clear: both;
             }

             input,
             textarea,
             select {
                 transition: border-bottom 100ms ease;
                 display: block;
                 width: 100%;
                 padding: 0;
                 margin-bottom: 1rem;
                 box-shadow: none;
                 appearance: none;
                 outline: none;
                 background-color: transparent;
                 border-style: none;
                 border-bottom-width: 1px;
                 border-bottom-style: solid;
                 border-bottom-color: rgba(0, 0, 0, 0.2);
                 height: 1.875rem;
             }
             input:hover,
             textarea:hover,
             select:hover {
                 border-bottom-width: 1px;
                 border-bottom-color: #909090;
             }
             input:focus,
             textarea:focus,
             select:focus {
                 border-bottom-width: 1px;
                 border-bottom-color: #0289f3;
             }

             textarea {
                 resize: none;
                 min-height: 1.875rem;
             }

             label > span {
                 color: #cccccc;
             }

             [type="submit"] {
                 transition: background-color 0.3s ease;
                 border: none;
                 background-color: #0289f3;
                 color: #ffffff;
                 padding: 0.5rem 1rem;
                 text-transform: uppercase;
                 cursor: pointer;
                 margin-top: 1rem;
                 float: right;
             }
             [type="submit"]:hover, [type="submit"]:focus {
                 background-color: #027bda;
             }
         }
     }
</style>
<style lang="scss">
     #editor {
          margin: auto;
          width: 80%;
          height: 580px;
     }
     .edit{
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
             margin-left: 0;
             vertical-align: bottom;
         }
         .bl-public{
             float: left;
         }
         .bl-save{
             float: right;
         }
         .bl-margin-top{
             margin-top: 20px ;
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
         .el-textarea{
             font-size: 16px;
         }
     }

</style>