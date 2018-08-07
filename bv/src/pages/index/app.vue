<template>
  <div class="XggWrap">
    <!-- head -->
    <div class="XggHead">
      <h1 class="logo">网站管理中心</h1>
      <nav class="nav">
        <a href="">查看网站</a>
        <a href="">清除缓存</a>
        <p class="pull-right">
          <span class="job">超级管理员</span>
          <span class="name dropdown-toggle">admin<a class="hide sub" href="">编辑资料</a></span>
          <a href="">退出</a>
        </p>
      </nav>
    </div>
    
    <!-- menu -->
    <div class="XggMenu">
      <ul class="menu">
        <li><a href="">管理首页</a></li>
      </ul>
      <ul class="menu">
        <li><a href="">系统设置</a></li>
        <li><a href="">自定义导航栏</a></li>
        <li><a href="">首页幻灯广告</a></li>
        <li><a href="">单页面管理</a></li>
        <li><a href="">手机版</a></li>
      </ul>
      <ul class="menu">
        <li><a href="">网站管理员</a></li>
        <li><a href="">数据备份</a></li>
        <li><a href="">操作记录</a></li>
      </ul>
    </div>

    <!-- main -->
    <div class="XggMain">
      <b-breadcrumb :items="items"/>
      <div class="main">
        <h2 class="title">管理首页</h2>
        <h3 class="subtitle">单页面快速管理</h3>
      </div>
      <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    </div>

    <!-- foot -->
    <div class="foot text-secondary">
      Copyright © 2015-{{year}} <a class="text-success" href="https://www.xiaoguge.cn">小古哥</a> 版权所有
    </div>
  </div>
</template>

<style>
  @import 'style.scss';
</style>

<script>



export default {
  data () {
    return {
      items: [{
        text: '网站管理中心',
        active: true
      }, {
        text: '管理首页',
        active: true
      }]
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    
    
  },

};

</script>
