import { AxiosCreate } from '@/api/login/login';
import md5 from 'js-md5';
import { mapState, mapActions } from '@/store/store'
import { MessageBox } from 'element-ui';
export default {
	name: 'login',
	data() {
		return {
			form: {
				name: '',
				pwd: '',
			}
		}
	},
	created() {
		if(this.$store.state.loginInfo !== null) {
			this.$router.push({
				name: 'list',
				params: {}
			})
		}
	},
	//computed:{
	//	encryptPwd:function(){
	//		return md5(this.password)
	//	}
	//},
	methods: {
		onSubmit() {
			this.form.pwd = md5(this.form.pwd);
			//    	var submitFun = AxiosCreate.login(this.form);//简单的调用接口
			AxiosCreate.login(this.form).then(response => {
				console.log(response.data.data);
				if(response.data.data != '') {
					let logininfo = {};
					logininfo.uid = response.data.data.id;
					logininfo.token = response.data.token;
					this.$store.dispatch("Login", logininfo)
					this.$message({
						showClose: true,
						message: '登陆成功',
						type: 'success'
					});
					var router=this.$router;
					setTimeout(function() {
						router.push({
							name: 'list',
							params: {}
						})
					}, 5000);

				} else {
					this.form.pwd = '';
					this.$message({
						showClose: true,
						message: '密码错误',
						type: 'warning'
					});
				}

			})

		},
		toRegist() {
			this.$router.push({
				name: 'regist',
				params: {}
			})
		}
	}
}