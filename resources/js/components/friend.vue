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
			<el-col :span="24" v-for="(item, index) in friend_box" style="padding: 5px 0">
				<div class="lv-clear-both"></div>
				<el-col :lg="4" :md="6" :sm="6" :xs="4" class="item">
					<div class="lv-clear-both"></div>
					<a href="https://mozilan.com">
						<el-avatar :size="40" :src="item.avatar"></el-avatar>
					</a>
				</el-col>
				<el-col :lg="20" :md="18" :sm="20" :xs="18" style="padding-left:10px">
					<el-col :span="24" class="name">
						{{item.name}}
					</el-col>
					<el-col :span="24" style="font-size: 14px;background: rgba(0, 0, 0, 0) url(http://localhost/uploads/images/articles/201910/10/1_1570714148_vWjH3m1sqs.gif) no-repeat scroll -93px 50%;background-size: 80%;">
						<marquee ref="des" scrollamount="2" @mouseover="startScroll(index)" style="margin-left: 30px;background-color: #ffffff">
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
					name:'蓝墨科技蓝墨科技蓝墨科技蓝墨科技蓝墨科技',
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
		// this.$refs.des.stop();
	},
    methods:{
        // startScroll(index){
        // 	this.$refs.des[index].start();
        // }
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