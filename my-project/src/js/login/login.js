import {AxiosCreate} from '@/api/login/login';
import md5 from 'js-md5';
export default {
  name: 'login',
  data () {
    return {
      form: {
          name: '',
          pwd:'',
    	}
    }
  },
  created () {
//	var data={name:'admin',password:'admin'};
//	var data={uid:'GkNedge7'}
//	var submitFun = AxiosCreate.submitAdd(data);
//	console.log(submitFun);
  },
//computed:{
//	encryptPwd:function(){
//		return md5(this.password)
//	}
//},
  methods: {
      onSubmit() {
      	this.form.pwd=md5(this.form.pwd);
//    	var submitFun = AxiosCreate.login(this.form);//简单的调用接口
      	AxiosCreate.login(this.form).then(response => {       
                console.log(response.data.data); 
                
            })
      
      }
    }
}