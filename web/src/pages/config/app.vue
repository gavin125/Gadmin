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
              <b-form>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.keywords" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="defaults.description":rows="3" :max-rows="5"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)">
                      <label class="custom-file-label" for="customFile" v-text='defaults.logo'> </label>
                    </div>
                  </div>
                  <div class="col-2 position-relative"><img class="position-absolute w-100" :src="defaults.logo64" alt=""></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">公司地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.address" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">备案号</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.icp" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">服务热线</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.tel" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">邮箱地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defaults.email" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">是否开启网站</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="defaults.on_off" :options="defaults.on_offOps" name="radioInline"></b-form-radio-group>
                  </div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">统计/客服代码</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="defaults.code":rows="5" :max-rows="8"></b-form-textarea></div>
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
              <b-form>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">缩略图宽度</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.w" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">缩略图高度</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.h" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.artNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.artNum" type="text"></b-form-input></div>
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
              <b-form>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">是否开启</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="mobile.on_off" :options="mobile.on_offOps" name="radioInline"></b-form-radio-group>
                  </div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.keywords" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="mobile.description":rows="3" :max-rows="5"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)">
                      <label class="custom-file-label" for="customFile" v-text='mobile.logo'> </label>
                    </div>
                  </div>
                  <div class="col-2 position-relative"><img class="position-absolute w-100" :src="mobile.logo64" alt=""></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">文章首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.artNum" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品列表数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.artSize" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">商品首页数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="mobile.artNum" type="text"></b-form-input></div>
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
  data () {
    return {
      manager:{id:1,name:'admin2'},
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
      defaults:{
        title:'小古哥',
        keywords:'',
        description:'',
        logo:null,
        logo64:null,
        address:'',
        icp:'',
        tel:'',
        email:'',
        on_off:'on',
        on_offOps:[{ value:'on',text:'是'},{value:'off',text:'否'}],
        code:''
      },
      display:{
        w:400,
        h:300,
        artSize:6,
        artNum:4,
        proSize:6,
        proNum:3,
      },
      mobile:{
        on_off:'on',
        on_offOps:[{ value:'on',text:'是'},{value:'off',text:'否'}],
        title:'小古哥',
        keywords:'',
        description:'',
        logo:null,
        logo64:null,
        artSize:6,
        artNum:4,
        proSize:6,
        proNum:3,
      }
      
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    // 获取管理员信息
    this.$axios.get(_API+"admin/getname")
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager={id:res.data.data.uid,name:res.data.data.uname};
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})

    // 获取配置
    this.$axios.get(_API+"config/getall")
    .then((res)=>{
      if(res.data.errcode==0){
        console.log(res.data.data);
        this.defaults=this._copyObj(this.defaults,res.data.data.defaults);
        this.mobile=this._copyObj(this.mobile,res.data.data.mobile);
        // this.manager={id:res.data.data.uid,name:res.data.data.uname};
      }else if(res.data.errcode==403){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})

  },
  methods:{
    changeImage(e) {
      var file = e.target.files[0]
      this.defualt.logo=file.name;
      var reader = new FileReader()
      var that = this
      reader.readAsDataURL(file)
      reader.onload = function(e) {
        var imgFile = e.target.result;
        console.log(imgFile);
        that.defualt.logo64=imgFile;
      }
    },

    _copyObj(o1,o2){
      for(var x in o2){o1[x]=o2[x];}
      return o1;
    }
  }

};

</script>
