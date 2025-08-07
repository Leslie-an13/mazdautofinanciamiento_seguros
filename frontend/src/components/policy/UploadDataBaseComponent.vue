<template>

    <div class="col-lg-11 mx-auto">
        <div class="card shawdow rounded-15" style="background-color: rgb(255,255,255); margin-top: 100px; border: 3px solid rgb(48, 48, 48); height: 465px;">
            <div class="card-body">
                <div class="row">
                    <!--Upload file-->
                    <div class="col-lg-5 mx-auto border-2 border-seconday border-end">
                        <div class="text-center">
                            <span class="text-uppercase fw-boldest">Subir base AON</span>
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
                            <span class="text-uppercase fw-boldest">historial</span>
                        </div>
                        <i class="bi bi-circle me-2" style="color: red;"></i>
                        <span class="text-dark" v-text="uploadFile"></span>
                        <br>
                        <i class="bi bi-circle me-2" style="color:red;"></i>
                        <span class="text-dark" v-text="approvedFile"></span>
                    </div>
                    <!--Download file-->
                    <div class="col-lg-2 mx-auto">
                         <div class="text-center">
                            <span class="text-uppercase fw-boldest" style="font-size: 14px;">Descargar comprobante</span>
                        </div>
                        
                         <div class="d-flex justify-content-center mt-3">
                            <a class="download-btn pixel-corners" :href="downloadUrl">
                                <div class="button-content">
                                    <div class="svg-container">
                                    <svg
                                        class="download-icon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                        d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479 6.908l-4-4h3v-4h2v4h3l-4 4z"
                                        ></path>
                                    </svg>
                                    </div>
                                    <div class="text-container">
                                        <div class="text">Descargar</div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    
</template>

<script setup>

/*const propsDataBase =  defineProps({
    user: String
})*/

import { onBeforeMount, ref } from 'vue';
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

function downloadUrl(){
    debugger
}

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