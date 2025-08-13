<template>
  <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            subir comprobante de pago poliza
        </span>
  </div>

  <!--Content-->
  <div  class="row imgFondo">
    <PaymentPolicyComponent :routetofile="getFile" />
  </div>
</template>

<script>
import Swal from 'sweetalert2'
import PaymentPolicyComponent from '../components/policy/PaymentPolicyComponent.vue'

export default {
  components: { 
    PaymentPolicyComponent
  },
  data() {
    return {
       getFile: {
        existe: false,
        route: ''
      }
    }
  },
  methods: {
    validateRoute() {
     
    }
  },
  mounted(){
    fetch('/api/paymentReceipt/proof_of_payment.php', {
        method: 'GET',
    })
    .then(response => {

        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if(data.success){  
          this.getFile.existe = true;
          this.getFile.route = data.file
            
        } else {
          this.getFile.existe = false;
          this.getFile.route = '';
        }
    })
    .catch(error => {
        //console.error('Error atrapado en catch:', error);
        Swal.close();
    });


  }
}
</script>
