<template>
  <div class="position-absolute column">
    <b-list-group class="border-bottom" v-for='group in menu'>
      <b-list-group-item v-for='item in group' class="border-0 rounded-0 py-2" :href='item.link' v-text='item.text' :variant='item.active?"success":""'></b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>


export default {

  data () {
    return {
      menu:[
        [{
          text:'管理首页',link:'index.html',active:true
        }],
        [{
          text:'系统设置',link:'system.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:false},{
          text:'手机版',link:'mobile.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:false
        }],
      ]
    }
  },



};

</script>
