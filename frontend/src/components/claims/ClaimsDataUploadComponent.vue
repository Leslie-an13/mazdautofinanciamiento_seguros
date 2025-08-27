<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px; ">

        <div class="row">
            <div class="col-lg-3 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <span class="text-uppercase" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                subir base insolutos
                            </span>
                        </div>

                        <!--Upload file-->
                        <div class="d-flex justify-content-center mt-3">
                            <div class="containerFile" style="margin-top: 30px;">
                                        <div class="folder">
                                        <div class="front-side">
                                        <div class="tip"></div>
                                        <div class="cover"></div>
                                        </div>
                                        <div class="back-side cover"></div>
                                    </div>
                                        <label class="custom-file-upload">
                                            <input class="title" type="file" 
                                                    accept=".xls, .xlsx, .csv"
                                                    @change="selectFileClaims" id="dataBaseClaims"/>
                                            Selecciona archivo...
                                           <p v-if="selectFile" v-text="selectFile" class="text-white fw-bolder"></p>
                                        </label>
                                    
                                    </div>
                        </div>

                        <!--Status-->
                        <div class="d-flex justify-content-center mt-5">
                            <select class="form-select form-select-sm w-75" 
                                    id="selectStatus"
                                    aria-label="Small select example ">
                                <option value="0">Selecciona una opcion</option>
                                <option value="1">Aprobar base de saldos</option>
                                <option value="2">Rechazar</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button class="btn btn-sm btn-success" type="button"
                                    @click="validateFile()">
                                    <i class="bi bi-floppy me-2 text-white"></i>
                                    <span class="text-white text-uppercase" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                                        guardar
                                    </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mx-auto">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-1 mb-2">
                            <span class="text-uppercase"
                            style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Descargar archivo</span>
                        </div>

                        <div class="d-flex justify-content-center">
                            <img src="/img/revisarbase.jpg" style="width: 210px; height: 190;">
                        </div>

                        <div class="d-flex justify-content-center mb-4" v-if="getFiles.exist">
                            <a class="buttonDown " :href="downloadFileBase" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                        </div>


                        <div class="d-flex justify-content-center">
                            <select class="form-select form-select-sm w-75" 
                                id="selectStatusBase"
                                aria-label="Small select example">
                                <option value="0">Selecciona una opcion</option>
                                <option value="1">Aprobar base</option>
                                <option value="2">Rechazar base</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-sm btn-success" type="button" @click="validateUploadBase">
                                <i class="bi bi-floppy me-2 text-white"></i>
                                <span class="text-uppercase text-white" style="font-size: 13px;">
                                    guardar
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mt-3">
                            <span class="text-uppercase" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">descargar archivos</span>
                        </div>
                        <div class="d-flex justify-content-center mt-3" v-if="files.exist">
                            <a class="buttonDown" :href="downloadFile1" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                         </div>
                         <div class="d-flex justify-content-center mt-5" v-if="files.exist">
                            <a class="buttonDown":href="downloadFile2"  style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                         </div>

                         <div class="d-flex justify-content-center mt-5" v-if="files.exist">
                            <a class="buttonDown" :href="downloadFile3"  style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                         </div>

                         <div class="d-flex justify-content-center mt-4">
                            <select class="form-select form-select-sm w-75" 
                                id="selectFiles"    
                                aria-label="Small select example">
                                <option value="0">Selecciona un estatus</option>
                                <option value="1">Aprobar archivos</option>
                                <option value="2">Rechazar archivos</option>
                            </select>
                         </div>

                         <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-sm btn-success" type="button" @click="validateFiles()">
                                <span class="text-uppercase text-white">guardar</span>
                            </button>
                         </div>

                    </div>
                </div>
            </div>
        </div>



       
    </div>

</template>

<script setup>
import { ref, onBeforeMount, computed} from 'vue';
import Swal from 'sweetalert2'

const getFiles= ref({
  file: "",       
  exist: false  
});

const files= ref({
  file1: "",  
  file2: "",
  file3: "",    
  exist: false  
});

const selectFile = ref('')

//Function for detected text in input
function selectFileClaims(event){
    let file =  event.target.files[0];

    if(file){
        selectFile.value  =  file.name
    }
}

