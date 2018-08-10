<template>
  <div class="text-secondary text-center py-2 Xggfz14">
    Copyright © 2015-{{year}} <a class="text-success" href="https://www.xiaoguge.cn">小古哥</a> 版权所有
  </div>
</template>

<script>

export default {
  data () {
    return {}
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
};

</script>
