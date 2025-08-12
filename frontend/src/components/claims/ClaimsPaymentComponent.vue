<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px;">
        <div class="card shadow rounded-15">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-8 border-2 border-end border-light-subtle">
                        <div class="text-center mb-3">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                Subir archivos
                            </span>
                        </div>

                        <div class="row">
                            <!--Archivo 1-->
                            <div class="col-lg-5 mx-auto">
                                
                                <div class="d-flex justify-content-center">
                                    <div class="containerFile mx-auto d-block" style="margin-top: 10px;">
                                        <div class="folder">
                                        <div class="front-side">
                                        <div class="tip"></div>
                                        <div class="cover"></div>
                                        </div>
                                        <div class="back-side cover"></div>
                                    </div>
                                        <label class="custom-file-upload" style="margin-top: 90px;">
                                            <input class="title" type="file" @change="insurer1" 
                                                accept=".pdf"
                                                id="insurer_id1"/>
                                            Selecciona archivo...
                                            <p v-if="selectedFileName1" v-text="selectedFileName1" class="text-white fw-bolder" style="font-size: 8px;"></p>
                                        </label>
                                    
                                    </div>
                                </div>
                                <div class="text-center">
                                    <span class="text-uppercase fw-bolder" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                                                font-size: 12px;">Aseguradora 1</span>
                                </div>
                                
                            </div>
                            <!--Archivo 2-->
                            <div class="col-lg-5 mx-auto">
                             
                                <div class="d-flex justify-content-center">
                                    <div class="containerFilesecond mx-auto" style="margin-top: 10px;">
                                        <div class="folder">
                                        <div class="front-side">
                                        <div class="tip"></div>
                                        <div class="cover"></div>
                                        </div>
                                        <div class="back-side cover"></div>
                                    </div>
                                        <label class="custom-file-upload">
                                            <input class="title" type="file"  @change="insurer2"
                                                accept=".pdf"
                                                id="insurer_id2"/>
                                            Selecciona archivo...
                                         <p v-if="selectedFileName2" v-text="selectedFileName2" class="text-white fw-bolder" style="font-size: 8px;"></p>
                                        </label>
                                    
                                    </div>
                                </div>
                                <!--Texto-->
                                <div class="text-center">
                                    <span class="text-uppercase fw-bolder" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                                                font-size: 12px;">Aseguradora 2</span>
                                </div>
                            </div>
                            <!--Archivo 3-->
                            <div class="col-lg-5 mx-auto mt-3">
                               
                                <div class="d-flex justify-content-center">
                                    <div class="containerFileThree mx-auto" style="margin-top: 10px;">
                                        <div class="folder">
                                        <div class="front-side">
                                        <div class="tip"></div>
                                        <div class="cover"></div>
                                        </div>
                                        <div class="back-side cover"></div>
                                    </div>
                                        <label class="custom-file-upload">
                                            <input class="title" type="file"  @change="insurer3"
                                                accept=".pdf"
                                                id="insurer_id3"/>
                                            Selecciona archivo...
                                        <p v-if="selectedFileName3" v-text="selectedFileName3" class="text-white fw-bolder" style="font-size: 8px;"></p>
                                        </label>
                                    
                                    </div>
                                </div>
                                <!--Texto-->
                                <div class="text-center">
                                    <span class="text-uppercase fw-bolder" style="font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; 
                                            font-size: 12px;">Aseguradora 3</span>
                                </div>
                            </div>

                            <!--Select && Files-->
                            <div class="d-flex justify-content-between">
                                <!--Button download-->
                                <div style="margin-top: 50px;" v-if="getFilePayment.exist">
                                    <span class="text-uppercase fw-bold" style="font-size: 12px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
                                        descargar factura aon
                                    </span>
                                    <a class="buttonDown "  :href="downloadFile" style="color: inherit; text-decoration: none;">
                                        <span class="button__text text-white">Download</span>
                                        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                                    </a>
                                </div>
                                
                                <!--Select-->
                                <select class="form-select form-select-sm w-50 " style="height: 35px; margin-top: 75px;" 
                                        id="selectStatus"
                                        aria-label="Small select example">
                                    <option selected>Selecciona una opcion...</option>
                                    <option value="1">Aprobar</option>
                                    <option value="2">Rechazar</option>
                                </select>
                            </div>
                           
                            <!--Button save-->
                            <div class="d-flex justify-content-end mt-5">
                                <button type="button" class="btn btn-sm btn-success" @click="validateFiles()">
                                    <i class="bi bi-floppy text-white me-2"></i>
                                    <span class="text-uppercase text-white" style="font-size: 12px;">
                                        guardar
                                    </span>
                                </button>
                            </div>


                        </div>
                    </div>

                    <!--Historial-->
                    <div class="col-lg-4">
                        <div class="text-center mb-2">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                historial
                            </span>
                        </div>

                        <i class="bi bi-circle me-2" style="color: red;"></i>
                        <span class="text-dark" v-text="uploadFile"></span>
                        <br>
                        <i class="bi bi-circle me-2" style="color:red;"></i>
                        <span class="text-dark" v-text="approvedFile"></span>
                    
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { computed, ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2'

const props = defineProps({
  getFilePayment: {
    type: Object,
    required: true
  }

});

const selectedFileName1 = ref('');
const selectedFileName2 = ref('');
const selectedFileName3 = ref('');
const uploadFile = ref('');
const approvedFile = ref('');

function insurer1(event){
    let file =  event.target.files[0];

    if(file){
        selectedFileName1.value  =  file.name
    }

}

function insurer2(event){
    let file =  event.target.files[0];

    if(file){
        selectedFileName2.value  =  file.name
    }
}

function insurer3(event){
    let file =  event.target.files[0];

    if(file){
        selectedFileName3.value  =  file.name
    }

}

function validateFiles(){

    let file1 = document.getElementById('insurer_id1').value;
    let file2 = document.getElementById('insurer_id2').value;
    let file3 = document.getElementById('insurer_id3').value;
    let select = document.getElementById('selectStatus').value;
    let valid = true;

    if(select == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes seleccionar un estatus',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(file1 == '' || file1 == undefined){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes seleccionar un archivo',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(file2 == '' || file2 == undefined){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes seleccionar un archivo',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(file3 == '' || file3 == undefined){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes seleccionar un archivo',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valid){
        questionSaveFiles();
    }

}

function questionSaveFiles(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Guardara la informacion",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                saveFilesClaims();

            }
        });
}

