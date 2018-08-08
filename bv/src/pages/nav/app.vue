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
        <h3 class="border-bottom pb-2 mb-4">导航栏 <a href="nav_edit.html" class="btn btn-success btn-sm float-right">添加导航</a></h3>
        <b-tabs>
          <b-tab title="主导航" active>
            <div class="py-3 text-center Xggfz14">
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
            <div class="py-3 text-center Xggfz14">
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
            <div class="py-3 text-center Xggfz14">
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
      items: [{
        text: '网站管理中心',
        active: true
      }, {
        text: '导航栏',
        active: true
      }],
    }
  },

  mounted () {
    
    
  },

};

</script>
