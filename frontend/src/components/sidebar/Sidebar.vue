<template>
  <div class="bg-dark vh-100 border-end">
    <ul class="nav flex-column p-3">
      <li class="nav-item mb-2 ">
        <RouterLink to="/dashboard" class="nav-link">🏠 Dashboard</RouterLink>
      </li>
      <li class="nav-item mb-2">
        <RouterLink to="/usuarios" class="nav-link">👥 Usuarios</RouterLink>
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


