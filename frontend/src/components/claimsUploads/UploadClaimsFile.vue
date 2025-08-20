<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 55px;">
        <div class="row">

            <!--Upload file-->
            <div class="col-lg-5 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <!--Stepper-->
                            <div class="col-lg-4 mx-auto col-sm-12">
                                <div class="stepper-box">
                                    <div class="stepper-step" :class="getClass('reviewFile')">
                                        <div class="stepper-circle d-none" id="successIcon">
                                            <svg
                                                viewBox="0 0 16 16"
                                                class="bi bi-check-lg"
                                                fill="currentColor"
                                                height="16"
                                                width="16"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"
                                                ></path>
                                            </svg>

                                        </div>
                                        <div class="stepper-circle" id="iconValue">1</div>
                                        <div class="stepper-line"></div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Base insolutos</div>
                                            <div class="stepper-status" v-text="statuStep"></div>
                                        </div>
                                    </div>

                                    <div class="stepper-step" :class="getClass('upload')">
                                        <div class="stepper-circle d-none" id="successUpload">
                                            <svg
                                                viewBox="0 0 16 16"
                                                class="bi bi-check-lg"
                                                fill="currentColor"
                                                height="16"
                                                width="16"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"
                                                ></path>
                                            </svg>

                                        </div>
                                        <div class="stepper-circle" id="iconBase">1</div>
                                        <div class="stepper-line"></div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Subir base</div>
                                            <div class="stepper-status" v-text="statuStepSecond"></div>
                                        </div>
                                    </div>

                                    <div class="stepper-step" :class="getClass('review')">
                                        <div class="stepper-circle">2</div>
                                        <div class="stepper-line"></div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Validando</div>
                                            <!--<div class="stepper-status" v-text="statuStepSecond"></div>-->
                                        </div>
                                    </div>

                                    <div class="stepper-step" :class="getClass('confirm')">
                                        <div class="stepper-circle">3</div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Comprobante</div>
                                            <!--<div class="stepper-status" v-text="statusThree"></div>-->
                                        </div>
                                    </div>

                                
                                </div>
                            </div>
                            <!--Upload file-->
                            <div class="col-lg-8 mx-auto col-sm-12">
                                <div class="text-center">
                                    <span class="text-uppercase" style="font-size: 14px; margin-left: 80px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">subir base</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="containerFile" style="margin-top: 30px; margin-left: 65px;">
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
                                                    @change="selectUpload" id="dataBaseClaims"/>
                                            Selecciona archivo...
                                           <p v-if="selectFileName" v-text="selectFileName" class="text-white fw-bolder"></p>
                                        </label>
                                    
                                    </div>
                                </div>

                                <!--Button-->
                                <div class="d-flex justify-content-end" style="margin-top: 90px;">
                                    <button class="btn btn-sm btn-success" @click="validateFile()">
                                        <i class="bi bi-floppy me-2 text-white"></i>
                                        <span class="text-uppercase text-white" style="font-size: 13px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                            guardar
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Download file-->
            <div class="col-lg-7 mx-auto">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-body">

                                <div class="text-center mb-4 mt-3">
                                    <span class="text-uppercase" style="font-size: 16px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Descargar base insolutos</span>
                                </div>

                                 <div class="d-flex justify-content-center">
                                    <img src="/img/monitor-moderno-en-mesa-elegante.jpg" style="width: 225px; height: 210px;">
                                </div>
                                
                                <!--Descargar base insolutos-->
                                <div class="d-flex justify-content-center mt-5 mb-3" v-if="routetofile.exist">
                                    <a class="buttonDown" :href="downloadUrl" style="color: inherit; text-decoration: none;">
                                        <span class="button__text text-white">Insolutos</span>
                                        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-body">
                                hols
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow">
                            <div class="card-body">
                                hols
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script setup>
import { computed, ref, onMounted } from 'vue';
import Swal from 'sweetalert2';

const statuStep = ref('');
const statuStepSecond = ref('');
const statusThree = ref('');
const statusFour = ref('');
const selectFileName = ref('')
const currentStep = ref('');

const stepsDone = ref({
  reviewFile: false,
  upload: false,
  review: false,
  confirm: false
});

const routetofile = ref({
    exist: false,
    route: '',
    
})

function selectUpload(event){
    let file =  event.target.files[0];
    if(file){
        selectFileName.value  =  file.name
    }
}

function validateFile(){

    let file = document.getElementById('dataBaseClaims').files[0];
    let valid = true;

    if(file == '' || file == undefined ){
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

    if(valid){
        questionSaveFile();
    }
}

function questionSaveFile(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se guardara el archivo",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            saveFileClaims();
        }
    });
}

function saveFileClaims(){

    let file = document.getElementById('dataBaseClaims').files[0];
    let formData = new FormData();
    formData.append('file', file);
    formData.append('func', 'saveDataBase');
 
    fetch('/api/databaseClaims/InsertClaimsData.php', {
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
        debugger
        if(data.success){
            Swal.fire({
              icon: "success",
              title: "Exito",
              text: data.message,
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

function getClass(step) {
  if (stepsDone.value[step]) return 'stepper-completed';
  if (currentStep.value === step) return 'stepper-active';
  return 'stepper-pending';
}

function checkFile(){

    let formData = new FormData();

    fetch('/api/databaseClaims/consult_outstanding_balances.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(data => {

        if(data.success){
        
            stepsDone.value.reviewFile = true;
            currentStep.value = 'upload';
            statuStep.value = 'Completado';
            statuStepSecond.value = 'Pendiente';
            document.getElementById('successIcon').classList.remove('d-none');
            document.getElementById('iconValue').classList.add('d-none');
            routetofile.value.route = data.history[0].base_path
            routetofile.value.exist = true;
          
        } else {

            currentStep.value = 'reviewFile';
            currentStep.value = 'Pendiente';
            document.getElementById('successIcon').classList.add('d-none');
            document.getElementById('iconValue').classList.remove('d-none');
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });
}

const downloadUrl = computed(() => {
  if (!routetofile.value || !routetofile.value.route) return '';
  const fileName = routetofile.value.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_outstanding_balances.php?file=${fileName}`;
});

onMounted(() => {
    checkFile();
});



</script>