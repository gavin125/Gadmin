<template>
  <div class="xggWrap">
    <!-- head -->
    <xggHead :manager='manager'></xggHead>

    <!-- menu -->
    <xggMenu :menu='menu'></xggMenu>

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
                <tr><td width="120">网站名称</td><td colspan="3">{{website.name}}</td></tr>
                <tr><td>文章数量</td><td>{{website.num_article}}</td><td width="120">文章组数</td><td>{{website.num_article_group}}</td></tr>
                <tr><td>产品数量</td><td>{{website.num_product}}</td><td>产品组数</td><td>{{website.num_product_group}}</td></tr>
                <tr><td>单页面数</td><td>{{website.num_page}}</td><td>日志数量</td><td>{{website.num_log}}</td></tr>
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
                <tr><td>PHP版本</td><td>{{website.php_ver}}</td><td>MySQL版本</td><td>{{website.mysql_ver}}</td><td>服务器操作系统</td><td>{{website.os_ip}}</td></tr>
                <tr><td>服务器版本</td><td colspan="3">{{website.server_ver}}</td><td>文件上传限制</td><td>{{website.max_filesize}}</td></tr>
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
      manager:{id:0,name:''},
      menu:[
        [{
          text:'管理首页',link:'index.html',active:true
        }],
        [{
          text:'系统设置',link:'system.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:false
        }],
        [{
          text:'文章分类',link:'article_group.html',active:false},{
          text:'文章列表',link:'article.html',active:false
        }],
        [{
          text:'产品分类',link:'product_group.html',active:false},{
          text:'产品列表',link:'product.html',active:false
        }],
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '管理首页',active: true
      }],
      pages:[{id:1,name:'单页名称'}],
      website:{
        name:'',
        num_article:0,
        num_article_group:0,
        num_product:0,
        num_product_group:0,
        num_page:0,
        num_log:0,

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
    // 获取管理员信息
    this.$axios.get(_API+"admin/getname")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager={id:res.data.data.uid,name:res.data.data.uname};
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
    
    //获取单页面信息
    this.$axios.get(_API+"page/getindex")
    .then((res)=>{
      if(res.data.errcode==0){
        this.pages=res.data.data;
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})

    //获取网站和服务器信息
    this.$axios.get(_API+"index/getwebsite")
    .then((res)=>{
      if(res.data.errcode==0){
        this.website=res.data.data;
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})

    //获取网站和服务器信息
    this.$axios.get(_API+"index/getloginlog")
    .then((res)=>{
      if(res.data.errcode==0){
        console.log(res.data.data);
        this.login_log=res.data.data;
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
  },

};

</script>
