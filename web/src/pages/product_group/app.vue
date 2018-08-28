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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="product_group_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
             <th width="120">编号</th>
             <th>分类名称</th>
             <th>父级分类</th>
             <th>排序</th>
             <th width="150">操作</th>
            </tr>
            <tbody>
            <tr>
             <td>1</td>
             <td>产品分类1</td>
             <td>无</td>
             <td>10</td>
             <td><a href="product_group.html">编辑</a> | <a href="#">删除</a></td>
            </tr>
            </tbody>
          </table>
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
      menucurr:'产品分类',
      items: [{text: '网站管理中心',active: true},{text: '产品分类',active: true}],
      
      manager:{uid:0,uname:''},
    }
  },

  mounted () {
    
    
  },

};

</script>