function saveFilesClaims(){

    let file1 = document.getElementById('insurer_id1').files[0];
    let file2 = document.getElementById('insurer_id2').files[0];
    let file3 = document.getElementById('insurer_id3').files[0];
    let select = document.getElementById('selectStatus');
    let textSelect = select.options[select.selectedIndex].text;


    let formData = new FormData();
    formData.append('func', 'insertClaimsFiles')
    formData.append('file1', file1);
    formData.append('file2', file2);
    formData.append('file3', file3);
    formData.append('status', textSelect);
  
    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    fetch('api/claimsPayments/insertTheFileClaims.php', {
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
            
            Swal.fire({
              icon: "success",
              title: "Datos insertados correctamente",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#58A35D",
              showConfirmButton: true
            }).then(() => {
              window.location.reload(); 
            });
            
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

onBeforeMount(async() =>{

    const response = await fetch('/api/claimsPayments/recordOfInsurancePayments.php', {
        method: 'GET'
    }).then(response =>{
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(response =>{
      
        if(response.success){
            uploadFile.value = response.history[0].file_upload_date;
            approvedFile.value = response.history[0].user_file_date;
        
        }
    })

})

const downloadFile = computed(() => {
 
  if (!props.getFilePayment || !props.getFilePayment.route) return '';
  const fileName = props.getFilePayment.route.split('/').pop();

  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_the_insurance_company_files.php?file=${fileName}`;
});

</script>