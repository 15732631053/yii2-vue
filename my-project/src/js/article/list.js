//显示文章详情

import { AxiosCreate } from '@/api/article/article';
export default {
	data() {
		return {
			list: [],
			pageConfig: {
				page: 1,
				pagesize: 10,
			},
			total: null,

		}
	},
	components: {

	},
	created() {
		AxiosCreate.getlist(this.pageConfig).then(response => {
			if(response.data.data) {
				this.list = (response.data.data);
				this.pageConfig.page = parseInt(response.data.page)
				console.log(response.data.counts);
				this.total = parseInt(response.data.counts)

			}

		})
	},
	methods: {
		handleEdit(index, row) {
			this.$router.push({
				name: 'article',
				params: {
					id: row.id
				}
			})

			console.log(index, row);
		},
		handleCurrentChange() {

		},
		pageChange(val) {
			//查看分页
			this.pageConfig.page = parseInt(val)
			AxiosCreate.getlist(this.pageConfig).then(response => {
				if(response.data.data) {
					this.list = (response.data.data);
					this.pageConfig.page = parseInt(response.data.page)
					console.log(response.data.counts);
					this.total = parseInt(response.data.counts)
				}

			})
		}
	}

}