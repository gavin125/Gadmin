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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}} <a href="article_edit.html" class="btn btn-success float-right px-4">新增</a></h3>
        <div class="py-3 text-center ">
          <b-form @submit.prevent="onFilter">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="filter.group" :options="filter.groupOps" size='sm'/></div>
              <div class="col-2"><b-form-input size='sm' v-model="filter.text" type="text"/></b-form-input></div>
              <div class="col-2 text-left"><b-button size='sm' type="submit" class="px-5" variant="secondary">筛 选</b-button></div>
            </b-form-row>
          </b-form>
          <table class="table table-bordered">
            <tr class="bg-light">
              <th><input type="checkbox">全选</th>
              <th>编号</th>
              <th>缩略图</th>
              <th class="text-left">名称</th>
              <th>分类</th>
              <th>添加日期</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
            <tr v-for='item in articles'>
              <td class="align-middle"><input type="checkbox"></td>
              <td class="align-middle">{{item.id}}</td>
              <td><img :src="item.src" alt=""></td>
              <td class="align-middle text-left">{{item.title}}</td>
              <td class="align-middle">{{item.name}}</td>
              <td class="align-middle">{{item.add_time}}</td>
              <td class="align-middle">{{item.sort}}</td>
              <td class="align-middle"><a :href="'article_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
            </tr>
          </table>
          <b-form @submit.prevent="onExecute">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="execute.action" :options="execute.actionOps" size='sm'/></div>
              <div class="col-2" v-show='execute.action!=0'><b-form-select v-model="execute.group" :options="execute.groupOps" size='sm'/></div>
              <div class="col-2 text-left"><b-button size='sm' type="submit" class="px-5" variant="success">执 行</b-button></div>
            </b-form-row>
          </b-form>
          
        </div>    
        <div class="text-center">
          <b-pagination-nav align="center" base-url="?page=" :number-of-pages="pagination.totel" v-model="pagination.current" />
        </div> 
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

import {_API,config} from '../../config.js'
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
      menucurr:'文章列表',
      items: [{text: '网站管理中心',active: true},{text: '文章列表',active: true}],
			
			manager:{uid:0,uname:''},
      articles:[{id:0,src:'',title:'',name:'',add_time:'',sort:''}],
      pagination:{current:1,totel:10},
			filter:{
				group:0,
				groupOps:[{ value:0,text:'无'},{value:1,text:'公司动态'},{value:2,text:'行业新闻'}],
				text:''
			},
			execute:{
				action:0,
				actionOps:[{value:0,text:'请选择操作'},{value:1,text:'删除'},{value:2,text:'移动至分类'}],
				group:0,
				groupOps:[{ value:0,text:'无'},{value:1,text:'公司动态'},{value:2,text:'行业新闻'}],
			},
			
			alert:{show:false,type:'danger',msg:'这是一个错误提示！'},
    }
  },

  mounted () {
    //获取信息进行编辑
    let page=this.getQueryString("page")?this.getQueryString("page"):'1';
    
    this.$axios.get(_API+"article?page="+page)
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.articles=res.data.data.articles;
        this.pagination=res.data.data.pagination;

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
				that.alert={show:true,type:'success',msg:msg+'~ '+n+'后自动关闭'};
				setTimeout(function(){that.timer(n-1,msg)},1000);
			}else{
				that.alert.show=false;
			}
		},

		update(id){
			let that=this;
			that.articles.forEach(function(v,i){
				if(v.id==id){that.articles.splice(i,1);}
			})
		},

		del(id){

			this.$axios.get(_API+"article/del?id="+id)
			.then((res)=>{
				if(res.data.errcode==0){
					this.timer(3,'删除文章成功');
					this.update(id);
				}else if(res.data.errcode==401){
					window.location.href='login.html'; 
				};
			}).catch(function(err){console.log(err);})
		},
			
    onFilter:function(){
      console.log(this.filter);
    },
    onExecute:function(){
      console.log(this.execute);
    },
  }


};

</script>
