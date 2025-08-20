<template>
      <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            subir base / visualizar siniestros
        </span>
  </div>

  <div class="row imgFondo">
    <UploadClaimsFile></UploadClaimsFile>
  </div>

</template>


<script>
import Swal from 'sweetalert2'
import UploadClaimsFile from '../components/claimsUploads/UploadClaimsFile.vue';

export default {
  components: { 
    UploadClaimsFile
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