<template>
	<el-col class="tag">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<i class="el-icon-collection-tag"></i>
				<span>标签云</span>
			</div>
			<div class="text item" v-for="tag in tags ">
				<router-link :to="{name:'标签文章',params: {tag:tag.id}}"><el-tag size="mini" :type="type[Math.floor(Math.random()*type.length)]" class="tag-item">{{tag.name}}[{{tag.count}}]</el-tag></router-link>
			</div>
			<div class="clear"></div>
		</el-card>
	</el-col>
</template>

<script>
	export default {
		name: 'tag',
		data () {
			return {
				type:['success','info','warning','danger'],
			}
		},
		methods: {

		},
		mounted:{

		},
		computed:{
			tags(){
				return this.$store.getters.getTags;
			}
		},
		created() {
			this.$store.dispatch('loadTags', {
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