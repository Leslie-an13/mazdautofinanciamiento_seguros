<template>
   <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            Aprobar aseguradoras
        </span>
  </div>

  <div class="row imgFondo">
    <ApproveInsuranceCompanyStatementsComponent  :getFilesInsurances="getFilesInsurances"
                              />
  </div>
</template>

<script>
import ApproveInsuranceCompanyStatementsComponent from '../components/insurances/ApproveInsuranceCompanyStatementsComponent.vue';
import Swal from 'sweetalert2';

export default {
  components: {
    ApproveInsuranceCompanyStatementsComponent
  },
  data() {
    return {
      getFilesInsurances: {
        exist: false,
        route: ''
      },
      getDataBase: {
        exist: false,
        route: ''
      }
    }
  },
  methods: {
    getInsurances(){
     
      fetch('/api/insurances/download_files_of_insurances.php', {
          method: 'GET',
      }).then(response => {
          //console.log("Respuesta cruda:", response);
          if (!response.ok) {
              throw new Error('Respuesta no OK del servidor: ' + response.status);
          }
          return response.json();
      }).then(data => {
        debugger

          if(data.success){
            this.getFilesInsurances.exist = true;
            this.getFilesInsurances.route = data.files
              
          } else {
            this.getFilesInsurances.exist = false;
            this.getFilesInsurances.route = '';
          }
      }).catch(error => {
          //console.error('Error atrapado en catch:', error);
          Swal.close();
      });

    },

    getBase(){
        fetch('/api/dataBaseAon/consultFileInBase.php', {
          method: 'GET',
        }).then(response => {
            //console.log("Respuesta cruda:", response);
            if (!response.ok) {
                throw new Error('Respuesta no OK del servidor: ' + response.status);
            }
            return response.json();
        }).then(data => {

            if(data.success){
              this.getDataBase.exist = true;
              this.getDataBase.route = data.history[0].base_path;
                
            } else {
              this.getDataBase.exist = false;
              this.getDataBase.route = '';
            }

        }).catch(error => {
            //console.error('Error atrapado en catch:', error);
            Swal.close();
        });
    }

  },
  mounted(){

    this.getInsurances();
    //this.getBase();

      
  }
}
</script>
