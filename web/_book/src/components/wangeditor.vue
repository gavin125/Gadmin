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
      props: ['inittxt','test'],
      data () {
        return {}
      },
      mounted() {
        this.editor = new E(this.$refs.editor);
        this.editor.customConfig.uploadImgServer = _API+"wangeditor";
        // this.editor.customConfig.onchange = (html) => {
        //   this.$emit('listenEditor',html)
        // }
        this.editor.create();
        this.editor.txt.html(this.inittxt);
      },
      methods: {
        getContent: function () {return this.editor.txt.html();}
      },
      watch:{
        inittxt:function(newValue,oldValue){this.editor.txt.html(newValue);},
      }
    };
</script>

<style>
.w-e-toolbar .w-e-menu{ padding: 5px; }
</style>
