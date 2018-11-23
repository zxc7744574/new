import Vue from 'vue'
import Router from 'vue-router'

// in development-env not use lazy-loading, because lazy-loading too many pages will cause webpack hot update too slow. so only in production use lazy-loading;
// detail: https://panjiachen.github.io/vue-element-admin-site/#/lazy-loading

Vue.use(Router)

/* Layout */
import Layout from '../views/layout/Layout'

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirect in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    title: 'title'               the name show in submenu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar,
  }
**/
export const constantRouterMap = [
  { path: '/login', component: () => import('@/views/login/index'), hidden: true },
  { path: '/404', component: () => import('@/views/404'), hidden: true },

  {
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    name: 'Dashboard',
    hidden: true,
    children: [{
      path: 'dashboard',
      component: () => import('@/views/dashboard/index')
    }]
  },

  {
    path: '/example',
    component: Layout,
    children: [
      {
        path: 'table',
        name: 'Table',
        component: () => import('@/views/table/index'),
        meta: { title: '文章管理', icon: 'table' }
      },
    ]
  },

  {
    path: '/form',
    component: Layout,
    redirect: '/nested/menu1',
    name: 'form',
    meta: {
      title: '权限管理',
      icon: 'form'
    },
    children: [
      {
        path: 'index',
        name: 'Form',
        component: () => import('@/views/form/index'),
        meta: { title: '权限树', icon: 'form' }
      },
      {
        path: 'index1',
        name: 'Form1',
        component: () => import('@/views/form/index1'),
        meta: { title: '权限组', icon: 'form' }
      },
      {
        path: 'index2',
        name: 'Form2',
        component: () => import('@/views/form/index2'),
        meta: { title: '权限角色', icon: 'form' }
      }
    ]
  },

  {
    path: '/nested',
    component: Layout,
    children: [
      {
        path: 'menu1',
        name: 'Menu1',
        component: () => import('@/views/nested/menu1/index'), 
        meta: { title: '账号管理',icon: 'nested' },
      },
    ]
  },

  {
    path: '/link',
    component: Layout,
    children: [
      {
        path: 'link',
        name: 'Link',
        component: () => import('@/views/link/index'), 
        meta: { title: '底部链接', icon: 'link' }
      }
    ]
  },

  { path: '*', redirect: '/404', hidden: true }
]

export default new Router({
  // mode: 'history', //后端支持可开
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})
