<template>
  <div>
    <header class="navbar navbar-dark bg-dark">

      <div class="container-fluid d-flex justify-content-between align-items-center">
          <span class="navbar-brand mb-0 h1">Mi Dashboard</span>

          <div class="d-flex align-items-center gap-2">
            <p v-if="currentUser" class="mb-0 text-white text-uppercase">{{ currentUser }}</p>
            <button class="btn btn-outline-light btn-sm" @click="handleLogout">Cerrar sesión</button>
          </div>
        
      </div>
    </header>

    <div class="container-fluid">
      <div class="row flex-nowrap">
        <div class="col-auto sidebarWid p-0">
          <Sidebar />
        </div>
        <div class="col">
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
import { ref, onMounted } from 'vue';
const router = useRouter()

const currentUser = ref(null)

onMounted(async () => {
  const res = await fetch('/api/getCurrentUser.php', {
    credentials: 'include'
  })

  const data = await res.json();

  
  if (data.logged_in) {
    currentUser.value = data.username
  } else {
    currentUser.value = null
    router.push('/login')
  }

})

function handleLogout() {
  logout()
  router.push('/login')
}


</script>
