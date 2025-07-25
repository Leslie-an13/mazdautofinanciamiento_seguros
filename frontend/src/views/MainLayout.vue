<template>
  <div>
    <header class="navbar navbar-dark bg-dark">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Mi Dashboard</span>
        <button class="btn btn-outline-light btn-sm" @click="handleLogout">Cerrar sesión</button>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 p-0">
          <Sidebar />
        </div>
        <div class="col-md-10 p-4">
          <router-view />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { logout } from '../auth.js'
import { useRouter } from 'vue-router'
import Sidebar from '../components/sidebar/Sidebar.vue'

const router = useRouter()

function handleLogout() {
  logout()
  router.push('/login')
}
</script>
