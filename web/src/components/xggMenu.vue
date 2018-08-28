<template>
  <div class="position-absolute column">
    <b-list-group class="border-bottom" v-for='group in menu'>
      <b-list-group-item v-for='item in group' class="border-0 rounded-0 py-2" :href='item.link' v-text='item.text' :variant='item.text==menucurr?"success":""'></b-list-group-item>
    </b-list-group>
  </div>
</template>

<script>

export default {
  props:['menucurr'],
  data () {
    return {
			menu:[
				[{
					text:'管理首页',link:'index.html'
				}],
				[{
					text:'系统设置',link:'config.html'},{
					text:'导航栏',link:'nav.html'},{
					text:'轮播图',link:'carousel.html'},{
					text:'单页面',link:'page.html'
				}],
				[{
					text:'管理员',link:'manager.html'},{
					text:'操作日志',link:'log.html'/* },{
					text:'数据备份',link:'backup.html' */
				}],
				[{
					text:'文章分类',link:'article_group.html'},{
					text:'文章列表',link:'article.html'
				}],
				[{
					text:'产品分类',link:'product_group.html'},{
					text:'产品列表',link:'product.html'
				}],
			],
		}
  },
  mounted () {},
};

</script>
