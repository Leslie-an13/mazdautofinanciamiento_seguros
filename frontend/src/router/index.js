import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import MainLayout from '../views/MainLayout.vue'
import DamagePolicy from '../views/DamagePolicy.vue';


const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: Login },
  { path: '/dashboard',
    component: MainLayout,
    meta: { requiresAuth: true },
    children: [{
        path: '',
        component: Dashboard
    }]
  },
  { path: '/damagePolicy', component: DamagePolicy,
    component: MainLayout,
    meta: { requiresAuth: true},
    children: [{
      path: '',
      component: DamagePolicy
    }]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to, from, next) => {
  const user = localStorage.getItem('user')

  if (to.meta.requiresAuth && !user) {
    next('/login')
  } else if (to.path === '/login' && user) {
    next('/dashboard')
  } else {
    next()
  }
})

export default router