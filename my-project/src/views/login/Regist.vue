<template>
  <div >
		<el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="100px" class="demo-ruleForm">
			 <el-form-item label="用户名" prop="username">
		    <el-input v-model="ruleForm2.username" auto-complete="off"></el-input>
		  </el-form-item>
		  <el-form-item label="密码" prop="pwd">
		    <el-input type="password" v-model="ruleForm2.pwd" auto-complete="off"></el-input>
		  </el-form-item>
		  <el-form-item label="确认密码" prop="checkPass">
		    <el-input type="password" v-model="ruleForm2.checkPass" auto-complete="off"></el-input>
		  </el-form-item>
		  <el-form-item label="邮箱" prop="email">
		    <el-input v-model.number="ruleForm2.email"></el-input>
		  </el-form-item>
		  <el-form-item>
		    <el-button type="primary" @click="submitForm('ruleForm2')">提交</el-button>
		    <el-button @click="resetForm('ruleForm2')">重置</el-button>
		  </el-form-item>
		</el-form>
  </div>
</template>

<script src="@/js/login/regist.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->

