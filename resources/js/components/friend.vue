<template>
	<div class="friend">
		<el-card class="box-card">
		  <div slot="header" class="d-flex align-items-center">
		  	<img class="card-icon" src="../../assets/lianjie.png"/>
		    <span>友链</span>
		    <el-button class="ml-auto" style="padding: 3px 0" type="text">
		    	<router-link to="/index" tag="span">互换友链</router-link>
		    </el-button>
		  </div>
			<div class="text item"><a href="#">蓝默的博客</a></div>
		  	<div class="text item"><a href="#">刘三金的博客</a></div>
			<div class="text item"><a href="#">IT疯子也的博客</a></div>
		</el-card>
	</div>
</template>

<script>
export default {
  name: 'friend'
}
</script>

<style scoped>
.box-card .item a{
	text-decoration: none;
	/*color: #F56C6C;*/
}
.box-card span{
	font-weight: bold;
}
.card-icon{
	width: 20px;
	height: 20px;
	margin-right: 10px;
}
</style>