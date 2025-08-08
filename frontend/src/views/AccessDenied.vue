<template>

    <!--Imagen de acceso denegado-->
    <div class="denied">
        <img src="/img/access_denied.png">
        <h1>403 - Acceso denegado</h1>
        <p>No tienes permisos para acceder.</p>

        <button type="button" class="btn btnClass" @click="goToDashboard"> 
            <span class="text-uppercase text-white me-2" style="font-family:'Times New Roman', Times, serif">Regresar a inicio </span>
            <i class="bi bi-house text-white"></i>
        </button>

        
    </div>

</template>

<script>
import { useRouter } from 'vue-router';

export default {
  components: {
   
  },
  data() {
    return {
      
    }
  },
  methods: {
    goToDashboard() {
        this.$router.push('/dashboard');
    }
  },
  mounted(){
  


    }
}


</script>