<template>
   <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            subir base AON
        </span>
  </div>

  <div  class="row imgFondo">
    <UploadDataBaseComponent  :getRouteFile="getFilePayment"/>
  </div>
</template>

<script>
import UploadDataBaseComponent from '../components/policy/UploadDataBaseComponent.vue';
import Swal from 'sweetalert2';

export default {
  components: {
    UploadDataBaseComponent
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

  },
  mounted(){
      fetch('/api/getPolicy/download_policy_payment_receipt.php', {
        method: 'GET',
    })
    .then(response => {
        console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {

        if(data.success){
            
          this.getFilePayment.exist = true;
          this.getFilePayment.route = data.file
            
        } else {
          this.getFilePayment.exist = false;
          this.getFilePayment.route = '';
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });
      


    }
}
</script>
