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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="page.html" class="btn btn-success float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit.prevent="onpage">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">标题</div>
              <div class="col-4"><b-form-input v-model="page.title" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">banner</div>
              <div class="col-4">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)" >
                  <label class="custom-file-label" for="customFile" v-text='page.banner'></label>
                </div>
              </div>
              <div class="col-2 position-relative"><img class="position-absolute w-100" :src="page.banner64" alt=""></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">关键词</div>
              <div class="col-4"><b-form-input v-model="page.keywords" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">描述</div>
              <div class="col-4"><b-form-textarea v-model="page.description":rows="3" :max-rows="5"></b-form-textarea></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">页面内容</div>
              <div class="col-6"><wangeditor :inittxt='page.content' v-on:listenEditor='listenEditor'></wangeditor></div>
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
			menucurr:'单页面',
			items: [{text: '网站管理中心',active: true},{text: '编辑单页面',active: true}],
			
			manager:{uid:0,uname:''},
      page:{
        title:'',
        banner:'',
        banner64:'',
        keywords:'',
        description:'',
        content:'<p>请编辑内容</p>'
      },
      
      alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },
  mounted(){
    //获取信息进行编辑
    let id=this.getQueryString("id")?this.getQueryString("id"):'0';
    
    this.$axios.get(_API+"page/prepare?id="+id)
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.page=res.data.data.page;
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

    changeImage(e) {
      var file = e.target.files[0]
      this.page.banner=file.name;
      this.page.bannerfile=file;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.page.banner64=imgFile;
      }
    },

    timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',close:true,msg:msg+'~ '+n+'后自动返回列表'};
        setTimeout(function(){that.timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
        window.location.href='page.html';
      }
    },

    listenEditor(data){
      console.log(data);
    },

    onpage(){
      let that=this;
      let formData = new FormData();
      let id=this.getQueryString("id")?this.getQueryString("id"):'0';
      for(let x in this.page){
        if(x!='banner'||x!='banner64'){formData.append(x, this.page[x])}
      }
      if(this.page.hasOwnProperty('bannerfile')){formData.append('file', this.page.bannerfile)}
      let config = {headers: {'Content-Type': 'multipart/form-data'}};

      this.$axios.post(_API+"page/edit?id="+id,formData, config)
      .then((res)=>{
        if(res.data.errcode==0){
          that.timer(3,'编辑单页面成功');
        }else if(res.data.errcode==401){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    },
    
  }

};

</script>
