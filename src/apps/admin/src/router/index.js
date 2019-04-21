import Vue from 'vue'
import Router from 'vue-router'
import Meta from 'vue-meta'
import sess from '@/common/sess'

import Index from '@/components/index'
import UserIndex from '@/components/user'

import Login from '@/components/login'

import DogAdd from '@/components/dog/add'
import DogInfo from '@/components/dog/info'
import DogIndex from '@/components/dog/index'

import ArticleCategory from '@/components/article/category'

Vue.use(Router)
Vue.use(Meta)

var dateFormat = require('dateformat')
Vue.filter('time', function (value, format) {
  if (value) {
    var d = new Date()
    d.setTime(value * 1000)
    return dateFormat(d, format)
  }
  return ''
})

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Index',
      component: Index
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/user',
      name: 'UserIndex',
      component: UserIndex
    },
    {
      path: '/dog',
      name: 'DogIndex',
      component: DogIndex
    },
    {
      path: '/dog/add',
      name: 'DogAdd',
      component: DogAdd
    },
    {
      path: '/dog/info',
      name: 'DogInfo',
      component: DogInfo
    },
    {
      path: '/article/category',
      name: 'ArticleCategory',
      component: ArticleCategory
    }
  ]
})

router.beforeEach((route, redirect, next) => {
  if (!sess.isLogin() && route.path !== '/login') {
    next({
      path: '/login',
      query: {redirect: route.fullPath}
    })
  } else {
    next()
  }
})

export default router
