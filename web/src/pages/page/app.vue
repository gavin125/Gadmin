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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="page_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
              <th width="150">标题</th>
              <th>banner</th>
              <th width="150">操作</th>
            </tr>
            <tr v-for="item in pages">
              <td class="align-middle">{{item.name}}</td>
              <td><img :src="item.src" alt=""></td>
             <td class="align-middle"><a :href="'page_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
            </tr>
            </tbody>
          </table>
        </div>     
      </div>
    </div>

    <!-- foot -->
    <xggFoot></xggFoot>

    <!-- alert -->
    <b-alert class='alert' :variant="alert.type" :dismissible='alert.close' :show="alert.show">{{alert.msg}}</b-alert>
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
      menucurr:'单页面',
      items: [{text: '网站管理中心',active: true},{text: '单页面',active: true}],
      
      manager:{uid:0,uname:''},
      pages:[{id:0,name:'1',src:'2'}],
			
			alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },

  mounted () {
    this.$axios.get(_API+"page")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.pages=res.data.data.pages;  
      }else if(res.data.errcode==401){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
    
  },

  methods:{
    timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',close:true,msg:msg+'~ '+n+'后自动关闭'};
        setTimeout(function(){that.timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
      }
    },

    update(id){
      let that=this;
      that.pages.forEach(function(v,i){
        if(v.id==id){that.pages.splice(i,1);}
      })
    },

    del(id){
      this.$axios.get(_API+"page/del?id="+id)
      .then((res)=>{
        if(res.data.errcode==0){
          this.timer(3,'删除单页面成功');
          this.update(id);
        }else if(res.data.errcode==401){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    }
  },

};

</script>