function validateFile(){

    let file = document.getElementById('dataBaseClaims').files[0];
    let status = document.getElementById('selectStatus').value;
    let valid = true;

    if(status == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes seleccionar un estatus',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(file == '' || file == undefined){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes subir el archivo',
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
        text: "Se aprobara la base",
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
    let status = document.getElementById('selectStatus');
    let textSelect = status.options[status.selectedIndex].text;

     Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    let formData = new FormData();
    formData.append('file', file);
    formData.append('func', 'claims_database');
    formData.append('status', textSelect);

    fetch('/api/databaseClaims/insertClaimsDatabase.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        //console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(data => {
        debugger
        if(data.success){
         
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
    }).catch(error => {
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });
}

function validateUploadBase(){
    let select = document.getElementById('selectStatusBase').value;
    let valid = true;

    if(select == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes seleccionar un estatus',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valid){
        questionSaveUploadFile();
    }
}

function questionSaveUploadFile(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se aprobara la base",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            saveInfoUpload();
        }
    });
}

function saveInfoUpload(){
    let status = document.getElementById('selectStatusBase');
    let textSelect = status.options[status.selectedIndex].text;

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    let formData = new FormData();
    formData.append('select', textSelect);
    formData.append('func', 'updateInfoBase');



    fetch('/api/claimsPayments/updatePaymentRecord.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        //console.log("Respuesta cruda:", response);
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
              html: data.message,
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#58A35D",
              showConfirmButton: true
            }).then(() => {
              window.location.reload(); 
            });
            
        } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              html: data.message,
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#58A35D",
              showConfirmButton: true
            }).then(() => {
              window.location.reload(); 
            });
        }
    })
    .catch(error => {
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });
}

function validateFiles(){
    let files = document.getElementById('selectFiles').values;
    let valid = true;

    if(files == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes seleccionar un estatus',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valid){
        questionSaveStatusToFiles();
    }

}

function questionSaveStatusToFiles(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se aprobaran los archivos",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            saveStatuToFiles();
        }
    });
}

function saveStatuToFiles(){

    let archivos = document.getElementById('selectFiles')
    let textStatus = archivos.options[archivos.selectedIndex].text;

    let formData = new FormData();
    formData.append('statusFiles', textStatus)
    formData.append('func', 'updateInfoBase');

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    fetch('/api/claimsPayments/updatePayments.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        //console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(data => {
        if(data.success){
         
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
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

const downloadFileBase = computed(() => {
 
  if (!getFiles.value || !getFiles.value.file) return '';
  const fileName = getFiles.value.file.split('/').pop();

  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_outstanding_balances.php?file=${fileName}`;
});

const downloadFile1 = computed(() => {
 
  if (!files.value || !files.value.file1) return '';
  const fileName = files.value.file1.split('/').pop();

  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_files_claims.php?file=${fileName}`;
});

const downloadFile2 = computed(() => {
 
  if (!files.value || !files.value.file2) return '';
  const fileName = files.value.file2.split('/').pop();

  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_files_claims.php?file=${fileName}`;
});

const downloadFile3 = computed(() => {
 
  if (!files.value || !files.value.file3) return '';
  const fileName = files.value.file3.split('/').pop();

  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_files_claims.php?file=${fileName}`;
});

function consultFile(){
    let formData = new FormData();
    formData.append('func', 'consultFileIfExist');
    fetch('/api/databaseClaims/consultFileInBaseClaims.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        //console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if(data.success){
            getFiles.value.exist = true;
            getFiles.value.file = data.history.claims_path;
        }
    })
    .catch(error => {
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });
}

function consultTheFiles(){

    fetch('/api/claimsPayments/recordOfInsurancePayments.php', {
        method: 'POST',
    })
    .then(response => {
        //console.log("Respuesta cruda:", response);
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if(data.success){
            debugger
            files.value.exist = true;
            files.value.file1 = data.history[0].base1_file_path;
            files.value.file2 = data.history[0].base2_file_path;
            files.value.file3 = data.history[0].base3_file_path;

            debugger
        }
    })
    .catch(error => {
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });
}

onBeforeMount(()=>{
    consultFile();
    consultTheFiles()

})

</script>