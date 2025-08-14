<template>
  <div class="vh-100 border-end text-white" style="width: 200px; background-color: rgb(85,0,8);">
    <ul class="nav flex-column">
      <li class="nav-item mb-1 ">
        <RouterLink to="/dashboard" class="nav-link">
          <i class="bi bi-house text-white m-2 "></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Inicio</span>
        </RouterLink>
      </li>

      <li class="nav-item mb-1  ">
        <RouterLink to="/uploadAndViewPolicies" class="nav-link">
          <i class="bi bi-database-add text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Subir base</span>
          
        </RouterLink>
      </li>

      <li class="nav-item mb-1  ">
        <RouterLink to="/damagePolicy" class="nav-link">
          <i class="bi bi-file-earmark-spreadsheet text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Poliza por daños</span>
          
        </RouterLink>
      </li>
      <li class="nav-item mb-1 ">
        <RouterLink to="/policyDocument" class="nav-link">
          <i class="bi bi-file-earmark-pdf text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Pago comprobante polizas</span>
          
        </RouterLink>
      </li>
      <li class="nav-item mb-1 ">
        <RouterLink to="/claimsModule" class="nav-link">
          <i class="bi bi-car-front me-2 text-white"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">
            Siniestros
          </span>
          
        </RouterLink>
      </li>
      <li class="nav-item mb-1 ">
        <RouterLink to="/claimsPayment" class="nav-link">
          <i class="bi bi-bank text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">
           Pagos de siniestros
          </span>
          
        </RouterLink>
      </li>
      <li class="nav-item mb-1 ">
        <RouterLink to="/users" class="nav-link">
          <i class="bi bi-people text-white me-2"></i>
          <span style="font-family: 'Times New Roman', Times, serif; color: rgb(255, 255, 255);">Usuarios</span>
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


