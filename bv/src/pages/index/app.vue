<template>
  <div class="XggWrap">
    <!-- head -->
    <xggHead></xggHead>

    <!-- menu -->
    <xggMenu></xggMenu>

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

export default {
  components: {
    xggHead,
    xggMenu,
    xggFoot
  },
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

  mounted () {
    
    
  },

};

</script>
