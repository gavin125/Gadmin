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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}} <a href="carousel.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">应用场景</div>
              <div class="col-4 py-1">
                <b-form-radio-group plain v-model="carousel.scene" :options="carousel.sceneOps"></b-form-radio-group>
              </div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">轮播图描述</div>
              <div class="col-4"><b-form-input size='sm' v-model="carousel.desc" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">轮播图片</div>
              <div class="col-4">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)">
                  <label class="custom-file-label" for="customFile" v-text='carousel.img'> </label>
                </div>
              </div>
              <div class="col-2 position-relative"><img class="position-absolute w-100" :src="carousel.b64img" alt=""></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">链接地址</div>
              <div class="col-4"><b-form-input size='sm' v-model="carousel.link" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">排序</div>
              <div class="col-4"><b-form-input size='sm' v-model="carousel.srot" type="text"></b-form-input></div>
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
          text:'轮播图',link:'carousel.html',active:true},{
          text:'单页面',link:'page.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
          text:'操作记录',link:'log.html',active:false},{
          text:'数据备份',link:'backup.html',active:false
        }],
      ],
      items: [{
        text: '网站管理中心',active: true},{
        text: '轮播图',active: true},{
        text: '编辑轮播图',active: true
      }],
      carousel:{
        scene:0,
        sceneOps:[{ value:0,text:'网站版'},{value:1,text:'手机版'}],
        desc:'',
        img:'',
        b64img:'',
        link:'',
        srot:0
      },
      
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted(){},
  methods:{
    changeImage(e) {
      var file = e.target.files[0]
      this.carousel.img=file.name;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.carousel.b64img=imgFile;
      }

    }
  }

};

</script>
