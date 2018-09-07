<template>
  <div class="position-absolute column">
    <b-list-group class="border-bottom" v-for='group in menu'>
      <b-list-group-item v-for='item in group' class="border-0 rounded-0 py-2" :href='item.link' :variant='item.text==menucurr?"success":""'>
				<img class="navicon" :src='"../assets/octicons/"+item.icon+".svg"' alt="">{{item.text}}
				</b-list-group-item>
    </b-list-group>
		
  </div>
</template>

<script>

export default {
  props:['menucurr'],
  data () {
    return {
			// 开源图标库 https://octicons.github.com/
			menu:[
				[{
					text:'管理首页',icon:'device-desktop',link:'index.html'
				}],
				[{
					text:'系统设置',icon:'gear',link:'config.html'},{
					text:'导航栏',icon:'browser',link:'nav.html'},{
					text:'轮播图',icon:'file-media',link:'carousel.html'},{
					text:'单页面',icon:'file',link:'page.html'
				}],
				[{
					text:'管理员',icon:'person',link:'manager.html'},{
					text:'操作日志',icon:'clippy',link:'log.html'/* },{
					text:'数据备份',icon:'database',link:'backup.html' */
				}],
				[{
					text:'文章分类',icon:'file-directory',link:'article_group.html'},{
					text:'文章列表',icon:'book',link:'article.html'
				}],
				[{
					text:'产品分类',icon:'package',link:'product_group.html'},{
					text:'产品列表',icon:'gift',link:'product.html'
				}],
				/*[{
					text:'学生分组',icon:'organization',link:'#'},{
					text:'学生列表',icon:'mortar-board',link:'#'
				}],
				[{
					text:'讲师管理',icon:'gist-secret',link:'#'
				}],
				[{
					text:'订单查询',icon:'credit-card',link:'#'
				}],*/
			],
		}
  },
  mounted () {},
};

</script>
