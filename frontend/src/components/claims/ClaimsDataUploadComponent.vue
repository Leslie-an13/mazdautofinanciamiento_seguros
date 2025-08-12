<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px; ">
        <div class="card shadow rounded-15" style="height: 430px;">
            <div class="card-body">
                <div class="row">

                    <!--Upload file-->
                    <div class="col-lg-6 border-2 border-secondary border-end">
                         <div class="text-center mb-3">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                Subir archivo
                            </span>
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
                                    <input class="title" type="file" @change="selectFileClaims" 
                                        accept=".xlsx, .xls, .csv"
                                        id="claimsFile"/>
                                    Selecciona archivo...
                                    <p v-if="selectedFileName" v-text="selectedFileName" class="text-white fw-bolder" style="font-size: 8px;"></p>
                                </label>
                            
                        </div>

                        <!--Select Status-->
                        <div class="text-center mt-5">
                            <span class="text-uppercase">aprobar archivo</span>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <select class="form-select form-select-sm w-50" 
                                    id="selectStatus"
                                    aria-label="Small select example">
                                <option value="0">Selecciona un estatus</option>
                                <option value="1">Aprobar</option>
                                <option value="2">Rechazar</option>
                               
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-sm btn-success" @click="validateFiles">
                                <i class="bi bi-floppy me-2 text-white"></i>
                                <span class="text-uppercase text-white" style="font-size: 15px;">
                                    guardar
                                </span>
                            </button>
                        </div>
                    </div>

                    <!--Historial-->
                    <div class="col-lg-6">
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

const selectedFileName = ref('')
const uploadFile = ref('');
const approvedFile = ref('');

//Function for detected text in input
function selectFileClaims(event){
    let file =  event.target.files[0];

    if(file){
        selectedFileName.value  =  file.name
    }

}

//Validate inputs
function validateFiles(){

    let file = document.getElementById('claimsFile').files[0];
    let status = document.getElementById('selectStatus').value;
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

    if(status == "0"){
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


    if(valid){
        questionSaveClaims()
    }

}
//Question 
function questionSaveClaims(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se procesara la informacion",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                saveInformationTheClaims();

            }
    });
}
//Save information
function saveInformationTheClaims(){
    let file = document.getElementById('claimsFile').files[0];
    let status = document.getElementById('selectStatus');
    let textSelect = status.options[status.selectedIndex].text;

    let formData = new FormData;
    formData.append('file', file);
    formData.append('status', textSelect);
    formData.append('func', 'upload_claims_database')

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 


    fetch('api/databaseClaims/insertClaimsDatabase.php', {
        method: 'POST',
        body: formData
    }).then(response => {
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

//Get history
onBeforeMount(async() =>{

    const response = await fetch('/api/databaseClaims/getClaimsData.php', {
        method: 'GET'
    }).then(response =>{
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(response =>{

        if(response.success){
            uploadFile.value = response.history[0].file_upload_date;
            approvedFile.value = response.history[0].user_file_claims_date
        
        }
    })


})

</script>