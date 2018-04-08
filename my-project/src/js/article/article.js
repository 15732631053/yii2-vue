import VueMarkdown from 'vue-markdown';
import { AxiosCreate } from '@/api/article/article';
//显示文章详情
export default {
	data() {
		return {
			article_id: "",
			show: false,
			author: '',
			title: '',
			updated_time: '',
			content: '',
		}
	},
	mounted() {
		let id = this.$route.params.id || false;
		this.article_id = id;
		if(this.article_id != '') {
			AxiosCreate.getdetail({
				id: this.article_id
			}).then(response => {
				if(response.data.data) {
					let data = response.data.data;
					this.author = data.uid;
					this.title = data.title;
					this.updated_time = data.updated_time;
					this.content = data.content;
					this.show = true;
				}

			})
		}

	},

	components: {
		VueMarkdown // 声明组件
	}

}