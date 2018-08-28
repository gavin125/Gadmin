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
let _API='http://localhost/Gadmin/api/';

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
      
      manager:{uid:0,uname:''},
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
