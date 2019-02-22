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
    },
    {
      path: '/detail',
      name: 'detail',
      component: () => import('./views/detail.vue')
    },
    {path: '/vue',name: 'vue',component: () => import('./views/index.vue')},
    {path: '/jquery',name: 'jquery',component: () => import('./views/index.vue')},
    {path: '/nodejs',name: 'nodejs',component: () => import('./views/index.vue')},
    {path: '/tp3',name: 'tp3',component: () => import('./views/index.vue')},
    {path: '/tp5',name: 'tp5',component: () => import('./views/index.vue')},
    {path: '/linux',name: 'linux',component: () => import('./views/index.vue')},
    {path: '/xshell',name: 'xshell',component: () => import('./views/index.vue')},
    {path: '/docker',name: 'docker',component: () => import('./views/index.vue')},
    {path: '/es6',name: 'es6',component: () => import('./views/index.vue')},
    {path: '/zz',name: 'zz',component: () => import('./views/index.vue')},
    {path: '/webpack',name: 'webpack',component: () => import('./views/index.vue')},
    {path: '/git',name: 'git',component: () => import('./views/index.vue')},
  ]
})

