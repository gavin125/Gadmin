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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="manager_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
              <th>管理员</th>
              <th>email</th>
              <th>添加时间</th>
              <th>最后登录时间</th>
              <th width="150">操作</th>
            </tr>
            <tr v-for="item in managers">
             <td>{{item.user_name}}</td>
             <td>{{item.email}}</td>
             <td>{{item.add_time}}</td>
             <td>{{item.last_login}}</td>
             <td align="center"><a :href="'manager_edit.html?id='+item.id">编辑</a><span v-if='item.id!=manager.uid'> | <span class='btn-link' v-on:click="del(item.id)">删除</span></span></td>
            </tr>
          </table>
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
      menucurr:'管理员',
      items: [{text: '网站管理中心',active: true},{text: '管理员',active: true}],
      
      manager:{uid:0,uname:''},
      managers:[{id:0,user_name:'1',email:'2',add_time:'3',last_login:'4'}],
			
			alert:{show:false,type:'danger',msg:'这是一个错误提示！'},
    }
  },

  mounted () {
    this.$axios.get(_API+"manager")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.managers=res.data.data.managers;  
      }else if(res.data.errcode==401){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
    
  },

  methods:{
    timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',msg:msg+'~ '+n+'后自动关闭'};
        setTimeout(function(){that.timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
      }
    },

    update(id){
      let that=this;
      that.managers.forEach(function(v,i){
        if(v.id==id){that.managers.splice(i,1);}
      })
    },

    del(id){
      this.$axios.get(_API+"manager/del?id="+id)
      .then((res)=>{
        if(res.data.errcode==0){
          this.timer(3,'删除管理员成功');
          this.update(id);
        }else if(res.data.errcode==401){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    }
  },

};

</script>
