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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="product_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <div class="py-3 text-center ">
          <b-form @submit.prevent="onFilter">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="filter.group" :options="filter.groupOps" size='sm'/></div>
              <div class="col-2"><b-form-input size='sm' v-model="filter.text" type="text"/></b-form-input></div>
              <div class="col-2 text-left"><b-button size='sm' type="submit" class="px-5" variant="secondary">筛 选</b-button></div>
            </b-form-row>
          </b-form>
          <table class="table table-bordered">
            <tr class="bg-light">
             <th><input type="checkbox">全选</th>
             <th>编号</th>
             <th>缩略图</th>
             <th class="text-left">名称</th>
             <th>分类</th>
             <th>添加日期</th>
             <th>浏览量</th>
             <th>操作</th>
             <th>首页显示</th>
            </tr>
            <tbody>
            <tr>
             <td class="align-middle"><input type="checkbox"></td>
             <td class="align-middle">11</td>
             <td><img src="../../assets/20130514acunau_thumb.jpg" alt=""></td>
             <td class="align-middle text-left">哈工智能</td>
             <td class="align-middle">产品分类1</td>
             <td class="align-middle">2018-05-18</td>
             <td class="align-middle">125</td>
             <td class="align-middle"><a href="product_edit.html">编辑</a> | <a href="#">删除</a></td>
            </tr>
            </tbody>
          </table>
          <b-form @submit.prevent="onExecute">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="execute.action" :options="execute.actionOps" size='sm'/></div>
              <div class="col-2" v-show='execute.action==2'><b-form-select v-model="execute.group" :options="execute.groupOps" size='sm'/></div>
              <div class="col-2 text-left"><b-button size='sm' type="submit" class="px-5" variant="success">执 行</b-button></div>
            </b-form-row>
          </b-form>
          
        </div>    
        <div class="text-center">
          <b-pagination-nav align="center" base-url="?page=" :number-of-pages="pagination.totel" v-model="pagination.current" />
        </div> 
      </div>
    </div>

    <!-- foot -->
    <xggFoot></xggFoot>
  </div>
</template>

<style>
@import '../../assets/common.scss';
.page-link{color: #28a745;}
.page-item.active .page-link{background-color: #28a745; border-color: #28a745;}
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
          text:'数据备份',link:'backup.html',active:false
        }],
        [{
          text:'文章分类',link:'article_group.html',active:false},{
          text:'文章列表',link:'article.html',active:false
        }],
        [{
          text:'产品分类',link:'product_group.html',active:false},{
          text:'产品列表',link:'product.html',active:true
        }],
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '产品列表',active: true
      }],
      filter:{
        group:'',
        groupOps:[{ value:0,text:'无'},{value:1,text:'公司动态'},{value:2,text:'行业新闻'}],
        text:''
      },
      execute:{
        action:'',
        actionOps:[{value:1,text:'删除'},{value:2,text:'移动至分类'}],
        group:'',
        groupOps:[{ value:0,text:'无'},{value:1,text:'公司动态'},{value:2,text:'行业新闻'}],
      },
      pagination:{
        current:1,
        totel:10
      }
    }
  },

  mounted () {},

  methods:{
    onFilter:function(){
      console.log(this.filter);
    },
    onExecute:function(){
      console.log(this.execute);
    },
  }

};

</script>
