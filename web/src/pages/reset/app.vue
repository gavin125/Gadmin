<template>
  <div class="bg">
    <div class="main">
      <h3 class="text-center text-dark mb-1">内容管理系统</h3>
      <h6 class="text-center text-success mb-4">Content Management System</h6>
      <b-form class="form rounded px-5 py-4 mb-2" @submit="onSubmit">
        <h5 class="text-center text-secondary mb-4">密码重置</h5>
        <b-form-row class="mb-3">
          <b-form-input v-model="manager.user_name" type="text" placeholder='账号'/></b-form-input>
        </b-form-row>
        <b-form-row class="mb-3">
          <b-form-input v-model="manager.email" type="text" placeholder='邮箱'/></b-form-input>
        </b-form-row>
        <b-form-row class="mb-3">
          <b-button type="submit" class="btn-block" variant="success">找回密码</b-button>
        </b-form-row>
        <b-form-row class="justify-content-center">
          <a class='text-secondary px-2' href="login.html">返回登录</a> | <a class='text-secondary px-2' href="">返回首页</a>
        </b-form-row>
      </b-form>

      <!-- foot -->
      <xggFoot></xggFoot>
    </div>
  </div>
</template>

<style>
  body{font-size: 12px; }
  .bg{ position: absolute; width: 100%; height: 100%; background: -webkit-radial-gradient(#fff 10%,#ccc 80%); display: flex; justify-content: center; align-items: center; }
  .main{ width: 300px; height: 400px; }
  .form{ background: rgba(0,0,0,.2); }
</style>

<script>

import {_API,config} from '../../config.js'
import xggFoot from '../../components/xggFoot.vue'


export default {
  components: {
    xggFoot
  },
  data () {
    return {
      manager:{user_name:'',email:''},
    }
  },

  mounted () {},
  methods:{
    onSubmit:function(){
      console.log('submit')
    }
  }

};

</script>
