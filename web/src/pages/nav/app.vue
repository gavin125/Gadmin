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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="nav_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <b-tabs>
          <b-tab title="主导航" active>
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
									<th>编号</th>
                  <th width="150">导航名称</th>
                  <th class="text-left">链接地址</th>
									<th>父级ID</th>
                  <th width="80">排序</th>
                  <th width="150">操作</th>
                </tr>
                <tr v-for="item in nav.main">
                  <td>{{item.id}}</td>
                  <td>{{item.name}}</td>
                  <td class="text-left">{{item.link}}</td>
									<td class="center">{{item.parent_id}}</td>
                  <td align="center">{{item.sort}}</td>
                  <td align="center"><a :href="'nav_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
                </tr>
              </table>
            </div>
          </b-tab>
          <b-tab title="顶部">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
									<th>编号</th>
                  <th width="150">导航名称</th>
                  <th class="text-left">链接地址</th>
									<th>父级ID</th>
                  <th width="80">排序</th>
                  <th width="150">操作</th>
                </tr>
                <tr v-for="item in nav.top">
                  <td>{{item.id}}</td>
                  <td>{{item.name}}</td>
                  <td class="text-left">{{item.link}}</td>
									<td class="center">{{item.parent_id}}</td>
                  <td align="center">{{item.sort}}</td>
                  <td align="center"><a :href="'nav_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
                </tr>
              </table>
            </div>
          </b-tab>
          <b-tab title="底部">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
									<th>编号</th>
                  <th width="150">导航名称</th>
                  <th class="text-left">链接地址</th>
									<th>父级ID</th>
                  <th width="80">排序</th>
                  <th width="150">操作</th>
                </tr>
                <tr v-for="item in nav.bottom">
                  <td>{{item.id}}</td>
                  <td>{{item.name}}</td>
                  <td class="text-left">{{item.link}}</td>
									<td class="center">{{item.parent_id}}</td>
                  <td align="center">{{item.sort}}</td>
                  <td align="center"><a :href="'nav_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
                </tr>
              </table>
            </div>
          </b-tab>
          <b-tab title="手机版">
            <div class="py-3 text-center">
              <table class="table table-bordered">
                <tr class="bg-light">
									<th>编号</th>
                  <th width="150">导航名称</th>
                  <th class="text-left">链接地址</th>
									<th>父级ID</th>
                  <th width="80">排序</th>
                  <th width="150">操作</th>
                </tr>
                <tr v-for="item in nav.mobile">
                  <td>{{item.id}}</td>
									<td>{{item.name}}</td>
                  <td class="text-left">{{item.link}}</td>
									<td class="center">{{item.parent_id}}</td>
                  <td align="center">{{item.sort}}</td>
                  <td align="center"><a :href="'nav_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
                </tr>
              </table>
            </div>
          </b-tab>
        </b-tabs>
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
      menucurr:'导航栏',
      items: [{text: '网站管理中心',active: true},{text: '导航栏',active: true}],
      
      manager:{uid:0,uname:''},
      nav:{
        main:[{id: "5", name: "产品中心1",link: "product.html",parent_id:'',sort: "10"}],
        top:[{id: "5", name: "产品中心2",link: "product.html",parent_id:'',sort: "10"}],
        bottom:[{id: "5", name: "产品中心3",link: "product.html",parent_id:'',sort: "10"}],
        mobile:[{id: "5", name: "产品中心4",link: "product.html",parent_id:'',sort: "10"}]
      },
			
			alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },

  mounted () {
    this.$axios.get(_API+"nav")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.nav=res.data.data.nav;
        
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
      for(let x in that.nav){
        that.nav[x].forEach(function(v,i){
          if(v.id==id){that.nav[x].splice(i,1);}
        })
      }
    },

    del(id){
      this.$axios.get(_API+"nav/del?id="+id)
      .then((res)=>{
        if(res.data.errcode==0){
          this.timer(3,'删除导航成功');
          this.update(id);
        }else if(res.data.errcode==401){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    }
  },

 

};

</script>
