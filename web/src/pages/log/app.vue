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
        <h3 class="border-bottom pb-2 mb-5 text-secondary">{{items[items.length-1].text}}</h3>
        <div class="py-3 text-center ">
          <table class="table table-bordered">
            <tr class="bg-light">
							<th width="120">编号</th>
							<th>时间</th>
							<th class="text-left">动作</th>
							<th>操作员</th>
							<th width="150">IP</th>
            </tr>
            <tr v-for="item in logs">
							<td>{{item.id}}</td>
							<td>{{item.add_time}}</td>
							<td class="text-left">{{item.action}}</td>
							<td>{{item.user_name}}</td>
							<td>{{item.last_ip}}</td>
            </tr>
          </table>
        </div>
				<div class="text-center">
					<b-pagination-nav align="center" base-url="?page=" :number-of-pages="pagination.totel" v-model="pagination.current" />
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
  data () {
    return {
      menucurr:'操作日志',
      items: [{text: '网站管理中心',active: true},{text: '操作记录',active: true}],
			
			manager:{uid:0,uname:''},
			logs:[{id:0,add_time:'3',action:'4',user_name:'1',last_ip:'1'}],
			pagination:{current:1,totel:10}
    }
  },

  mounted () {
		//获取信息进行编辑
		let page=this.getQueryString("page")?this.getQueryString("page"):'1';
		
		this.$axios.get(_API+"log?page="+page)
		.then((res)=>{
			if(res.data.errcode==0){
				this.manager=res.data.data.manager;
				this.logs=res.data.data.logs;
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
	}
  

};

</script>
