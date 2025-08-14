import { createRouter, createWebHistory } from 'vue-router'

import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'
import MainLayout from '../views/MainLayout.vue'
import DamagePolicy from '../views/DamagePolicy.vue';
import PolicyDocument from '../views/PolicyDocument.vue';
import ClaimsModule from '../views/ClaimsModule.vue';
import AccessDenied from '../views/AccessDenied.vue';
import ClaimsPayment from '../views/ClaimsPayment.vue';
import UploadAndViewPolicies from '../views/UploadAndViewPolicies.vue';
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
      role: ['admin', 'Gestor de siniestros']
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
      role: ['admin', 'Tesorero']
    },
    children: [{
      path: '',
      component: PolicyDocument
    }]
  },
  { path: '/claimsModule', component: ClaimsModule,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: ['admin', 'Gestor de siniestros']
    },
    children: [{
      path: '',
      component: ClaimsModule
    }]
  },
  { path: '/claimsPayment', component: ClaimsPayment,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: ['admin', 'Auxiliar contable']
    },
    children: [{
      path: '',
      component: ClaimsPayment
    }]
  },
  { path: '/uploadAndViewPolicies', component: UploadAndViewPolicies,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: ['admin']
    },
    children: [{
      path: '',
      component: UploadAndViewPolicies
    }]
  },
  { path: '/users', component: Users,
    component: MainLayout,
    meta: {
      requiresAuth: true,
      role: ['admin']
    },
    children: [{
      path: '',
      component: Users
    }]
  }, 
  {
   path: '/denegado',
   name: 'AccessDenied',
   component: AccessDenied
  }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !currentUser.value) {
    next('/login')
  } else if ( to.meta.role && Array.isArray(to.meta.role) && !to.meta.role.includes(currentUser.value?.role)) {
   // alert('No tienes permiso para entrar aquí')
    next('/denegado') // bloquea el acceso
  } else {
    next() // deja pasar
  }
})
export default router