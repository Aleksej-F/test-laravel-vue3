import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

import { useUsersStore } from '../stores/Users.js'
import { useMessageStore } from '../stores/message.js'

const router = createRouter({
  // history: createWebHistory(import.meta.env.BASE_URL),
  history: createWebHistory(),
  scrollBehavior(to, from, savedPosition) {
    // всегда прокручивать до верха
    // return { top: 10, el: 'ecophon' }
    // return { top: 10,}
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      // component: () => import('')
    },
    {
      path: '/tasklist/:id',
      name: 'taskList',
      meta: {autch: false,},
      component: () => import('../views/TaskListView.vue'),
    },
    
    {
      path: '/tasklist/share/:id',
      name: 'taskListShare',
      meta: {autch: false,},
      component: () => import('../views/TaskListShareView.vue'),
    },
    {
      path: '/logout',
      name: 'logout',
      meta: {autch: true, loyout: 'Empty'},
      component: () => import('../views/Logout.vue'),
      props: true,
    },
    {
      path: '/login',
      name: 'login',
      meta: {autch: false, loyout: 'Empty'},
      component: () => import('../views/Login.vue'),
      props: true,
    },
    {
      path: '/signup',
      name: 'signup',
      meta: {autch: false, loyout: 'Empty'},
      component: () => import('../views/Signup.vue'),
      props: true,
    },
    {
      path: '/admins-panel',
      name: 'adminsPanel',
      meta: {autch: true, loyout: 'Admin'},
      component: () => import('../views/Admin/AdminsPanelView.vue'),
    },
   
   
  ]
})

router.beforeEach((to, from, next) => {
  const requireAuth = to.meta.autch
  const page = localStorage.getItem('pageLink') ?
    localStorage.getItem('pageLink') : "/"

  const userAutch = localStorage.getItem('token') 
  // ?    true : false
  //  console.log('userAutch', userAutch)
  
   console.log(from)
   console.log(to)
  if ((to.name === 'logout' || to.name === 'logoutlink' || to.name ==='signup')
    &(from.name !== 'logout' & from.name !== 'logoutlink' & from.name !=='signup')
  
  ) {
    console.log("page true" )
    localStorage.setItem('pageLink', from.path);
  //   // store.dispatch('setPage', from.path)
    
  } else { 
    console.log("page false" )

  }
  
  if (to.name === 'login' && userAutch){
    next('/logout')
  }
  
  if (requireAuth && !userAutch) {
    next('/login')
  } else {
    next()
  }
})
export default router
