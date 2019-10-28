<template>
	<el-col class="tag">
		<el-card class="box-card">
			<div class="text item" v-for="category in categories">
				<router-link :to="{name:'分类文章',params: {category:category.id},query:{user:category.user_id}}"><el-tag size="mini" :type="type[Math.floor(Math.random()*type.length)]" class="tag-item">{{category.name}}[{{category.count}}]</el-tag></router-link>
			</div>
			<div class="clear"></div>
		</el-card>
	</el-col>
</template>

<script>
	export default {
		name: 'sm_category',
		data () {
			return {
				type:['success','info','warning','danger'],
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
	.tag-item {
		margin-right: 10px;
	}
	.item{
		float: left;
	}
	.clear{
		clear: both;
	}
</style>