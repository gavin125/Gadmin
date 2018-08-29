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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="nav.html" class="btn btn-success float-right">返回列表</a></h3>
				<!-- <b-tabs class="h6">
					<b-tab title="站内导航">
						<div class="py-3 Xggfz14">
							<b-form @submit.prevent="onsystem">
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">系统内容</div>
									<div class="col-4"><b-form-select size='sm' v-model="systemnav.system" :options="systemOps" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">导航名称</div>
									<div class="col-4"><b-form-input size='sm' v-model="systemnav.name" type="text"></b-form-input></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">位置</div>
									<div class="col-4 py-1"><b-form-radio-group plain v-model="systemnav.site" :options="siteOps" name="radioInline"></b-form-radio-group></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='systemnav.site=="main"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="systemnav.parent_id" :options="parentOps.main" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='systemnav.site=="top"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="systemnav.parent_id" :options="parentOps.top" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='systemnav.site=="bottom"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="systemnav.parent_id" :options="parentOps.bottom" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">排序</div>
									<div class="col-4"><b-form-input size='sm' v-model="systemnav.srot" type="text"></b-form-input></div>
								</b-form-row>
								<b-form-row>
									<div class="col-2 text-right py-1"></div>
									<div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
								</b-form-row>
							</b-form>
						</div>
					</b-tab>
					<b-tab title="自定义导航"> -->
						<div class="py-3 Xggfz14">
							<b-form @submit.prevent="oncustom">
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">导航名称</div>
									<div class="col-4"><b-form-input size='sm' v-model="customnav.name" type="text"></b-form-input></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">位置</div>
									<div class="col-4 py-1"><b-form-radio-group plain v-model="customnav.site" :options="siteOps" name="radioInline"></b-form-radio-group></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">链接地址</div>
									<div class="col-4"><b-form-input size='sm' v-model="customnav.link" type="text"></b-form-input></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='customnav.site=="main"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="customnav.parent_id" :options="parentOps.main" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='customnav.site=="top"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="customnav.parent_id" :options="parentOps.top" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2" v-if='customnav.site=="bottom"'>
									<div class="col-2 text-right py-1">上级分类</div>
									<div class="col-4"><b-form-select size='sm' v-model="customnav.parent_id" :options="parentOps.bottom" class="mb-3" /></div>
								</b-form-row>
								<b-form-row class="mb-2">
									<div class="col-2 text-right py-1">排序</div>
									<div class="col-4"><b-form-input size='sm' v-model="customnav.sort" type="text"></b-form-input></div>
								</b-form-row>
								<b-form-row>
									<div class="col-2 text-right py-1"></div>
									<div class="col-4"><b-button type="submit" class="px-5" variant="success">保 存</b-button></div>
								</b-form-row>
							</b-form>
						</div>
<!-- 					</b-tab>
				</b-tabs> -->
        
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
      menucurr:'导航栏',
      items: [{text: '网站管理中心',active: true},{text: '导航栏',active: true}],
			siteOps:[{ value:'main',text:'主导航'},{value:'top',text:'顶部'},{value:'bottom',text:'底部'},{value:'mobile',text:'手机版'}],
      
      manager:{uid:0,uname:''},
			// systemOps:[{ value:'',text:'请选择'}],
			parentOps:{
				'main':[{ value:'',text:'请选择'}],
				'top':[{ value:'',text:'请选择'}],
				'bottom':[{ value:'',text:'请选择'}],
			},
//       systemnav:{
//         system:'',
//         name:'',
//         site:'main',
//         parent_id:'',
//         sort:0
//       },
			customnav:{
				name:'',
				site:'main',
				link:'',
				parent_id:'',
				sort:0
			},
			
			alert:{show:false,type:'danger',msg:'这是一个错误提示！'},      
    }
  },
  computed:{
    year:()=>{return new Date().getFullYear();}
  },
  mounted () {
    //获取信息进行编辑
    let id=this.getQueryString("id")?this.getQueryString("id"):'0';
		
		this.$axios.get(_API+"nav/prepare?id="+id)
		.then((res)=>{
			if(res.data.errcode==0){
				this.manager=res.data.data.manager;
				this.parentOps=res.data.data.parentOps;
				this.customnav=res.data.data.customnav;
			}else if(res.data.errcode==401){
				window.location.href='login.html'; 
			};
		}).catch(function(err){console.log(err);})
    
  },
  methods:{
    //解析url参数
    getQueryString(name){
      var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
      var r = window.location.search.substr(1).match(reg);
      if (r != null) {return unescape(r[2]); }
      return null;
    },
		
		timer(n,msg){
			var that=this;
			if(n>0){
				that.alert={show:true,type:'success',msg:msg+'~ '+n+'后自动返回列表'};
				setTimeout(function(){that.timer(n-1,msg)},1000);
			}else{
				that.alert.show=false;
				window.location.href='nav.html';
			}
		},
		
		oncustom(){
			let that=this;
			let formData = new FormData();
			let id=this.getQueryString("id")?this.getQueryString("id"):'0';
			for(let x in this.customnav){formData.append(x, this.customnav[x]);}
			let config = {headers: {'Content-Type': 'multipart/form-data'}};
			
			this.$axios.post(_API+"nav/edit?id="+id,formData, config)
			.then((res)=>{
				if(res.data.errcode==0){
					that.timer(3,'编辑导航成功');
				}else if(res.data.errcode==401){
					window.location.href='login.html'; 
				};
			}).catch(function(err){console.log(err);})
		},
		
		
  }
};

</script>
