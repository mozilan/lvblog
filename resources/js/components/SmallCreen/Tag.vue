<template>
	<el-col class="tag">
		<el-card class="box-card">
			<div class="text item" v-for="tag in tags">
				<router-link :to="{name:'标签文章',params: {tag:tag.id},query:{user:tag.user_id}}"><el-tag size="mini" :type="type[Math.floor(Math.random()*type.length)]" class="tag-item">{{tag.name}}[{{tag.count}}]</el-tag></router-link>
			</div>
			<div class="clear"></div>
		</el-card>
	</el-col>
</template>

<script>
	export default {
		name: 'sm_tag',
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