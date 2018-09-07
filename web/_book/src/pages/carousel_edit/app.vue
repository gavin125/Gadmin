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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="carousel.html" class="btn btn-success float-right px-4">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit.prevent="oncarousel">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">应用场景</div>
              <div class="col-4 py-1">
                <b-form-radio-group plain v-model="carousel.type" :options="sceneOps"></b-form-radio-group>
              </div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">轮播图描述</div>
              <div class="col-4"><b-form-input v-model="carousel.name" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">链接地址</div>
              <div class="col-4"><b-form-input v-model="carousel.link" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">轮播图片</div>
              <div class="col-4">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)">
                  <label class="custom-file-label" for="customFile" v-text='carousel.src'> </label>
                </div>
              </div>
              <div class="col-2 position-relative"><img class="position-absolute w-100" :src="carousel.src64" alt=""></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">排序</div>
              <div class="col-4"><b-form-input v-model="carousel.sort" type="text"></b-form-input></div>
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

export default {
  components: {
    xggHead,
    xggMenu,
    xggFoot
  },
  data(){
    return {
      menucurr:'轮播图',
      items: [{text: '网站管理中心',active: true},{text: '编辑轮播图',active: true}],
      sceneOps:[{ value:'PC',text:'网站版'},{value:'H5',text:'手机版'}],
      
      manager:{uid:0,uname:''},
      carousel:{
        type:'PC',
        name:'',
        link:'',
        src:'',
        src64:'',
        sort:0
      },
      
      alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },
  mounted () {
    //获取信息进行编辑
    let id=this.getQueryString("id")?this.getQueryString("id"):'0';
    
    this.$axios.get(_API+"carousel/prepare?id="+id)
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.carousel=res.data.data.carousel;
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
      this.carousel.src=file.name;
      this.carousel.srcfile=file;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.carousel.src64=imgFile;
      }
    },

    timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',close:true,msg:msg+'~ '+n+'后自动返回列表'};
        setTimeout(function(){that.timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
        window.location.href='carousel.html';
      }
    },
    
    oncarousel(){
      let that=this;
      let formData = new FormData();
      let id=this.getQueryString("id")?this.getQueryString("id"):'0';
      for(let x in this.carousel){
        if(x!='src'||x!='src64'){formData.append(x, this.carousel[x])}
      }
      if(this.carousel.hasOwnProperty('srcfile')){formData.append('file', this.carousel.srcfile)}
      let config = {headers: {'Content-Type': 'multipart/form-data'}};

      this.$axios.post(_API+"carousel/edit?id="+id,formData, config)
      .then((res)=>{
        if(res.data.errcode==0){
          that.timer(3,'编辑轮播图成功');
        }else if(res.data.errcode==401){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    },
    
  }

};

</script>
