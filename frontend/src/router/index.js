import { createRouter, createWebHistory } from 'vue-router'

import LoginComponent from '../components/login/LoginComponent.vue'
import DashboardComponent from '../components/dashboard/DashboardComponent.vue'


const routes = [
  { path: '/',  component: LoginComponent },
  { path: '/dashboard', name: 'dashboard', component: DashboardComponent }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router