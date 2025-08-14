<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 55px;">
        <div class="row">
            <div class="col-lg-6 mx-auto col-sm-12">
                <div class="card shadow rounded" style="height: 420px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 mx-auto">

                                <div class="stepper-box">
                                    <div class="stepper-step" :class="getClass('upload')">
                                        <div class="stepper-circle d-none">
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
                                        <div class="stepper-circle">1</div>
                                        <div class="stepper-line"></div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Subir base</div>
                                            <div class="stepper-status" v-text="statuStep"></div>
                                        </div>
                                    </div>

                                    <div class="stepper-step" :class="getClass('review')">
                                        <div class="stepper-circle">2</div>
                                        <div class="stepper-line"></div>
                                        <div class="stepper-content">
                                            <div class="stepper-title">Validando</div>
                                            <div class="stepper-status" v-text="statuStepSecond"></div>
                                        </div>
                                    </div>

                                    <div class="stepper-step" :class="getClass('confirm')">
                                        <div class="stepper-circle">3</div>
                                        <div class="stepper-content">
                                        <div class="stepper-title">Shipping</div>
                                        <div class="stepper-status">Pending</div>
                                        <div class="stepper-time">Estimated: May 30</div>
                                        </div>
                                    </div>

                                
                                </div>

                            </div>

                            <div class="col-lg-8 col-sm-12 mx-auto">
                                <div class="text-center">
                                    <span>subir base</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <div class="containerFile mx-auto" style="margin-top: 30px;">
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
                                </div>

                                <!--Button-->
                                <div class="d-flex justify-content-end" style="margin-top: 90px;">
                                    <button class="btn btn-sm btn-success" @click="validateFile()">
                                        <i class="bi bi-floppy me-2 text-white"></i>
                                        <span class="text-uppercase fw-boldest text-white" style="font-size: 13px;">
                                            guardar
                                        </span>
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mx-auto col-sm-12">
                <div class="card shadow rounded">
                    <div class="card-body">
                        holis
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
const selectFileName = ref('')
const currentStep = ref('');
const stepsDone = ref({
  upload: false,
  review: false,
  confirm: false
});

function selectUpload(event){
    let file =  event.target.files[0];
    if(file){
        selectFileName.value  =  file.name
    }
}

function validateFile(){
    let file = document.getElementById('dataBaseAon').files[0];
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
            saveFileAon();
        }
    });
}

function saveFileAon(){

    let file = document.getElementById('dataBaseAon').files[0];
    let formData = new FormData();
    formData.append('file', file);
    formData.append('func', 'saveDataBase');
    debugger

    fetch('/api/dataBaseAon/insertDataFile.php', {
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

  if (currentStep.value === step) return 'stepper-active';
  if (stepsDone.value[step]) return 'stepper-completed';
  return 'stepper-pending';
}

function checkIfFileExists(){
    
    let formData = new FormData();
    formData.append('func', 'consultTable');

    fetch('/api/dataBaseAon/consultTableBase.php', {
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
            stepsDone.value.upload = true;
            currentStep.value = 'review';
            statuStep.value = 'Completado';
            checkApproved();
        } else {
            currentStep.value = 'upload';
            statuStep.value = 'Pendiente';
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });
 
}

function checkApproved(){

    let formData = new FormData();
    formData.append('func', 'consultStatusBase');

    fetch('api/getPolicy/damage_policy_history.php', {
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
            stepsDone.value.review = true;
            currentStep.value = 'confirm';
            statuStepSecond.value = 'Completado';
            checkPayment();
        } else {
            currentStep.value = 'review';
            statuStep.value = 'Pendiente';
        }
    })
    .catch(error => {
        console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

function  checkPayment(){
     currentStep.value = 'confirm';
}
onMounted(() => {
    checkIfFileExists();
});


</script>