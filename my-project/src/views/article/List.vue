<template>
	<div>
		list page
		<router-link to='/edit'>写文章</router-link>
		<el-table ref="singleTable" :data="list" highlight-current-row @current-change="handleCurrentChange" style="width: 100%">
			<el-table-column type="index" label="序号" width="50">
			</el-table-column>
			<el-table-column property="title" label="标题" width="120">
			</el-table-column>
			<el-table-column property="updated_time" label="日期" width="120">
			</el-table-column>
			<el-table-column label="操作">
				<template slot-scope="scope">
					<el-button size="mini" @click="handleEdit(scope.$index, scope.row)">查看</el-button>

				</template>
			</el-table-column>
		</el-table>

		<el-pagination small layout="prev, pager, next" @current-change="pageChange" :current-page='pageConfig.page' :page-size="pageConfig.pagesize" :total="total">
		</el-pagination>
	</div>

</template>

<script src="@/js/article/list.js"></script>

<!-- Add "scoped" attribute to limit CSS to this component only -->