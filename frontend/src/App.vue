<template>
   <!-- Bloque de carga -->
    <div  v-if="loading" id="preloader">
      <div class="loader"></div>
    </div>

    <div v-else>
      <router-view />
    </div>
  
</template>

<script setup>
import { loading } from './loadingStore'
//Se importa para que se pueda mostrar

</script>

