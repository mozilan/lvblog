<template>
	<el-col class="friend">
		<el-card class="box-card">
		  <div slot="header" class="d-flex align-items-center">
		  	<i class="el-icon-paperclip"></i>
		    <span>友链</span>
		    <el-button class="ml-auto" style="padding: 3px 0" type="text">
		    	<!--<router-link :to="{name:'互换友链'}" tag="span">互换友链</router-link>-->
		    </el-button>
		  </div>
			<div class="lv-clear-both"></div>
			<el-row v-for="(item,index) in friends" :key="index">
			<el-col :span="24"  style="padding: 5px 0">
				<div class="lv-clear-both"></div>
				<el-col :lg="4" :md="6" :sm="6" :xs="4" class="item">
					<div class="lv-clear-both"></div>
					<a :href="item.url">
						<el-avatar :size="40" :src="item.avatar"></el-avatar>
					</a>
				</el-col>
				<el-col :lg="20" :md="18" :sm="20" :xs="18" style="padding-left:10px">
					<el-col :span="24" class="name">
						{{item.name}}
					</el-col>
					<el-col :span="24" style="font-size: 14px;">
						<marquee ref="des" scrollamount="2" style="margin-left: 30px;background-color: #ffffff">
							<i class="el-icon-position"></i>{{item.description}}
						</marquee>
					</el-col>
				</el-col>
				<div class="lv-clear-both"></div>
			</el-col>
			</el-row>
		</el-card>
	</el-col>
</template>
<script>
export default {
    name: 'friend',
	created(){
		this.$store.dispatch('loadFriends');
	},
	computed:{
    	friends(){
			return this.$store.getters.getFriends.data;
		}
	}
}
</script>

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
</style>