<template>
  <div class="xggWrap">
    <!-- head -->
    <xggHead :manager='manager'></xggHead>

    <!-- menu -->
    <xggMenu :menu='menu'></xggMenu>

    <!-- main -->
    <div class="xggMain bg-white pb-2 border-left border-bottom">
      <b-breadcrumb :items="items" class="rounded-0 border-bottom py-2 px-4 bg-light"/>
      <div class="container-fluid px-4">
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}}</h3>
        <b-tabs class="h6">
          <b-tab title="常规设置" active>
            <div class="py-3">
              <b-form @submit.prevent="onPC">
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">是否开启网站</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="PC.on_off" :options="PC.on_offOps" name="radioInline"></b-form-radio-group>
                  </div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="PC.keywords" :rows="3" :max-rows="5"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="PC.description" :rows="5" :max-rows="8"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" @change="changeImage1($event)">
                      <label class="custom-file-label" for="customFile" v-text='PC.logo'> </label>
                    </div>
                  </div>
                  <div class="col-2 position-relative"><img class="position-absolute w-100" :src="PC.logo64" alt=""></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">公司地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.address" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">备案号</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.icp" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">服务热线</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.tel" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">邮箱地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.email" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">统计/客服代码</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="PC.code":rows="5" :max-rows="8"></b-form-textarea></div>
                </b-form-row>
                <b-form-row>
                  <div class="col-2 text-right py-1"></div>
                  <div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
                </b-form-row>
              </b-form>
            </div>
          </b-tab>
          <b-tab title="显示设置">
            <div class="py-3 Xggfz14">
              <b-form  @submit.prevent="onDisplay">
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">缩略图宽度</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.w" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">缩略图高度</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.h" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.artNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.proSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="PC.display.proNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row>
                  <div class="col-2 text-right py-1"></div>
                  <div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
                </b-form-row>
              </b-form>
            </div>
          </b-tab>
          <b-tab title="手机版设置">
            <div class="py-3 Xggfz14">
              <b-form @submit.prevent="onH5">
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">是否开启手机版</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="H5.on_off" :options="H5.on_offOps" name="radioInline"></b-form-radio-group>
                  </div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="H5.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="H5.keywords" :rows="2" :max-rows="3"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="H5.description" :rows="5" :max-rows="8"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" @change="changeImage2($event)">
                      <label class="custom-file-label" for="customFile" v-text='H5.logo'> </label>
                    </div>
                  </div>
                  <div class="col-2 position-relative"><img class="position-absolute w-100" :src="H5.logo64" alt=""></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="H5.display.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="H5.display.artNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="H5.display.proSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="H5.display.proNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row>
                  <div class="col-2 text-right py-1"></div>
                  <div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
                </b-form-row>
              </b-form>
            </div>
          </b-tab>
        </b-tabs>
        

       
        
      </div>

    </div>

    <!-- foot -->
    <xggFoot></xggFoot>

    <!-- alert -->
    <b-alert class='alert' :variant="alert.type" :show="alert.show">{{alert.msg}}</b-alert>
  </div>
</template>

