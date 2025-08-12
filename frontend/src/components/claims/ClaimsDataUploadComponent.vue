<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px; ">
        <div class="card shadow rounded-15" style="height: 430px;">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-2 mx-auto col-sm-12 mx-auto" v-if="getFilesPayments.exist">
                        <div class="text-center mb-3" style="font-size: 13px;">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                Descargar archivos
                            </span>
                        </div>


                        <!--Boton aseguradora-->
                        <div class="d-flex justify-content-center">
                            <button class="buttonDown" @click="downloadFile(getFilesPayments.route_1)" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </button>
                        </div>

                        <!--Boton aseguradora 2-->
                        <div class="d-flex justify-content-center mt-5">
                            <button class="buttonDown"  @click="downloadFile(getFilesPayments.route_2)"  style="color: inherit; text-decoration: none;">
                                    <span class="button__text text-white">Download</span>
                                    <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </button>
                        </div>

                        <!--Boton aseguradora 3-->
                        <div class="d-flex justify-content-center mt-5">
                            <button class="buttonDown" @click="downloadFile(getFilesPayments.route_3)" style="color: inherit; text-decoration: none;">
                                    <span class="button__text text-white">Download</span>
                                    <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </button>
                        </div>

                    </div>

                    <!--Upload file-->
                    <div class="col-lg-5 mx-auto col-sm-12 border-2 border-light-subtle border-end">
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
                    <div class="col-lg-5 mx-auto col-sm-12">
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
import { ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2'

const props = defineProps({
  getFilesPayments: {
    type: Object,
    required: true
  }
});

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

//Get files
function downloadFile(filePath) {

    if (!filePath) return;
    const fileName = filePath.split('/').pop();  //Obtenemos solo el nombre del archivo ¿
    const link = document.createElement('a'); //Creamos un enlace invisible 
    link.href = `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_files_claims.php?file=${encodeURIComponent(fileName)}`;
    link.download = fileName;
    document.body.appendChild(link); //Se crea esto para que no recargue la pagina, solo descargue archivo
    link.click();
    document.body.removeChild(link);
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