<template>
    <!--title-->
    <div style="background-color: rgb(222, 222, 222); height: 25px;">
            <i class="bi bi-caret-right"></i>
            <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
                siniestros de vida y udi
            </span>
    </div>

    <div class="row imgFondo">
      <ClaimsDataUploadComponent :getFilesPayments="getFilesPayments"></ClaimsDataUploadComponent>
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
      getFilesPayments: {
        exist: false,
        route_1: '',
        route_2: '',
        route_3: ''
      }
    }
  },
  methods: {
    getRoutes(){

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
            this.getFilesPayments.exist = true;
            this.getFilesPayments.route_1 = data.history[0].base1_file_path  
            this.getFilesPayments.route_2 = data.history[0].base2_file_path  
            this.getFilesPayments.route_3 = data.history[0].base3_file_path  
          } else {
            this.getFilesPayments.exist = false;
            this.getFilesPayments.route_1 = '';
            this.getFilesPayments.route_2 = '';
            this.getFilesPayments.route_3 = '';
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

