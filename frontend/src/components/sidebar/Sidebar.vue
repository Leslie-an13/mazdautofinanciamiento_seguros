<template>
  <div class="vh-100 border-end p-3 text-white" style="width: 200px; background-color: rgb(18, 18, 18);">
    <ul class="nav flex-column p-3">
      <li class="nav-item mb-1">
        <RouterLink to="/dashboard" class="nav-link">
          <i class="bi bi-house text-white m-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Inicio</span>
        </RouterLink>
      </li>
      <li class="nav-item mb-1">
        <RouterLink to="/damagePolicy" class="nav-link">
          <i class="bi bi-people-fill text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Poliza por daños</span>
          
        </RouterLink>
      </li>
    </ul>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router'
</script>

<style scoped>
.nav-link {
  font-weight: 500;
}
.nav-link.router-link-exact-active {
  color: #bebebe;
}
</style>


