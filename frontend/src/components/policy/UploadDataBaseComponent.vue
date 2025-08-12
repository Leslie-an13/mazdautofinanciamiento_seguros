<template>

    <div class="col-lg-11 mx-auto">
        <div class="card shawdow rounded-15" style="background-color: rgb(255,255,255); margin-top: 60px;">
            <div class="card-body">
                <div class="row">
                    <!--Upload file-->
                    <div class="col-lg-5 mx-auto border-2 border-seconday border-end">
                        <div class="text-center"> 
                            <span class="text-uppercase fw-boldest" style="font-family:'Times New Roman', Times, serif; ">Subir base AON</span>
                        </div>
                        <div class="containerFile mx-auto" style="margin-top: 10px;">
                            <div class="folder">
                            <div class="front-side">
                            <div class="tip"></div>
                            <div class="cover"></div>
                            </div>
                            <div class="back-side cover"></div>
                        </div>
                            <label class="custom-file-upload">
                                <input class="title" type="file" 
                                        accept=".xls, .xlsx"
                                        @change="selectUpload" id="dataBaseAon"/>
                                Selecciona archivo...
                                  <p v-if="selectFileName" v-text="selectFileName" class="text-white fw-bolder"></p>
                            </label>
                          
                        </div>

                        <!--Select status-->
                        <div class="text-center mt-5">
                            <span class="text-dark text-uppercase">aprobar archivo</span>
                        </div>

                        <div class="d-flex justify-content-center mt-2">
                            <select class="form-select form-select-sm w-75 mb-3" aria-label="Large select example" id="selectAp">
                                <option value="0">Selecciona...</option>
                                <option value="1">Aprobar</option>
                                <option value="1">Rechazar</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-5 mb-2">
                            <button class="btn btn-sm btn-success" @click="validations">
                                <span class="text-uppercase text-white fs-7 fw-bolder">Guardar</span>
                            </button>
                        </div>

                    </div>

                    <!--History file-->
                    <div class="col-lg-5 mx-auto">
                         <div class="text-center mb-3">
                            <span class="text-uppercase fw-boldest" style="font-family:'Times New Roman', Times, serif; ">historial</span>
                        </div>
                        <i class="bi bi-circle me-2" style="color: red;"></i>
                        <span class="text-dark" v-text="uploadFile"></span>
                        <br>
                        <i class="bi bi-circle me-2" style="color:red;"></i>
                        <span class="text-dark" v-text="approvedFile"></span>
                    </div>
                    <!--Download file-->
                    <div class="col-lg-2 mx-auto" v-if="getRouteFile.exist">
                         <div class="text-center">
                            <span class="text-uppercase fw-boldest" style="font-size: 14px;">Descargar comprobante</span>
                        </div>
                        
                         <div class="d-flex justify-content-center mt-3" >
                            <a class="buttonDown" :href="downloadFile" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                          
                        </div>

                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    
</template>

<script setup>

const props = defineProps({
  getRouteFile: {
    type: Object,
    required: true
  }

});

import { onBeforeMount, ref, computed} from 'vue';
import Swal from 'sweetalert2'

const selectFileName = ref('')

const uploadFile = ref('');
const approvedFile = ref('');

function selectUpload(event){
    let file =  event.target.files[0];

    if(file){
        selectFileName.value  =  file.name
    }

}

function validations(){
    let file = document.getElementById('dataBaseAon').files[0];
    let select1 = document.getElementById('selectAp').value;
    let select = document.getElementById('selectAp');
    let textSelect = select.options[select.selectedIndex].text;
    let valid = true;
    if(file == '' || file == undefined){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes seleccionar un archivo',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }  

    if(select1 == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes seleccionar estatus',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    questionSave(textSelect, file);

}

function questionSave(textSelect, file){

    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se aprobara el archivo",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                saveInfoBd(textSelect, file);

            }
        });
}

function saveInfoBd(textSelect, file){
   
     Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    
    let formData = new FormData;
    formData.append('files',file);
    formData.append('textPolicy', textSelect);

    fetch('/api/getPolicy/insertBdAon.php', {
        method: 'POST',
        body: formData
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
            debugger
            
            Swal.fire({
              icon: "success",
              title: "Datos insertados correctamente",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#58A35D",
              showConfirmButton: true
            }).then(() => {
              location.reload(); 
            });
            
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

const downloadFile = computed(() => {
  if (!props.getRouteFile || !props.getRouteFile.route) return '';
  const fileName = props.getRouteFile.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/dowloand_file_payment.php?file=${fileName}`;
});

onBeforeMount(async() =>{
    const response = await fetch('/api/getPolicy/historyPolicy.php', {
        method: 'GET'
    }).then(response =>{
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(response =>{

        if(response.success){
            uploadFile.value = response.history[0].file_upload_date;
            approvedFile.value = response.history[0].user_file_date
        
        }
    })


})



</script>