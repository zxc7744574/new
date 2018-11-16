import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'index',
      component: () => import('./views/index.vue')
    },
    {
      path: '/index',
      name: 'index1',
      component: () => import('./views/index.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./views/login.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('./views/register.vue')
    }
  ]
})
