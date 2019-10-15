<template>
<div class="L-footer">
	<el-main class="main">
			<el-row>
			<!--<el-col :span="8" class="item-col">
				<div class="title">常用工具</div>
				<div class="item"><a href="#" class="out-link">aaa</a></div>
				<div class="item"><a href="#" class="out-link">aa</a></div>
			</el-col>-->
			<el-col :span="8" class="item-col">
				<div class="title">快读通道</div>
				<div class=""><a href="#" class="out-link">码云</a></div>
				<div class=""><a href="#" class="out-link">CSDN</a></div>
				<div class=""><a href="#" class="out-link">后台管理</a></div>
			</el-col>
			<el-col :span="8" class="item-col weside">
				<div class="item">
					<i class="el-icon-caret-right"></i>
					本站已稳定运行1天4时36分22秒
				</div>
				<div class="item">
					<i class="el-icon-caret-right"></i>
					mozilan@aliyun.com
				</div>
				<div class="item">
					<i class="el-icon-caret-right"></i>
					© 蓝默空间-博客
				</div>
			</el-col>
		</el-row>
	</el-main>
</div>
</template>

<script>
export default {
  	name: 'Lfooter',
	computed:{
		configs(){
			return this.$store.getters.getConfigs;
		}
	}
}
</script>

<style scoped lang="scss">
.L-footer{
	text-align: center;
	color: #fff;
	background-color: #000;
}
.main{
	width: 70%;
	margin: 0 auto;
	color: #ccc;
}
.out-link{
	text-decoration: none;
	color: #ccc;
}
.out-link:hover{
	color: #ffffff;
}
.item-col{
	text-align: left;
}
.item-col.weside{
	font-size: 14px;
}
.item-col .title{
	color: #ddd;
	margin-bottom: 10px;
}
.item span{
	margin-right: 5px;
}
</style>