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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="manager.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit="onSubmit">
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
          text:'系统设置',link:'config.html',active:false},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:true},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:false
        }],
        [{
          text:'文章分类',link:'article_group.html',active:false},{
          text:'文章列表',link:'article.html',active:false
        }],
        [{
          text:'产品分类',link:'product_group.html',active:false},{
          text:'产品列表',link:'product.html',active:false
        }],
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '单页面',active: true},{
        text: '编辑单页面',active: true
      }],
      managerinfo:{
        user_name:'',
        email:'',
        pass_word:'',
        pw_again:''
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
