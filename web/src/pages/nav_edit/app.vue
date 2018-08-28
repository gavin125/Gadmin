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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="nav.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3">
          <b-form>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">系统内容</div>
              <div class="col-4"><b-form-select size='sm' v-model="navitem.info" :options="navitem.infoOps" class="mb-3" /></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">导航名称</div>
              <div class="col-4"><b-form-input size='sm' v-model="navitem.name" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">位置</div>
              <div class="col-4 py-1"><b-form-radio-group plain v-model="navitem.position" :options="navitem.positionOps" name="radioInline"></b-form-radio-group></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">链接地址</div>
              <div class="col-4"><b-form-input size='sm' v-model="navitem.link" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">上级分类</div>
              <div class="col-4"><b-form-select size='sm' v-model="navitem.parent" :options="navitem.parentOps" class="mb-3" /></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">排序</div>
              <div class="col-4"><b-form-input size='sm' v-model="navitem.srot" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row>
              <div class="col-2 text-right py-1"></div>
              <div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
            </b-form-row>
          </b-form>
        </div>
        
      </div>

    </div>

    <!-- foot -->
    <xggFoot></xggFoot>
    
    <!-- alert -->
    <b-alert class='alert' :variant="alert.type" :show="alert.show">{{alert.msg}}</b-alert>
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
      menucurr:'导航栏',
      items: [{text: '网站管理中心',active: true},{text: '导航栏',active: true}],
      
      manager:{uid:0,uname:''},
      navitem:{
        info:0,
        infoOps:[{ value:'0',text:'系统内容'},{value:'1',text:'其他'}],
        name:'',
        position:'main',
        positionOps:[{ value:'main',text:'主导航'},{value:'top',text:'顶部'},{value:'bottom',text:'底部'},{value:'mobile',text:'手机版'}],
        link:'',
        parent:0,
        parentOps:[{ value:'0',text:'系统内容'},{value:'1',text:'其他'}],
        srot:0
      },
			
			alert:{show:false,type:'danger',msg:'这是一个错误提示！'},      
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    //获取信息进行编辑
    let id=this._getQueryString("id")?this._getQueryString("id"):'null';
    
  },
  methods:{
    //解析url参数
    _getQueryString(name){
      var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
      var r = window.location.search.substr(1).match(reg);
      if (r != null) {return unescape(r[2]); }
      return null;
    },
  }
};

</script>
