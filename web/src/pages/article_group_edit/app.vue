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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="article_group.html" class="btn btn-success float-right">返回列表</a></h3>
        <div class="py-3 Xggfz14">
          <b-form @submit="onSubmit">
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">分类名称</div>
              <div class="col-4"><b-form-input size='sm' v-model="article_group.name" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">父级分类</div>
              <div class="col-4"><b-form-input size='sm' v-model="article_group.parent" type="text"/></b-form-input></div>
            </b-form-row>
            <b-form-row class="mb-2">
              <div class="col-2 text-right py-1">排序</div>
              <div class="col-4"><b-form-input size='sm' v-model="article_group.sort" type="text"></b-form-input></div>
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
			menucurr:'文章分类',
			items: [{text: '网站管理中心',active: true},{text: '分类编辑',active: true}],
			
			manager:{uid:0,uname:''},
      article_group:{
        name:'',
        parent:'',
        sort:''
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
