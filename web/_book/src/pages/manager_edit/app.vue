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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="manager.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit.prevent="onmanager">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">管理员</div>
              <div class="col-4"><b-form-input size='sm' v-model="managerinfo.user_name" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">Email</div>
              <div class="col-4"><b-form-input size='sm' v-model="managerinfo.email" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">密码</div>
              <div class="col-4"><b-form-input size='sm' v-model="managerinfo.pass_word" type="password"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">确认密码</div>
              <div class="col-4"><b-form-input size='sm' v-model="managerinfo.pw_again" type="password"></b-form-input></div>
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
    <b-alert class='alert' :variant="alert.type" :dismissible='alert.close' :show="alert.show">{{alert.msg}}</b-alert>
  </div>
</template>

<style>
@import '../../assets/common.scss';
.custom-file-label::after{content: '浏览'}
</style>

<script>

import {_API,config} from '../../config.js'
import xggHead from '../../components/xggHead.vue'
import xggMenu from '../../components/xggMenu.vue'
import xggFoot from '../../components/xggFoot.vue'
import wangeditor from '../../components/wangeditor.vue'


export default {
  components: {
    xggHead,
    xggMenu,
    xggFoot,
    wangeditor
  },
  data(){
    return {
			menucurr:'管理员',
			items: [{text: '网站管理中心',active: true},{text: '管理员',active: true}],
			
			manager:{uid:0,uname:''},
      managerinfo:{
        user_name:'',
        email:'',
        pass_word:'',
        pw_again:''
      },
      
      alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },
  mounted(){
    //获取信息进行编辑
    let id=this.getQueryString("id")?this.getQueryString("id"):'0';
    
    this.$axios.get(_API+"manager/prepare?id="+id)
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.managerinfo=res.data.data.managerinfo;
      }else if(res.data.errcode==401){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
  },
  methods:{
    //解析url参数
    getQueryString(name){
      var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
      var r = window.location.search.substr(1).match(reg);
      if (r != null) {return unescape(r[2]); }
      return null;
    },

    timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',close:true,msg:msg+'~ '+n+'后自动返回列表'};
        setTimeout(function(){that.timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
        window.location.href='manager.html';
      }
    },

    onmanager(){
      console.log(this.managerinfo);
      // 表单本地验证
      if(this.managerinfo.user_name==''||this.managerinfo.email==''||this.managerinfo.pass_word==''||this.managerinfo.pw_again==''){
        this.alert={show:true,type:'danger',close:true,msg:'信息不能为空'};
        if(this.managerinfo.pass_word!=this.managerinfo.pw_again){
          this.alert={show:true,type:'danger',close:true,msg:'两次密码不一致'};
        }
      }else{
        // 构造数据并提交
        let that=this;
        let formData = new FormData();
        let id=this.getQueryString("id")?this.getQueryString("id"):'0';
        for(let x in this.managerinfo){
          if(x!='pw_again'){formData.append(x, this.managerinfo[x])}
        }
        let config = {headers: {'Content-Type': 'multipart/form-data'}};
        this.$axios.post(_API+"manager/edit?id="+id,formData, config)
        .then((res)=>{
          if(res.data.errcode==0){
            that.timer(3,'编辑管理员成功');
          }else if(res.data.errcode==401){
            window.location.href='login.html'; 
          };
        }).catch(function(err){console.log(err);})
      }
    }, 
  }

};

</script>
