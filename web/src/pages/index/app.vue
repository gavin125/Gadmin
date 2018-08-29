<template>
  <div class="xggWrap">
    <!-- head -->
    <xggHead :manager='manager'></xggHead>
    <!-- menu -->
    <xggMenu :menucurr='menucurr'></xggMenu>
    
    <!-- main -->
    <div class="xggMain bg-white pb-2 border-left border-bottom">
      <b-breadcrumb :items="items" class="rounded-0 border-bottom py-2 px-4 bg-light"/>
      <div class="container-fluid px-4">
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}}</h3>
        <h5 class="border-bottom pb-2 my-3 text-muted">单页面快速管理</h5>
        <div class="mb-4">
          <a href="" class="btn btn-secondary mr-3 px-4" v-for='p in pages' v-text='p.name'></a>
        </div>
        <div class="row">
          <div class="col-8">
            <h5 class="border-bottom pb-2 mt-2 text-muted">网站信息</h5>
            <table class="table table-bordered">

              <tbody>
                <tr><td width="120">网站名称</td><td colspan="3">{{total.name}}</td></tr>
                <tr><td>文章数量</td><td>{{total.num_article}}</td><td width="120">文章组数</td><td>{{total.num_article_group}}</td></tr>
                <tr><td>产品数量</td><td>{{total.num_product}}</td><td>产品组数</td><td>{{total.num_product_group}}</td></tr>
                <tr><td>单页面数</td><td>{{total.num_page}}</td><td>日志数量</td><td>{{total.num_log}}</td></tr>
              </tbody>
            </table>
          </div>
          <div class="col-4">
            <h5 class="border-bottom pb-2 mt-2 text-muted">登录记录</h5>
            <table class="table table-bordered">
              <thead>
                <tr class="bg-light"><th width="120">IP地址</th><th>操作时间</th></tr>
              </thead>
              <tbody>
                <tr v-for='ll in login_log'><td>{{ll.last_ip}}</td><td>{{ll.add_time}}</td></tr>
              </tbody>
            </table>
          </div>

          <div class="col-12">
            <h5 class="border-bottom pb-2 mt-2 text-muted">服务器信息</h5>
            <table class="table table-bordered">
              <tbody>
                <tr><td>PHP版本</td><td>{{server.php_ver}}</td><td>MySQL版本</td><td>{{server.mysql_ver}}</td><td>服务器操作系统</td><td>{{server.os_ip}}</td></tr>
                <tr><td>服务器版本</td><td colspan="3">{{server.server_ver}}</td><td>文件上传限制</td><td>{{server.max_filesize}}</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- foot -->
    <xggFoot></xggFoot>
    

  </div>
</template>

<style>
@import '../../assets/common.scss';
</style>

<script>

import xggHead from '../../components/xggHead.vue'
import xggMenu from '../../components/xggMenu.vue'
import xggFoot from '../../components/xggFoot.vue'
let _API='http://localhost/Gadmin/api/';

export default {
  components: {
    xggHead,
    xggMenu,
    xggFoot
  },
  data () {
    return {
      menucurr:'管理首页',
      items: [{text: '网站管理中心',active: true},{text: '管理首页',active: true}],
      
      manager:{uid:0,uname:''},
      pages:[{id:1,name:'单页名称'}],
      total:{
        name:'',
        num_article:0,
        num_article_group:0,
        num_product:0,
        num_product_group:0,
        num_page:0,
        num_log:0,
      },
      server:{
        php_ver:'',
        mysql_ver:'',
        server_ver:'',
        os_ip:'',
        max_filesize:''
      },
      login_log:[{last_ip:'-',add_time:'-'},{last_ip:'-',add_time:'-'},{last_ip:'-',add_time:'-'}]
    }
  },

  mounted () {
    this.$axios.get(_API+"index")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.pages=res.data.data.pages;
        this.total=res.data.data.total;
        this.server=res.data.data.server;
        this.login_log=res.data.data.login_log;
      }else if(res.data.errcode==401){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
  },

};

</script>
