<style scoped lang="scss">
	.box-card{
		padding-bottom: 20px;
	}
	.box-card .item{
		padding: 5px 0;
	}
	.box-card .item a{
		text-decoration: none;
		/*color: #F56C6C;*/
		margin: 8px auto;
	}
	.box-card .name{
		white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
	}
	h3.name{
		margin:0;
		font-size:16px;
		font-weight: normal;
	}
	p.name{
		margin: 0;
		font-size: 14px;
	}
	.profile-pic{
		width: 50px;
		height: 50px;
		border-radius: 0;
		border: 1px solid rgba(255, 255, 255, 0.01);
		object-fit: cover;
	}
	.recommend-item{
		padding: 0 0 5px 0;
	}
</style>
<template>
	<el-col class="friend">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<i class="el-icon-guide"></i>
				<span>今日推荐</span>
			</div>
			<div class="lv-clear-both"></div>
			<el-row type="flex" class="el-col-24 recommend-item" justify="space-between" v-for="(item,index) in recommends" :key="index">
					<el-col :span="4" class="item">
						<div class="">
							<el-image :src="item.article_thumb" alt="Mozilan" class="profile-pic"></el-image>
						</div>
					</el-col>
					<el-col :span="18" style="padding-left:10px">
						<div class="">
                            <router-link :to="{name:'查看文章',params: {art_id:item.article_id}}">
							    <h3 title="Mozilan" class="name"> {{item.article_title}}</h3>
                            </router-link>
							<p class="name"> {{item.article_description}}</p>
						</div>
					</el-col>

			</el-row>
		</el-card>
	</el-col>
</template>

<script>
	export default {
		name: 'recommend',
		data () {
			return {
				desv:2,
				friend_box:[
					{
						name:'蓝默科技蓝默科技蓝默科技蓝默科技蓝默科技',
						avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
						des:'向上的路并不拥挤'
					},
					{
						name:'蓝默科技',
						avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
						des:'向上的路并不拥挤，而有的人选择了安逸，向上的路并不拥挤'
					},
					{
						name:'蓝默科技',
						avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
						des:'向上的路并不拥挤，而有的人选择了安逸向上的路并不拥挤，向上的路并不拥挤，而有的人选择了安逸'
					},
				]
			}
		},
		created() {
			this.$store.dispatch('getRecommendArticles');
			this.$watch(this.$store.getters.getRecommendArticlesLoadStatus, function () {
				if(this.$store.getters.getRecommendArticlesLoadStatus() == 3 ){
					console.log('recommend.vue:没有获取到今日推荐');
				}
			});
		},
		computed:{
			recommends(){
				return this.$store.getters.getRecommendArticles.data;
			}
		}
	}
</script>