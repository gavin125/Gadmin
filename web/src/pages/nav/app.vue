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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="nav_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <b-tabs>
          <b-tab title="主导航" active>
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">导航名称</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td>手机版1</td>
                 <td class="text-left">http://www.gavin.com/0018/m</td>
                 <td align="center">10</td>
                 <td align="center"><a href="nav_edit.html">编辑</a> | <a href="#">删除</a></td>
                </tr>
                </tbody>
              </table>
            </div>
          </b-tab>
          <b-tab title="顶部">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">导航名称</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td> 手机版2</td>
                 <td class="text-left">http://www.gavin.com/0018/m</td>
                 <td align="center">10</td>
                 <td align="center"><a href="nav_edit.html">编辑</a> | <a href="#">删除</a></td>
                </tr>
                </tbody>
              </table>
            </div>
          </b-tab>
          <b-tab title="底部">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">导航名称</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td> 手机版3</td>
                 <td class="text-left">http://www.gavin.com/0018/m</td>
                 <td align="center">10</td>
                 <td align="center"><a href="nav_edit.html">编辑</a> | <a href="#">删除</a></td>
                </tr>
                </tbody>
              </table>
            </div>
          </b-tab>
          <b-tab title="手机版">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
                 <th width="150">导航名称</th>
                 <th class="text-left">链接地址</th>
                 <th width="80">排序</th>
                 <th width="150">操作</th>
                </tr>
                <tbody>
                <tr>
                 <td> 手机版3</td>
                 <td class="text-left">http://www.gavin.com/0018/m</td>
                 <td align="center">10</td>
                 <td align="center"><a href="nav_edit.html">编辑</a> | <a href="#">删除</a></td>
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
          text:'导航栏',link:'nav.html',active:true},{
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
        text: '导航栏',active: true
      }]
    }
  },

  mounted () {
    
    
  },

};

</script>
