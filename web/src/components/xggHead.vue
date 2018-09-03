<template>
    <!-- head -->
    <b-navbar toggleable="md" type="dark" variant="success" class="px-0">
      <b-navbar-brand class="m-0 p-0 text-center column" href="#">内容管理系统 <sub>Beta-1.0</sub></b-navbar-brand>
      <b-navbar-nav>
        <b-nav-item href="#">查看网站</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown :text='"管理员 "+manager.uname' right>
          <b-dropdown-item>编辑资料</b-dropdown-item>
          <b-dropdown-item v-on:click='logout()'>退出</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
</template>

<script>
let _API='http://localhost/Gadmin/api/';
export default {
  props:['manager'],
  data () {
    return {}
  },
  mounted () {},
	methods:{
		logout(){
			this.$axios.get(_API+"manager/logout")
			.then((res)=>{
				if(res.data.errcode==0){
					window.location.href='login.html'; 
				};
			}).catch(function(err){console.log(err);})
		}
	}
};

</script>
