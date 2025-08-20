<template>
  <div class="d-flex flex-column min-vh-100">
    <!-- HEADER -->
    <header class="navbar navbar-dark bg-dark">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <span class="navbar-brand mb-0 h1">Mi Dashboard</span>

        <div class="btn-group">
          <button class="btn btn-secondary btn-sm" type="button">
            <i class="bi bi-person-circle text-white me-2"></i>
            <span v-if="currentUser" class="mb-0 text-white text-uppercase" style="font-size: 12px;">
              {{ currentUser }}
            </span>
          </button>
          <button
            type="button"
            class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <span class="visually-hidden">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu w-100">
            <li>
              <a
                class="dropdown-item me-2"
                @click="handleLogout"
                style="font-size: 15px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;"
              >
                <i class="bi bi-power"></i> Cerrar sesión
              </a>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <!-- LAYOUT PRINCIPAL -->
    <div class="flex-grow-1 container-fluid">
      <div class="row flex-nowrap h-100">
        <!-- Sidebar -->
        <div class="col-auto sidebarWid p-0 d-flex flex-column">
          <Sidebar />
        </div>

        <!-- Contenido principal -->
        <div class="col d-flex flex-column">
          <div class="flex-grow-1">
            <router-view />
          </div>
        </div>
      </div>
    </div>

    <!-- Footer (fuera del container, ocupa todo el ancho) -->
    <Footer></Footer>
  </div>
</template>


<script setup>
import { logout } from '../auth.js'
import { useRouter } from 'vue-router'
import Sidebar from '../components/sidebar/Sidebar.vue'
import Footer from '../components/footer/Footer.vue'
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
