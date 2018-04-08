import VueMarkdown from 'vue-markdown';
import { AxiosCreate } from '@/api/article/article';

export default {
	data() {
		return {
			article_id: "",
			show: false,
			form: {
				author: '',
				title: '',
				updated_time: '',
				content: '',
			}

		}
	},
	mounted() {

	},

	components: {},
	methods: {
		submitForm(formName) {

			this.$refs[formName].validate((valid) => {
				if(valid) {
					AxiosCreate.create(this.form).then(response => {

						this.$router.push({
							name: 'list',
							params: {
//								id: row.id
							}
						})

					})
					console.log(this.form);
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