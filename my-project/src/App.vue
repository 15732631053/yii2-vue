<template>
  <div id="app">
    <img src="./assets/logo.png">
   	<!--<el-button type="primary" @click='loginOut' v-show='isLogin'>退出</el-button>-->
    <router-view/>   
  </div>
</template>

<script>
export default {
  name: 'App',
  data(){
  	return {
  		isLogin:false,
  	}
  },
  mounted : function(){
  	this.isLogin = (this.$store.state.loginInfo===null)?false:true;
//	MessageBox.confirm('需要登陆,亲', '提示', {
//					confirmButtonText: '确定',
//					cancelButtonText: '取消',
//					type: 'warning'
//				}).then(() => {
//					console.log(process.env);
//					window.location.href = process.env.BASE_PATH+'login';
//				}).catch(() => {
//				});
  },
  methods:{
  	loginOut:function(){
  		this.isLogin = false;
  		console.log(this.$store.state.loginInfo)
  		this.$store.dispatch('CLEAN_LOGININFO');
  	}
  },
  
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
