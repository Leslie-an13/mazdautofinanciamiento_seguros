<template>
  <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            subir base / visualizar factura
        </span>
  </div>


  <div class="row imgFondo">
    <UploadDocument></UploadDocument>
  </div>


</template>

<script>
import Swal from 'sweetalert2'
import UploadDocument from '../components/policyInvoices/UploadDocument.vue';

export default {
  components: { 
    UploadDocument
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