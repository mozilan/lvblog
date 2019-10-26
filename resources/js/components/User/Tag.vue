<template>
	<el-col class="tag">
		<el-card class="box-card">
			<div slot="header" class="d-flex align-items-center">
				<i class="el-icon-collection-tag"></i>
				<span>Ta的标签</span>
			</div>
			<div class="text item" v-for="tag in tags">
				<router-link :to="{name:'标签文章',params: {tag:tag.id},query:{user:tag.user_id}}"><el-tag size="mini" :type="type[Math.floor(Math.random()*type.length)]" class="tag-item">{{tag.name}}[{{tag.count}}]</el-tag></router-link>
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
		computed:{
			tags(){
				return this.$store.getters.getTags;
			}
		},
		created() {
			if(this.$route.name != '博客园' && this.$route.query.user){
				this.$store.dispatch('loadTags', {
					id: this.$route.query.user
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
	@media only screen and (max-width: 683px){
		.box-car:nth-child(2) {
			display: none;
		}
	}
</style>