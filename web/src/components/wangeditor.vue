<template>
  <div>
    <div ref="editor" style="text-align:left"></div>
    <!-- <button v-on:click="">查看内容</button> -->
  </div>
</template>

<script>
    import E from 'wangeditor'
    import {_API,config} from '../config.js'

    export default {
      name: 'editor',
      props: ['inittxt'],
      data () {
        return {
          editorContent: ''
        }
      },
      // methods: {
      //   getContent: function () {
      //       vue.$emit('listenChange',this.editorContent);
      //   }
      // },
      mounted() {
        this.editor = new E(this.$refs.editor);
        this.editor.customConfig.uploadImgServer = _API+"wangeditor";
        this.editor.customConfig.onchange = (html) => {
          this.$emit('listenEditor',html)
        }
        this.editor.create();
        this.editor.txt.html(this.inittxt);
      },
      updated(){
        this.editor.txt.html(this.inittxt);
      }
    };
</script>

<style>
.w-e-toolbar .w-e-menu{ padding: 5px; }
</style>
