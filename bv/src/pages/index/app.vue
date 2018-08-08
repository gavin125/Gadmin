<template>
  <div class="XggWrap">
    <!-- head -->
    <b-navbar toggleable="md" type="dark" variant="success" class="px-0">
      <b-navbar-brand class="m-0 p-0 text-center column" href="#">网站管理中心</b-navbar-brand>
      <b-navbar-nav>
        <b-nav-item href="#">查看网站</b-nav-item>
        <b-nav-item href="#">清除缓存</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown text="管理员 admin" right>
          <b-dropdown-item href="#">编辑资料</b-dropdown-item>
          <b-dropdown-item href="#">退出</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>


    <!-- menu -->
    <div class="position-absolute column">
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="index.html" variant="success">管理首页</b-list-group-item>
      </b-list-group>
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="system.html">系统设置</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="nav.html">导航栏</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="carousel.html">轮播图</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="page.html">单页面</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="mobile.html">手机版</b-list-group-item>
      </b-list-group>
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="manager.html">管理员</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="log.html">操作记录</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="backup.html">数据备份</b-list-group-item>
      </b-list-group>
    </div>

    <!-- main -->
    <div class="XggMain bg-white pb-2 border-left border-bottom">
      <b-breadcrumb :items="items" class="rounded-0 border-bottom py-2"/>
      <div class="container-fluid">
        <h4 class="border-bottom pb-2 mb-4">管理首页</h4>
        <h5 class="border-bottom pb-2 text-secondary">单页面管理</h5>
        <div class="mb-3">
          <a href="" class="btn btn-outline-success mr-2">公司介绍</a>
          <a href="" class="btn btn-outline-success mr-2">联系方式</a>
        </div>
        <div class="row Xggfz14">
          <div class="col-8">
            <h5 class="border-bottom pb-2 text-secondary">网站基本信息</h5>
            <table class="table table-bordered rounded">
             <tbody><tr>
              <td width="120">单页面数：</td>
              <td><strong>6</strong></td>
              <td width="100">文章总数：</td>
              <td><strong>2</strong></td>
             </tr>
             <tr>
              <td>上师总数：</td>
              <td><strong>3</strong></td>
              <td>系统语言：</td>
              <td><strong>zh_cn</strong></td>
             </tr>
             <tr>
              <td>URL 重写：</td>
              <td><strong>关闭</strong></td>
              <td>编码：</td>
              <td><strong>UTF-8</strong></td>
             </tr>
             <tr>
              <td>站点地图：</td>
              <td><strong>开启</strong></td>
              <td>站点模板：</td>
              <td><strong>default</strong></td>
             </tr>
             <tr>
              <td>DouPHP版本：</td>
              <td><strong>v1.3 Release 20170424</strong></td>
              <td>安装日期：</td>
              <td><strong>2017-11-06</strong></td>
             </tr>
            </tbody></table>
          </div>
          <div class="col-4">
            <h5 class="border-bottom pb-2 text-secondary">登录记录</h5>

            <table class="table table-bordered">
              <thead>
                <tr class="bg-light">
                  <th>IP地址</th>
                  <th>操作时间</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>127.0.0.1</td>
                  <td>2018-08-08 12:01:26</td>
                </tr>
                <tr>
                  <td>127.0.0.1</td>
                  <td>2018-08-08 12:01:26</td>
                </tr>
                <tr>
                  <td>127.0.0.1</td>
                  <td>2018-08-08 12:01:26</td>
                </tr>
                <tr>
                  <td>127.0.0.1</td>
                  <td>2018-08-08 12:01:26</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <h5 class="border-bottom pb-2 text-secondary">服务器信息</h5>
        <table class="table table-bordered Xggfz14">
              <tbody><tr>
               <td width="130" valign="top">PHP 版本：</td>
               <td valign="top">5.6.28 </td>
               <td width="130" valign="top">MySQL 版本：</td>
               <td valign="top">5.5.5-10.1.19-MariaDB</td>
               <td width="150" valign="top">服务器操作系统：</td>
               <td valign="top">WINNT(127.0.0.1)</td>
              </tr>
              <tr>
               <td valign="top">文件上传限制：</td>
               <td valign="top">2M</td>
               <td valign="top">GD 库支持：</td>
               <td valign="top">是</td>
               <td valign="top">Web 服务器：</td>
               <td valign="top">Apache/2.4.23 (Win32) OpenSSL/1.0.2h PHP/5.6.28</td>
              </tr>
             </tbody></table>
        
      </div>

    </div>

    <!-- foot -->
    <div class="text-secondary text-center py-2 Xggfz14">
      Copyright © 2015-{{year}} <a class="text-success" href="https://www.xiaoguge.cn">小古哥</a> 版权所有
    </div>
  </div>
</template>

<style>
@import '../../assets/common.scss';
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
