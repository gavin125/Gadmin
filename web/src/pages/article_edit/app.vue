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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="article.html" class="btn btn-success btn-sm float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit="onSubmit">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">分类</div>
              <div class="col-4"><b-form-select size='sm' v-model="article.group" :options="article.groupOps" /></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">标题</div>
              <div class="col-4"><b-form-input size='sm' v-model="article.title" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">页面内容</div>
              <div class="col-6"><wangeditor :inittxt='article.content' v-on:listenEditor='listenEditor'></wangeditor></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">缩略图</div>
              <div class="col-4">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)" >
                  <label class="custom-file-label" for="customFile" v-text='article.image'></label>
                </div>
              </div>
              <div class="col-2 position-relative"><img class="position-absolute w-100" :src="article.image64" alt=""></div>
            </b-form-row>
            
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">关键词</div>
              <div class="col-4"><b-form-input size='sm' v-model="article.keywords" type="text"></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">描述</div>
              <div class="col-4"><b-form-textarea size='sm' v-model="article.description":rows="3" :max-rows="5"></b-form-textarea></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">排序</div>
              <div class="col-4"><b-form-input size='sm' v-model="article.sort" type="text"></b-form-input></div>
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
import wangeditor from '../../components/wangeditor.vue'
let _API='http://localhost/Gadmin/api/';


export default {
  components: {
    xggHead,
    xggMenu,
    xggFoot,
    wangeditor
  },
  data(){
    return {
      menucurr:'文章列表',
      items: [{text: '网站管理中心',active: true},{text: '文章编辑',active: true}],
      
      manager:{uid:0,uname:''},
      article:{
        group:'',
        groupOps:[{ value:0,text:'无'},{value:1,text:'公司动态'},{value:2,text:'行业新闻'}],
        title:'',
        content:'<p>请编辑内容</p>',
        image:'',
        image64:'',
        keywords:'',
        description:'',
        sort:''
      },
      
    }
  },
  mounted(){},
  methods:{
    changeImage(e) {
      var file = e.target.files[0]
      this.article.image=file.name;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.article.image64=imgFile;
      }
    },
    listenEditor(data){
      this.article.content=data;
    },
    onSubmit(e){
      e.preventDefault();
      alert(JSON.stringify(this.form));
    }
    
  }

};

</script>
