<template>
	<el-col class="tag">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<i class="el-icon-folder-opened"></i>
				<span>Ta的分类</span>
			</div>
			<div v-for="category in categories" class="text item">
				<router-link :to="{name:'分类文章',params: {category:category.id},query:{user:category.user_id}}">
					<p style="float: left;">{{category.name}}</p>
					<el-tag style="float: right" size="mini" class="category-item" type="success"  @click="">[{{category.count}}]</el-tag>
					<div style="clear:both;"></div>
				</router-link>
			</div>
		</el-card>
	</el-col>
</template>

<script>
	export default {
		name: 'category',
		data(){
			return{

			}
		},
		computed:{
			categories(){
				return this.$store.getters.getCategories;
			}
		},
		created() {
			if(this.$route.name != '博客园' && this.$route.query.user){
				this.$store.dispatch('loadCategories', {
					id: this.$route.query.user !== '' ? this.$route.query.user  : 1,
				});
			}
		}
	}
</script>

<style scoped lang="scss">
	.box-card .item:hover {
		color: #409EFF;
		cursor: pointer;
	}
	.box-card p {
		margin: 5px 0;
		font-size: 16px;
	}
	.box-card span {
		margin: 5px 0;
	}
	.card-icon {
		width: 20px;
		height: 20px;
		margin-right: 10px;
	}

	.category-item {
		margin-right: 10px;
	}

	@media only screen and (max-width: 683px){
		.d-flex{
			display: none;
		}
	}
</style>