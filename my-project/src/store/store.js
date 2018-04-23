import Vue from 'vue';
import Vuex from 'vuex';
import myStorage from '@/utils/localStorage'
Vue.use(Vuex)
let store= new Vuex.Store({
    state: {
        loginInfo: null,//当前用户简要信息
    },
    getters: {
        GET_LOGININFO(state) {
            //先从state里面获取用户登录信息
            let loginInfo = state.loginInfo;
            //如果 state 里面获取不到，那么从localStorage里面获取
            console.log('here');
            if(!loginInfo){
            	 console.log('not');
                loginInfo = JSON.parse(myStorage.getData('loginInfo') || null)
                state.loginInfo = loginInfo;
            }
            console.log(loginInfo);
            return loginInfo;
        },
    },
    mutations: {
        SET_LOGININFO(state, data){
        	console.log(data);
            state.userInfo = data;
            myStorage.setData(data,'loginInfo');
        },
        GET_LOGININFO(state, data) {
            let loginInfo = state.loginInfo;
            
            if(!loginInfo){
                loginInfo = JSON.parse(myStorage.getData('loginInfo') || null)
                state.loginInfo = loginInfo;
            }
            return loginInfo;
        },
     
    },		
    actions: {
        Login(context, data) {
           context.commit('SET_LOGININFO', data);
                //保存到localStorage里面
            return true;                
        },
        GET_LOGININFO(context,data) {
            //先从state里面获取用户登录信息
           return context.commit('GET_LOGININFO', data);
        },
         CLEAN_LOGININFO(state) {
			state.loginInfo = null;
			myStorage.cleanData('loginInfo');
        },
    }
})
store.getters.GET_LOGININFO

export default store;