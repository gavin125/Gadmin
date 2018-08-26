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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="recover.html" class="btn btn-success float-right px-4">恢复</a></h3>
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
             <th width="120"><input type="checkbox">全选</th>
             <th>数据表名</th>
             <th>类型</th>
             <th>记录数</th>
             <th>数据</th>
             <th>索引</th>
             <th>碎片</th>
            </tr>
            <tbody>
            <tr>
             <td><input type="checkbox"></td>
             <td>xz_admin</td>
             <td>MyISAM</td>
             <td>2</td>
             <td>144</td>
             <td>2014</td>
             <td>0</td>
            </tr>
            </tbody>
          </table>
          <h5 class="border-bottom pb-2 text-muted text-left">分卷备份设置</h5>
          <b-form>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">文件名</div>
              <div class="col-4 py-1">
                <b-form-input size='sm' v-model="backup.name" type="text"></b-form-input>
              </div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">分卷大小</div>
              <div class="col-4 py-1">
                <b-form-input size='sm' v-model="backup.size" type="text"></b-form-input>
              </div>
            </b-form-row>
            <b-form-row>
              <div class="col-2 text-right py-1"></div>
              <div class="col-4 text-left"><b-button type="submit" class="px-5" variant="success">备 份</b-button></div>
            </b-form-row>
          </b-form>
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
          text:'系统设置',link:'config.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:true
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
        text: '数据备份',active: true
      }],
      backup:{
        name:'',
        size:2048
      }
    }
  },

  mounted () {
    
    
  },

};

</script>
