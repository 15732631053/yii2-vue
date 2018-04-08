<template>
	<div>
		edit

		<el-form :model="form"  ref="ruleForm2"  label-width="80px">

			<el-form-item label="标题">
				<el-input v-model="form.title"></el-input>
			</el-form-item>
			<mavon-editor v-model="form.content" />

			<el-form-item>
		    <el-button type="primary" @click="submitForm('ruleForm2')">提交</el-button>
		    <el-button @click="resetForm('ruleForm2')">重置</el-button>
			</el-form-item>
		</el-form>

	</div>
</template>

<script src="@/js/article/edit.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->