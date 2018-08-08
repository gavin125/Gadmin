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
        <h3 class="border-bottom pb-2 mb-4">导航栏 <a href="nav.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
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
              <div class="col-4"><b-form-select size='sm' v-model="navitem.type" :options="navitem.typeOps" class="mb-3" /></div>
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
      navitem:{
        info:0,
        infoOps:[{ value:'0',text:'系统内容'},{value:'1',text:'其他'}],
        name:'',
        position:1,
        positionOps:[{ value:1,text:'主导航'},{value:2,text:'顶部'},{value:3,text:'底部'}],
        link:'',
        type:0,
        typeOps:[{ value:'0',text:'系统内容'},{value:'1',text:'其他'}],
        srot:0
      },
      items: [{
        text: '网站管理中心',
        active: true
      }, {
        text: '导航栏',
        active: true
      }],
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    
    
  },

};

</script>
