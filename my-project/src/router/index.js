import Vue from 'vue'
import Router from 'vue-router'
//import HelloWorld from '@/components/HelloWorld';
import login from '@/views/login/Login';
import regist from '@/views/login/Regist';
import article from '@/views/article/Article'
import list from '@/views/article/List';
import edit_article from '@/views/article/Edit'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'login',
      component: login
    },
     {
      path: '/regist',
      name: 'regist',
      component: regist
    },
    {
      path: '/article',
      name: 'article',
      component: article
    },
     {
      path: '/list',
      name: 'list',
      component: list
    },
    {
      path: '/edit',
      name: 'edit_article',
      component: edit_article
    },
  ]
})
