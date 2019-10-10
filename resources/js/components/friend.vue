<template>
	<el-col class="friend">
		<el-card class="box-card">
		  <div slot="header" class="d-flex align-items-center">
		  	<i class="el-icon-paperclip"></i>
		    <span>友链</span>
		    <el-button class="ml-auto" style="padding: 3px 0" type="text">
		    	<router-link to="/index" tag="span">互换友链</router-link>
		    </el-button>
		  </div>
			<div class="lv-clear-both"></div>
			<el-col :span="24"  v-for="(item, index) in friend_box" >
				<div class="lv-clear-both"></div>
				<el-col :lg="4" :md="6" :sm="6" :xs="4" class="text item">
					<div class="lv-clear-both"></div>
					<a href="https://mozilan.com">
						<el-avatar :size="35" :src="item.avatar"></el-avatar>
					</a>
				</el-col>
				<el-col :lg="20" :md="18" :sm="20" :xs="18">
					<el-col :span="24">
						{{item.name}}
					</el-col>
					<el-col :span="24" style="font-size: 14px">
						<marquee ref="des" scrollamount="2" @mouseover="startScroll(index)">
							<i class="el-icon-position"></i>{{item.des}}
						</marquee>
					</el-col>
				</el-col>
				<div class="lv-clear-both"></div>
			</el-col>
		</el-card>
	</el-col>
</template>

<script>
export default {
  name: 'friend',
	data () {
		return {
			desv:2,
			friend_box:[
				{
					name:'蓝墨科技',
					avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
					des:'向上的路并不拥挤'
				},
				{
					name:'蓝墨科技',
					avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
					des:'向上的路并不拥挤，而有的人选择了安逸，向上的路并不拥挤'
				},
				{
					name:'蓝墨科技',
					avatar:'https://avatars0.githubusercontent.com/u/54885220?v=4',
					des:'向上的路并不拥挤，而有的人选择了安逸向上的路并不拥挤，向上的路并不拥挤，而有的人选择了安逸'
				},
			]
		}
	},
	created() {
	}
	,mounted() {
		this.$refs.des.stop();
	},
    methods:{
        startScroll(index){
        	this.$refs.des[index].start();
        }
    }
}
</script>

<style scoped lang="scss">
	.box-card{
		padding-bottom: 20px;
	}
	.box-card .item a{
		text-decoration: none;
		/*color: #F56C6C;*/
		margin: 8px auto;
	}
	.box-card span{
		font-weight: bold;
	}
</style>