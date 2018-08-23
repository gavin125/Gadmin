<template>
  <div class="bg">
    <div class="main">
      <h3 class="text-center text-dark mb-1">内容管理系统</h3>
      <h6 class="text-center text-success mb-4">Content Management System</h6>
      <b-form class="form rounded px-5 py-4 mb-2" @submit.prevent="onSubmit">
        <h5 class="text-center text-secondary mb-4">管理员登录</h5>
        <b-form-row class="mb-3">
          <b-form-input v-model="manager.user_name" type="text" placeholder='账号'/></b-form-input>
        </b-form-row>
        <b-form-row class="mb-3">
          <b-form-input v-model="manager.pass_word" type="password" placeholder='密码'/></b-form-input>
        </b-form-row>
        <b-form-row class="mb-3">
          <b-button type="submit" class="btn-block" variant="success">登录</b-button>
        </b-form-row>
        <!-- <b-form-row class="justify-content-center">
          <a class='text-secondary px-2' href="reset.html">忘记密码？</a> | <a class='text-secondary px-2' href="">返回首页</a>
        </b-form-row> -->
      </b-form>

      <!-- foot -->
      <xggFoot></xggFoot>
    </div>
    <!-- alert -->
    <b-alert class='alert' variant="danger" dismissible :show="alert.show">{{alert.msg}}</b-alert>
  </div>
</template>

<style>
  body{font-size: 12px; }
  .bg{ position: absolute; width: 100%; height: 100%; background: -webkit-radial-gradient(#fff 10%,#ccc 80%); display: flex; justify-content: center; align-items: center; }
  .main{ width: 300px; height: 400px; }
  .form{ background: rgba(0,0,0,.2); }
  .alert{ position: absolute; bottom:0; left: 50%; transform: translate(-50%,0); }
</style>

<script>

import xggFoot from '../../components/xggFoot.vue';
let _API='http://localhost/Gadmin/api/';

export default {
  components: {
    xggFoot
  },
  data () {
    return {
      manager:{user_name:'',pass_word:''},
      alert:{show:false,msg:'这是一个错误提示！'}
    }
  },

  mounted () {},

  methods:{
    _transformRequest:function(data){//转换josn数据
      let ret = ''
      for(let it in data){ret+=encodeURIComponent(it)+'='+encodeURIComponent(data[it])+'&';}
      return ret
    },

    onSubmit:function(){
      if(this.manager.user_name==="" || this.manager.pass_word===""){
        this.alert={show:true,msg:'用户名与密码不能为空！'};
      }else{
        this.$axios.post(_API+"admin/login",this._transformRequest(this.manager))
        .then((res)=>{
          console.log(res.data);
          if(res.data.errcode!=0){
            this.alert={show:true,msg:res.data.errmsg};
          }else{
            window.location.href='index.html'; 
          };
        }).catch(function(err){console.log(err);})
      }
    }
  }

};

</script>
