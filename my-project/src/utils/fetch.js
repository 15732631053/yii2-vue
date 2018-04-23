import Qs from 'qs';
import axios from 'axios';
import { MessageBox } from 'element-ui';
import md5 from 'js-md5';
import store from '@/store/store';
// 创建axios实例
const service = axios.create({
	baseURL: 'http://testlaravel/backend/web/', // api的base_url 以后放在env里
	timeout: 10000, // 请求超时时间
//	  withCredentials: true,   //加了这段就可以跨域了
	transformRequest: [function(data) {
		data = Qs.stringify(data);
		return data
	}],
});

// request拦截器
service.interceptors.request.use(config => {
	// Do something before request is sent
	//  if (store.getters.token) {
	//      //config.headers['X-Token'] = getToken(); // 让每个请求携带token--['X-Token']为自定义key 请根据实际情况自行修改
	//  }
	//  config.headers['Accept'] = 'text/plain';
	config.headers['Content-Type'] = 'application/x-www-form-urlencoded';
	store.dispatch("GET_LOGININFO", '')
	const loginInfo= store.getters.GET_LOGININFO;
	console.log(loginInfo);
	const defaultParams = {
		version: 11,  //web其实可以省略 
		platform: 'pcweb',
		token: (loginInfo!==null)?loginInfo.token:'', //后端获取 过期时间10分钟
		uid: (loginInfo!==null)?loginInfo.uid:'', 
		timestamps: Date.parse(new Date()),
	};
	//生成签名
	let params = {
		...defaultParams,
		...config.data
	};
    
	let newkey = Object.keys(params).sort();
	let [keysStr, keysVal] = ['', '']
	for(let i = 0; i < newkey.length; i++) {
		keysStr += newkey[i];
		keysVal += params[newkey[i]]
	}
	let sign = md5(keysStr + keysVal);
	params = {
		...params,
		'sign': sign,
	};
	(config.method == 'post') ? config.data = params: config.params = params
	return config;
}, error => {
	// Do something with request error
	console.log(error); // for debug
	Promise.reject(error);
})

// respone拦截器
service.interceptors.response.use(
	response => {
		//console.log(response);
		const res = response.data;
		if(res.code !== 200) {

			if(res.code == 400) {
				//需要登录
				MessageBox.confirm('需要登陆,亲', '提示', {
					confirmButtonText: '确定',
					cancelButtonText: '取消',
					type: 'warning'
				}).then(() => {
					console.log(process.env);
					window.location.href = process.env.BASE_PATH+'login';
				}).catch(() => {
				});
			}
			if(res.code == 401 || res.code == 403) {
				MessageBox({
					message: '没有操作权限,请联系管理员',
					type: 'error',
					duration: 5 * 1000
				});
			}
			// 登录过期了;
//			else if(res.code === 403) {
//				MessageBox.confirm('你已被登出，可以取消继续留在该页面，或者重新登录', '确定登出', {
//					confirmButtonText: '重新登录',
//					cancelButtonText: '取消',
//					type: 'warning'
//				}).then(() => {})
//			} else {
//				MessageBox({
//					message: res.msg,
//					type: 'error',
//					duration: 5 * 1000
//				});
//			}

		} else {

			return response;
		}
	},
	error => {

		console.log('err' + error); // for debug
		if(error.response.status == 401) {
			MessageBox.confirm('你已被登出，可以取消继续留在该页面，或者重新登录', '确定登出', {
				confirmButtonText: '重新登录',
				cancelButtonText: '取消',
				type: 'warning'
			}).then(() => {

			})
		} else {
			MessageBox({
				message: error.response.status == 403 ? '抱歉,您没有操作该功能的权限!' : error.message,
				type: 'error',
				duration: 5 * 1000
			});
		}

		return Promise.reject(error);
	});

export default service;