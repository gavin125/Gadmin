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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">轮播图 <a href="carousel_edit.html" class="btn btn-success btn-sm float-right">添加轮播图</a></h3>
        <b-tabs>
          <b-tab title="网站版" active>
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">描述</th>
                 <th >图片</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td class="align-middle">汽车领域</td>
                 <td><img src="../../assets/20130514acunau_thumb.jpg" alt=""></td>
                 <td class="align-middle text-left ">http://www.gavin.com/0018/m</td>
                 <td class="align-middle">10</td>
                 <td class="align-middle"><a href="carousel_edit.html">编辑</a> | <a href="#">删除</a></td>
                </tr>
                </tbody>
              </table>
            </div> 
          </b-tab>
          <b-tab title="手机版">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">描述</th>
                 <th >图片</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td class="align-middle">汽车领域</td>
                 <td><img src="../../assets/20130514acunau_thumb.jpg" alt=""></td>
                 <td class="align-middle text-left ">http://www.gavin.com/0018/m</td>
                 <td class="align-middle">10</td>
                 <td class="align-middle"><a href="carousel_edit.html">编辑</a> | <a href="#">删除</a></td>
                </tr>
                </tbody>
              </table>
            </div>
          </b-tab>
        </b-tabs>
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
          text:'管理首页',link:'index.html',active:false
        }],
        [{
          text:'系统设置',link:'system.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:true},{
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
        text: '轮播图',active: true
      }]
    }
  },

  mounted () {
    
    
  },

};

</script>