<style>
@import '../../assets/common.scss';
.alert{ position: absolute; bottom:0; left: 50%; transform: translate(-50%,0); }
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
  data () {
    return {
      menu:[
        [{
          text:'管理首页',link:'index.html',active:false
        }],
        [{
          text:'系统设置',link:'config.html',active:true},{
          text:'导航栏',link:'nav.html',active:false},{
          text:'轮播图',link:'carousel.html',active:false},{
          text:'单页面',link:'page.html',active:false
        }],
        [{
          text:'管理员',link:'manager.html',active:false},{
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
        text: '系统设置',active: true
      }],

      alert:{show:false,type:'danger',msg:'这是一个错误提示！'},

      manager:{uid:0,uname:''},
      PC:{
        on_off:"on",
        on_offOps:[{ value:"on",text:'是'},{value:"off",text:'否'}],
        title:'小古哥',
        keywords:'',
        description:'',
        logo:null,
        logo64:null,
        address:'',
        icp:'',
        tel:'',
        email:'',
        code:'',
        display:{
          w:400,
          h:300,
          artSize:6,
          artNum:4,
          proSize:6,
          proNum:3,
        }
      },
      H5:{
        on_off:"on",
        on_offOps:[{ value:"on",text:'是'},{value:"off",text:'否'}],
        title:'小古哥',
        keywords:'',
        description:'',
        logo:null,
        logo64:null,
        display:{
          artSize:6,
          artNum:4,
          proSize:6,
          proNum:3,
        }
      }
      
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    // 获取管理员信息
    this.$axios.get(_API+"config")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.PC=this._copyObj(this.PC,res.data.data.PC);
        this.PC.display=JSON.parse(res.data.data.PC.display);

        this.H5=this._copyObj(this.H5,res.data.data.H5);
        this.H5.display=JSON.parse(res.data.data.H5.display);
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})


  },
  methods:{

    _copyObj(o1,o2){
      for(let x in o1){
        if(o2.hasOwnProperty(x)){o1[x]=o2[x]}
      }
      return o1;
    },

    changeImage1(e) {
      let file = e.target.files[0]
      console.log(file.name);
      this.PC.logo=file.name;
      this.PC.logofile=file;
      let reader = new FileReader()
      let that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        let imgFile = e.target.result;
        that.PC.logo64=imgFile;
      }
    },

    changeImage2(e) {
      let file = e.target.files[0]
      this.H5.logo=file.name;
      this.H5.logofile=file;
      let reader = new FileReader()
      let that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        let imgFile = e.target.result;
        that.H5.logo64=imgFile;
      }
    },

    _timer(n,msg){
      var that=this;
      if(n>0){
        that.alert={show:true,type:'success',msg:msg+'~ '+n+'后自动关闭'};
        setTimeout(function(){that._timer(n-1,msg)},1000);
      }else{
        that.alert.show=false;
      }
    },

    onPC(){
      let that=this;
      let formData = new FormData();
      for(let x in this.PC){
        if(x!='on_offOps'||x!='logo'||x!='logo64'){formData.append(x, this.PC[x])}
      }
      if(this.PC.hasOwnProperty('logofile')){formData.append('file', this.PC.logofile)}
      let config = {headers: {'Content-Type': 'multipart/form-data'}}

      this.$axios.post(_API+"config/PC",formData, config)
      .then((res)=>{
        if(res.data.errcode==0){
          that._timer(3,'编辑PC配置成功');
        }else if(res.data.errcode==403){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    },

    onDisplay(){
      let that=this;
      let formData = new FormData();
      formData.append('display', JSON.stringify(this.PC.display))
      let config = {headers: {'Content-Type': 'multipart/form-data'}}
      this.$axios.post(_API+"config/display",formData, config)
      .then((res)=>{
        if(res.data.errcode==0){
          that._timer(3,'编辑显示配置成功');
        }else if(res.data.errcode==403){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    },

    onH5(){
      let that=this;
      let formData = new FormData();
      for(let x in this.H5){
        if(x!='on_offOps'||x!='logo'||x!='logo64'){formData.append(x, this.H5[x])}
      }
      formData.append('display', JSON.stringify(this.H5.display));
      if(this.H5.hasOwnProperty('logofile')){formData.append('file', this.H5.logofile)}
      let config = {headers: {'Content-Type': 'multipart/form-data'}}

      this.$axios.post(_API+"config/H5",formData, config)
      .then((res)=>{
        if(res.data.errcode==0){
          that._timer(3,'编辑H5配置成功');
        }else if(res.data.errcode==403){
          window.location.href='login.html'; 
        };
      }).catch(function(err){console.log(err);})
    }


  }

};

</script>
