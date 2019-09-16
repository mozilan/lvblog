<template>
     <div id="editor">
          <mavon-editor ref=md :toolbars="markdownOption" v-model="handbook" :ishljs = "true" @imgAdd="$imgAdd"  style="height: 100%"></mavon-editor>
     </div>
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
                    pos:'',
                    posStatus:0,
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
                    handbook: "#### 开始你的创作 ####"
               };
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
          },
     }
</script>
<style>
     #editor {
          margin: auto;
          width: 80%;
          height: 580px;
     }
</style>