<template class="imgFondo">
     <!--title-->
    <div style="background-color: rgb(222, 222, 222); height: 25px;">
            <i class="bi bi-caret-right"></i>
            <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
                Pagos de siniestros y udi
            </span>
    </div>


    
    <div class="row ">
        <ClaimsPaymentComponent :getFilePayment="getFilePayment"></ClaimsPaymentComponent>
    </div>

</template>


<script>
import Swal from 'sweetalert2';
import ClaimsPaymentComponent from '../components/claims/ClaimsPaymentComponent.vue';


export default {
  components: {
    ClaimsPaymentComponent
  },
  data() {
    return {
      getFilePayment: {
        exist: false,
        route: ''
      }
    }
  },
  methods: {
    getRoute(){
      debugger
      fetch('/api/databaseClaims/consultFileInBaseClaims.php', {
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

    this.getRoute();



  }
}

</script>