<template>
  <div class="xggWrap">
    <!-- head -->
    <xggHead :manager='manager'></xggHead>

    <!-- menu -->
    <xggMenu :menu='menu'></xggMenu>

    <!-- main -->
    <div class="xggMain bg-white pb-2 border-left border-bottom">
      <b-breadcrumb :items="items" class="rounded-0 border-bottom py-2 bg-light"/>
      <div class="container-fluid">
        <h4 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}}</h4>
        <h5 class="border-bottom pb-2 text-muted">单页面管理</h5>
        <div class="mb-3">
          <a href="" class="btn btn-dark mr-2 px-4">公司介绍</a>
          <a href="" class="btn btn-dark mr-2 px-4">联系方式</a>
        </div>
        <div class="row">
          <div class="col-8">
            <h5 class="border-bottom pb-2 text-muted">网站基本信息</h5>
            <table class="table table-bordered rounded">
             <tbody><tr>
              <td width="120">单页面数：</td>
              <td><strong>6</strong></td>
              <td width="100">文章总数：</td>
              <td><strong>2</strong></td>
             </tr>
             <tr>
              <td>商品总数：</td>
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
            <h5 class="border-bottom pb-2 text-muted">登录记录</h5>

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

        <h5 class="border-bottom pb-2 text-muted">服务器信息</h5>
        <table class="table table-bordered">
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
      manager:{id:1,name:'admin2'},
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
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '管理首页',active: true
      }]
    }
  },

  mounted () {
    
    
  },

};

</script>
