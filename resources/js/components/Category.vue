<template>
	<div class="tag">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<img class="card-icon" src="../../assets/biaoqian.png" />
				<span>热门分类</span>
			</div>
		<div v-for="cat in cate()" class="text item"><a href="#"><el-tag size="mini" class="category-item" type="success"  @click="">{{cat.name}}[12]</el-tag></a></div>
		</el-card>
	</div>
</template>

<script>
	export default {
		name: 'category',
		methods: {
			category(name) {
				this.$router.push({
					name: 'category',
					params: {
						'name': name
					}
				});
			},
			cate(){
				return this.$store.getters.getCategories;
			}
		},
		data(){
			return{
				categories: [
					{ id : 1 , name:'Laravel'},
					{ id : 2, name: 'Bar' }
				],
			}
		},
		computed:{

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