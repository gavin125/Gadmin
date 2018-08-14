<template>
  <div>
    <div ref="editor" style="text-align:left"></div>
    <!-- <button v-on:click="">查看内容</button> -->
  </div>
</template>

<script>
    import E from 'wangeditor'

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
        var that=this;
        var editor = new E(this.$refs.editor);
        editor.customConfig.uploadImgServer = '../api/upload.php';
        editor.customConfig.uploadImgMaxLength = 5;
        editor.customConfig.onchange = (html) => {
          this.editorContent = html;
          that.$emit('listenEditor',that.editorContent)
        }
        editor.create();
        editor.txt.html(this.inittxt);
      }
    };
</script>

<style>
.w-e-toolbar .w-e-menu{ padding: 5px; }
</style>
