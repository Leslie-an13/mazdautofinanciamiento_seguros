<template>
     <!--title-->
    <div style="background-color: rgb(222, 222, 222); height: 25px;">
            <i class="bi bi-caret-right"></i>
            <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
                Pagos de siniestros y udi
            </span>
    </div>

    <div class="row imgFondo">
        <ClaimsPaymentComponent></ClaimsPaymentComponent>
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
      
    }
  },
  methods: {

  },
  mounted(){
  


  }
}

</script>