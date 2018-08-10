<template>
  <div>
    <script id="editor" type="text/plain" ></script>
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
        editor: null
      }
    },
    mounted() {
      //初始化UE
      const _this = this;
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