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
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/project/:id',
      name: 'project',
      component: () => import('../views/ProjectsView.vue')
      
    },
    {
      path: '/ecophon',
      name: 'ecophon',
      component: () => import('../views/EcophonView.vue'),
      children: [
        { 
          path: 'modular_ceilings', 
          component: () => import('../components/TheEcophonModularCeilings.vue') 
        },
        { 
          path: 'hanging_elements',
          component: () => import('../components/TheEcophonHangindElements.vue') 
        },
        { 
          path: 'wall_panels', 
          component: () => import('../components/TheEcophonWallPanels.vue') 
        }
      ],
    },
    { 
      path: '/panels-sml/:name',
      name: 'panels-sml',
      component: () => import('../views/PanelsSmlView.vue'),
      children: [
        { 
          path: '/panels-sml', 
          component: () => import('../views/PanelsSmlView.vue') 
        }
      ]

    },
    // {
    //   path: '/ceilings/:name',
      
    //   children: [{ 
    //     path: 'ceilings', 
        
    //     component: () => import('../views/CeilingsView.vue') 
    //   }],
    //   component: () => import('../views/CeilingsView.vue')
    // },
    {
      path: '/ceilings',
      name: 'ceilings',
      component: () => import('../views/CeilingsView.vue'),
      children: [
        { 
          path: 'grillato', 
          name: 'grillato',
          component: () => import('../components/TheCeilingsGrillato.vue') 
        },
        { 
          path: 'rockfon',
          name: 'rockfon',
          component: () => import('../components/TheCeilingsRockfon.vue') 
        },
        { 
          path: 'acoustics',
          name: 'acoustics', 
          component: () => import('../components/TheCeilingsAcoustics.vue') 
        }
      ],
      
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
    {
      path: '/admins-panel/facilities',
      name: 'adminsFacilities',
      meta: {autch: true, loyout: 'Admin'},
      component: () => import('../views/Admin/AdminsFacilitiesView.vue'),
    },
    {
      path: '/admins-panel/facility/:id/:operation',
      name: 'adminsFacilitiesCreate',
      meta: {autch: true, loyout: 'Admin'},
      component: () => import('../views/Admin/AdminsFacilityCreateView.vue'),
    },
    {
      path: '/admins-panel/facility/:id/description/:operation',
      name: 'adminsFacilityDescriptionCreate',
      meta: {autch: true, loyout: 'Admin'},
      component: () => import('../views/Admin/AdminsFacilityDescriptionCreateView.vue'),
    },
    {
      path: '/admins-panel/facility/:id/slider/edit',
      name: 'adminsFacilitySliderCreate',
      meta: {autch: true, loyout: 'Admin'},
      component: () => import('../views/Admin/AdminsFacilitySliderCreateView.vue'),
    },
    {
      path: '/testil',
      name: 'testil',
      meta: {autch: false,},
      component: () => import('../views/TestilView.vue'),
    }
  ]
})

router.beforeEach((to, from, next) => {
  const requireAuth = to.meta.autch
  const page = localStorage.getItem('pageLink') ?
    localStorage.getItem('pageLink') : "/"

  const userAutch = localStorage.getItem('token') 
  // ?    true : false
   console.log('userAutch', userAutch)
  
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
