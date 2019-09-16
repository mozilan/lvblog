<template>
	<div class="tag">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<img class="card-icon" src="../../assets/biaoqian.png" />
				<span>热门分类</span>
			</div>
		<div v-for="category in categories" class="text item">
			<a href="#"><span style="float: left;">{{category.name}}</span></a>
			<el-tag style="float: right" size="mini" class="category-item" type="success"  @click="">[{{category.count}}]</el-tag>
			<div style="clear:both;"></div>
		</div>
		</el-card>
	</div>
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
			this.$store.dispatch('loadCategories', {
				id: this.$route.query.user != null ? this.$route.query.user : 1,
			});
		}
	}
</script>

<style scoped>
	.box-card .item:hover {
		color: #409EFF;
		cursor: pointer;
	}
	
	.box-card span {
		font-weight: bold;
	}
	
	.card-icon {
		width: 20px;
		height: 20px;
		margin-right: 10px;
	}
	
	.category-item {
		margin-right: 10px;
	}
</style>