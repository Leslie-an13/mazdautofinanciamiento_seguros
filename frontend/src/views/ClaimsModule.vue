<template>
    <!--title-->
    <div style="background-color: rgb(222, 222, 222); height: 25px;">
            <i class="bi bi-caret-right"></i>
            <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
                siniestros de vida y udi
            </span>
    </div>

    <div class="row imgFondo">
      <ClaimsDataUploadComponent ></ClaimsDataUploadComponent>
    </div>

</template>

<script>

import Swal from 'sweetalert2';
import ClaimsDataUploadComponent from '../components/claims/ClaimsDataUploadComponent.vue';

export default {
  components: {
    ClaimsDataUploadComponent
  },
  data() {
    return {
      getFilePayment: {
        exist: false,
        route_1: '',
        route_2: '',
        route_3: ''
      }
    }
  },
  methods: {
    getRoutes(){

      //Me falta info
      fetch('/api/claimsPayments/recordOfInsurancePayments.php', {
          method: 'GET',
      }).then(response => {
          //console.log("Respuesta cruda:", response);
          if (!response.ok) {
              throw new Error('Respuesta no OK del servidor: ' + response.status);
          }
          return response.json();
      }).then(data => {
          if(data.success){
            this.getFilePayment.exist = true;
            this.getFilePayment.route = data.history[0].base_file_path_claims  
          } else {
            this.getFilePayment.exist = false;
            this.getFilePayment.route = '';
          }
      }).catch(error => {
          //console.error('Error atrapado en catch:', error);
          Swal.close();
      });
    }

  },
  mounted(){
      this.getRoutes();

  }
}
</script>

