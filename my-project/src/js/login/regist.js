import { AxiosCreate } from '@/api/login/login';
import md5 from 'js-md5';
import { isEmail } from '@/utils/validate';
export default {
	name: 'regist',
	data() {
		var checkname = (rule, value, callback) => {
			if(!value) {
				return callback(new Error('姓名不能为空'));
			}
			let name = {
				username: this.ruleForm2.username
			}
			AxiosCreate.checkoutName(name).then(response => {
				if(response.data.data == 0) {
					callback();
				} else {
					callback(new Error(response.data.msg));
				}

			})

			if(!value) {

			}
			//			if(1=1) {
			//				callback();
			//			} else {
			//				callback(new Error('xxx'));
			//			}
		};

		var checkEmail = (rule, value, callback) => {
			if(!value) {
				return callback(new Error('邮箱不能为空'));
			}
			if(isEmail(value) != false) {
				callback();
			} else {
				callback(new Error('不是合法邮箱'));
			}
		};
		var validatePass = (rule, value, callback) => {
			if(value === '') {
				callback(new Error('请输入密码'));
			} else {
				if(this.ruleForm2.checkPass !== '') {
					this.$refs.ruleForm2.validateField('checkPass');
				}
				callback();
			}
		};
		var validatePass2 = (rule, value, callback) => {
			if(value === '') {
				callback(new Error('请再次输入密码'));
			} else if(value !== this.ruleForm2.pwd) {
				callback(new Error('两次输入密码不一致!'));
			} else {
				callback();
			}
		};

		return {
			ruleForm2: {
				pwd: '',
				checkPass: '',
				email: '',
				username: '',
			},
			rules2: {
				username: [{
					validator: checkname,
					trigger: 'blur'
				}],
				pwd: [{
					validator: validatePass,
					trigger: 'blur'
				}],
				checkPass: [{
					validator: validatePass2,
					trigger: 'blur'
				}],
				email: [{
					validator: checkEmail,
					trigger: 'blur'
				}]
			}
		};
	},
	//created () {
	// console.log(validatePass);
	//	},
	created() {
		if(this.$store.state.loginInfo !== null) {
			this.$router.push({
				name: 'list',
				params: {}
			})
		}
	},
	methods: {
		submitForm(formName) {

			this.$refs[formName].validate((valid) => {
				if(valid) {
					this.ruleForm2.pwd = this.ruleForm2.checkPass = md5(this.ruleForm2.pwd);
					AxiosCreate.regist(this.ruleForm2).then(response => {
						if(response.data.data) {
							this.$alert('注册成功', '提示', {
								confirmButtonText: '确定',
								callback: action => {
									this.$message({
										type: 'info',
										message: `action: ${ action }`
									});
								}
							});

							var router = this.$router;
							setTimeout(function() {
								router.push({
									name: 'list',
									params: {}
								})
							}, 5000);
						}

					})
					console.log('submit!');
				} else {
					console.log('error submit!!');
					return false;
				}
			});
		},
		resetForm(formName) {
			//重置
			this.$refs[formName].resetFields();
		}
	}
}