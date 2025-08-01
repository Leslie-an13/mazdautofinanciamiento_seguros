import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import MainLayout from '../views/MainLayout.vue'
import DamagePolicy from '../views/DamagePolicy.vue';
import PolicyDocument from '../views/PolicyDocument.vue';
import Users from '../views/Users.vue';
import { currentUser } from '../auth';


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
    meta: { 
      requiresAuth: true,
      role: 'admin'
    },
    children: [{
      path: '',
      component: DamagePolicy
    }]
  },
  { path: '/policyDocument', component: PolicyDocument,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: 'admin'
    },
    children: [{
      path: '',
      component: PolicyDocument
    }]
  },
  { path: '/users', component: Users,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: 'admin'
    },
    children: [{
      path: '',
      component: Users
    }]


  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !currentUser.value) {
    next('/login')
  } else if (to.meta.role && currentUser.value?.role !== to.meta.role) {
    alert('No tienes permiso para entrar aquí')
    next(false) // bloquea el acceso
  } else {
    next() // deja pasar
  }
})

export default router