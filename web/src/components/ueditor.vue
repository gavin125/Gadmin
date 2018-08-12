<template>
  <div>
    <script id="editor" type="text/plain" > {{defaultMsg}}</script>
  </div>
</template>

<script>

	import {jQuery} from '../../umeditor/third-party/jquery-1.7.2.min';	

	import '../../umeditor/umeditor.config';
	import '../../umeditor/umeditor.min';
	import '../../umeditor/lang/zh-cn/zh-cn';

  export default {
   
    data() {
      return {
        editor: null,
        defaultMsg: '这里是UE测试',
        config: {
          toolbars: [
            ['fullscreen', 'source', 'undo', 'redo'],
    ['bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
          ],
          initialFrameWidth : 800,
          initialFrameHeight : 300
        },
      }
    },
    mounted() {
      this.editor = UM.getEditor('editor',this.config);
    },
    destoryed() {
      this.editor.destory();
    },
    methods:{
      getUEContent: function(){
       return this.editor.getContent();
      }
    }
  };
</script>

<style>
  @import '../../umeditor/themes/default/css/umeditor.min.css';
</style>