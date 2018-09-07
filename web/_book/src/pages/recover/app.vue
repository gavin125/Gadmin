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
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
             <th width="120">文件名</th>
             <th>大小</th>
             <th>备份日期</th>
             <th>操作</th>
            </tr>
            <tbody>
            <tr>
             <td>case.sql</td>
             <td>1.59K</td>
             <td>2018-05-15 09:40:40</td>
             <td><a href="#">导入</a> | <a href="#">下载</a> | <a href="#">删除</a></td>
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

import {_API,config} from '../../config.js'
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
      menucurr:'数据备份',
      items: [{text: '网站管理中心',active: true},{text: '恢复备份',active: true}],
      
      manager:{uid:0,uname:''},
    }
  },

  mounted () {
    
    
  },

};

</script>
