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
        <div class="py-3 text-center">
          <b-form @submit.prevent="onFilter">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="filter.group" :options="groupOps"/></div>
              <div class="col-2"><b-form-input v-model="filter.text" type="text"/></b-form-input></div>
              <div class="col-2 text-left"><b-button type="submit" class="px-5" variant="secondary">筛 选</b-button></div>
            </b-form-row>
          </b-form>
          <table class="table table-bordered">
            <tr class="bg-light">
              <th><input type="checkbox" v-model='checkAll' v-on:change='selectAll()'>全选</th>
              <th>编号</th>
              <th class="text-left">名称</th>
              <th>图片</th>
              <th>分类</th>
              <th>添加日期</th>
              <th>排序</th>
              <th>操作</th>
            </tr>
            <tr v-for='item in articles'>
              <td class="align-middle"><input type="checkbox" :value="item.id" v-on:change='selectItem(item)' v-model="item.checked"></td>
              <td class="align-middle">{{item.id}}</td>
              <td class="align-middle text-left">{{item.title}}</td>
              <td><img :src="item.src" alt="" height="60"></td>
              <td class="align-middle">{{item.name}}</td>
              <td class="align-middle">{{item.add_time}}</td>
              <td class="align-middle">{{item.sort}}</td>
              <td class="align-middle"><a :href="'article_edit.html?id='+item.id">编辑</a> | <span class='btn-link' v-on:click="del(item.id)">删除</span></td>
            </tr>
          </table>
          <b-form @submit.prevent="onExecute">
            <b-form-row class='mb-3'>
              <div class="col-2"><b-form-select v-model="execute.action" :options="actionOps"/></div>
              <div class="col-2" v-show='execute.action==2'><b-form-select v-model="execute.group" :options="groupOps"/></div>
              <div class="col-2 text-left"><b-button type="submit" class="px-5" variant="success">执 行</b-button></div>
            </b-form-row>
          </b-form>
          
        </div>    
        <div class="text-center">
          <b-pagination-nav align="center" :base-url="baseurl" :number-of-pages="pagination.totel" v-model="pagination.current" />
        </div> 
      </div>
    </div>

    <!-- foot -->
    <xggFoot></xggFoot>
		
		<!-- alert -->
		<b-alert class='alert' :variant="alert.type" :dismissible='alert.close' :show="alert.show">{{alert.msg}}</b-alert>
		
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
      actionOps:[{value:'',text:'请选择操作'},{value:1,text:'删除'},{value:2,text:'移动至分类'}],
      baseurl:'?page=',
      checkAll:false,
			
			manager:{uid:0,uname:''},
      articles:[{id:0,src:'',title:'',name:'',add_time:'',sort:''}],
      pagination:{current:1,totel:10},
      groupOps:[{ value:0,text:'无'}],
			filter:{group:'',text:''},
			execute:{action:'',group:'',},
			
			alert:{show:false,type:'danger',close:true,msg:'这是一个错误提示！'},
    }
  },

  mounted () {
    //获取信息进行编辑
    let page=this.getQueryString("page")?this.getQueryString("page"):'1';
    let group=this.getQueryString("group")?this.getQueryString("group"):'';
    let text=this.getQueryString("text")?this.getQueryString("text"):'';
    this.filter.group=group;
    this.filter.text=text;
    var url='?';
    if(this.filter.group!=''){url+='group='+this.filter.group+'&';}
    if(this.filter.text!=''){url+='text='+this.filter.text+'&';}
    this.baseurl=url+'page=';
    
    this.$axios.get(_API+"article"+this.baseurl+page)
    .then((res)=>{
      if(res.data.errcode==0){
        this.manager=res.data.data.manager;
        this.articles=res.data.data.articles;
        this.pagination=res.data.data.pagination;
        this.groupOps=res.data.data.groupOps;
      }else if(res.data.errcode==401){
        window.location.href='login.html'; 
      };
    }).catch(function(err){console.log(err);})
  },

  methods:{
    
    getQueryString(name){//解析url参数
      var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
      var r = window.location.search.substr(1).match(reg);
      if (r != null) {return unescape(r[2]); }
      return null;
    },
		
		timer(n,msg){//dailog关闭倒计时
			var that=this;
			if(n>0){
				that.alert={show:true,type:'success',close:true,msg:msg+'~ '+n+'后自动关闭'};
				setTimeout(function(){that.timer(n-1,msg)},1000);
			}else{
				that.alert.show=false;
			}
		},

		update(id){//更新删除行
			let that=this;
			that.articles.forEach(function(v,i){
				if(v.id==id){that.articles.splice(i,1);}
			})
		},

    /*********************** 私有方法与公有方法分割线 ***********************/

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
      var url='?';
      if(this.filter.group!=''){url+='group='+this.filter.group+'&';}
      if(this.filter.text!=''){url+='text='+this.filter.text+'&';}
      this.baseurl=url+'page=';
      var loca = window.location;
      loca.href=loca.origin+loca.pathname+this.baseurl+'1';
    },

    selectItem:function(item){
      if(typeof item.checked=='undefind'){
        this.$set(item,'checked',true);
      }
    },

    selectAll:function(){
      var _this=this;
      _this.articles.forEach(function(item,index){
        if(typeof item.checked=='undefind'){
          _this.$set(item,'checked',_this.checkAll);
        }else{
          item.checked=_this.checkAll;
        }
      })
    },

    onExecute:function(){
      var _this=this,arr=[];
      _this.articles.forEach(function(item,index){
        if(item.checked){arr.push(item.id)}
      })
      if(this.execute.action=='1' && arr.length>0){
        this.$axios.get(_API+'article/execute?action='+this.execute.action+'&checked='+JSON.stringify(arr))
        .then((res)=>{
          if(res.data.errcode==0){
            window.location.href=window.location.href;
          }else if(res.data.errcode==401){
            window.location.href='login.html'; 
          };
        }).catch(function(err){console.log(err);})
      }

      if(this.execute.action=='2' && arr.length>0){
        this.$axios.get(_API+'article/execute?group='+this.execute.group+'&action='+this.execute.action+'&checked='+JSON.stringify(arr))
        .then((res)=>{
          if(res.data.errcode==0){
            window.location.href=window.location.href;
          }else if(res.data.errcode==401){
            window.location.href='login.html'; 
          };
        }).catch(function(err){console.log(err);})
      }
      
    },
  }


};

</script>
