<template>
  <div class="XggWrap">
    <!-- head -->
    <b-navbar toggleable="md" type="dark" variant="success" class="px-0">
      <b-navbar-brand class="m-0 p-0 text-center column" href="#">网站管理中心</b-navbar-brand>
      <b-navbar-nav>
        <b-nav-item href="#">查看网站</b-nav-item>
        <b-nav-item href="#">清除缓存</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown text="管理员 admin" right>
          <b-dropdown-item href="#">编辑资料</b-dropdown-item>
          <b-dropdown-item href="#">退出</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>


    <!-- menu -->
    <div class="position-absolute column">
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="index.html">管理首页</b-list-group-item>
      </b-list-group>
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="system.html" variant="success">系统设置</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="nav.html">导航栏</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="carousel.html">轮播图</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="page.html">单页面</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="mobile.html">手机版</b-list-group-item>
      </b-list-group>
      <b-list-group class="border-bottom">
        <b-list-group-item class="border-0 rounded-0 py-2" href="manager.html">管理员</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="log.html">操作记录</b-list-group-item>
        <b-list-group-item class="border-0 rounded-0 py-2" href="backup.html">数据备份</b-list-group-item>
      </b-list-group>
    </div>
    


    <!-- main -->
    <div class="XggMain bg-white pb-2 border-left border-bottom">
      <b-breadcrumb :items="items" class="rounded-0 border-bottom py-2"/>
      <div class="container-fluid">
        <h3 class="border-bottom pb-2 mb-4">系统设置</h3>
        <b-tabs class="h6">
          <b-tab title="常规设置" active>
            <div class="py-3 Xggfz14">
              <b-form>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点名称</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.name" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点标题</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.title" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点关键词</div>
                  <div class="col-4"><b-form-input size='sm' v-model="defualt.key" type="text"></b-form-input></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点描述</div>
                  <div class="col-4"><b-form-textarea size='sm' v-model="defualt.description":rows="2" :max-rows="4"></b-form-textarea></div>
                </b-form-row>
                <b-form-row class="mb-2">
                  <div class="col-2 text-right py-1">站点LOGO</div>
                  <div class="col-4"><b-form-file class="border rounded sm" v-model="defualt.logo" :state="Boolean(defualt.logo)" placeholder="image" accept="image/jpeg, image/png, image/gif"></b-form-file></div>
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
                  <div class="col-4"><b-form-select size='sm' v-model="defualt.language" :options="defualt.languageOps" class="mb-3" /></div>
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
                  <div class="col-2 text-right py-1">商品商品数量</div>
                  <div class="col-4"><b-form-input size='sm' v-model="display.artNum" type="text"></b-form-input></div>
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
    <div class="text-secondary text-center py-2 Xggfz14">
      Copyright © 2015-{{year}} <a class="text-success" href="https://www.xiaoguge.cn">小古哥</a> 版权所有
    </div>
  </div>
</template>

<style>
@import '../../assets/common.scss';
</style>

<script>



export default {
  data () {
    return {
      defualt:{
        name:'小古哥',
        title:'',
        key:'',
        description:'',
        logo:null,
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
      items: [{
        text: '网站管理中心',
        active: true
      }, {
        text: '系统设置',
        active: true
      }],
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    
    
  },

};

</script>
