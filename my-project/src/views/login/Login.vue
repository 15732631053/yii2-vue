<template>
  <div >
			<el-form ref="form" :model="form" label-width="80px">
		  <el-form-item label="用户名">
		    <el-input v-model="form.name"></el-input>
		  </el-form-item>
		  
		  <el-form-item label="密码">
		    <el-input type='password' v-model="form.pwd"></el-input>
		  </el-form-item>


		  <el-form-item>
		  	 <el-button type="primary" @click="toRegist">注册</el-button>
		    <el-button type="primary" @click="onSubmit">登陆</el-button>
		    <el-button>取消</el-button>
		  </el-form-item>
		</el-form>
  </div>
</template>

<script src="@/js/login/login.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

