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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="page.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit="onSubmit">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">标题</div>
              <div class="col-4"><b-form-input size='sm' v-model="page.title" type="text"/></b-form-input></div>
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
              <div class="col-2 text-right py-1">上级分类</div>
              <div class="col-4"><b-form-select size='sm' v-model="page.type" :options="page.typeOps" /></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">关键词</div>
              <div class="col-4"><b-form-input size='sm' v-model="page.keywords" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">描述</div>
              <div class="col-4"><b-form-textarea size='sm' v-model="page.description":rows="3" :max-rows="5"></b-form-textarea></div>
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

  </div>
</template>

<style>
@import '../../assets/common.scss';
.custom-file-label::after{content: '浏览'}
</style>

<script>

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


      manager:{id:1,name:'admin2'},
      menu:[
        [{
          text:'管理首页',link:'index.html',active:false
        }],
        [{
          text:'系统设置',link:'system.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:true
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:false
        }],
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '单页面',active: true},{
        text: '编辑单页面',active: true
      }],
      page:{
        title:'',
        banner:'',
        banner64:'',
        type:'',
        typeOps:[{ value:0,text:'cn'},{value:1,text:'en'}],
        keywords:'',
        description:'',
        content:'<p>请编辑内容</p>'
      },
      
    }
  },
  mounted(){},
  methods:{
    changeImage(e) {
      var file = e.target.files[0]
      this.page.banner=file.name;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.page.banner64=imgFile;
      }
    },
    listenEditor(data){
      this.page.content=data;
    },
    onSubmit(e){
      e.preventDefault();
      alert(JSON.stringify(this.form));
    }
    
  }

};

</script>
