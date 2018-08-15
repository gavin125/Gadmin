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
        <h3 class="border-bottom pb-2 mb-4 text-secondary">{{items[items.length-1].text}}</h3>
        <b-tabs class="h6">
          <b-tab title="常规设置" active>
            <div class="py-3">
              <b-form>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.keywords" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="defualt.description":rows="3" :max-rows="5"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" @change="changeImage($event)">
                      <label class="custom-file-label" for="customFile" v-text='defualt.logo'> </label>
                    </div>
                  </div>
                  <div class="col-2 position-relative"><img class="position-absolute w-100" :src="defualt.logo64" alt=""></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">公司地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.address" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">备案号</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.icp" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">服务热线</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.tel" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">邮箱地址</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.email" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">系统语言</div>
                  <div class="col-4"><b-form-select size='sm' v-model="defualt.language" :options="defualt.languageOps" /></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">启用网站地图</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="defualt.map" :options="defualt.mapOps" name="radioInline"></b-form-radio-group>
                  </div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">统计/客服代码</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="defualt.code":rows="5" :max-rows="8"></b-form-textarea></div>
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
                  <div class="col-2 text-right py-1">启用手机版</div>
                  <div class="col-4 py-1">
                    <b-form-radio-group plain v-model="mobile.open" :options="mobile.openOps" name="radioInline"></b-form-radio-group>
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
          text:'系统设置',link:'system.html',active:true},{
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
      defualt:{
        title:'小古哥',
        keywords:'',
        description:'',
        logo:null,
        logo64:null,
        address:'',
        icp:'',
        tel:'',
        email:'',
        language:null,
        languageOps:[{ value:'cn',text:'cn'},{value:'en',text:'en'}],
        map:1,
        mapOps:[{ value:1,text:'是'},{value:0,text:'否'}],
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
        open:1,
        openOps:[{ value:1,text:'是'},{value:0,text:'否'}],
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
  mounted () {},
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
    }
  }

};

</script>
