<template>
    <!-- head -->
    <b-navbar toggleable="md" type="dark" variant="success" class="px-0">
      <b-navbar-brand class="m-0 p-0 text-center column" href="#">网站管理中心</b-navbar-brand>
      <b-navbar-nav>
        <b-nav-item href="#">查看网站</b-nav-item>
        <b-nav-item href="#">清除缓存</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown :text='"管理员 "+manager.name' right>
          <b-dropdown-item href="#">编辑资料</b-dropdown-item>
          <b-dropdown-item href="#">退出</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
</template>


<script>



export default {
  data () {
    return {
      manager:{
        id:1,
        name:'admin1'
      }
    }
  },

  mounted () {
    
  },

};

</script>
