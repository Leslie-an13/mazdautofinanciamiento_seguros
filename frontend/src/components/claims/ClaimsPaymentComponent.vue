<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px;">
        <div class="card shadow rounded-15">
            <div class="card-body">
                <div class="row">

                    <div class="col-lg-9  border-2 border-end border-light-subtle">
                        <div class="text-center mb-3">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                Subir archivos
                            </span>
                        </div>

                        <div class="row">
                            <!--Archivo 1-->
                            <div class="col-lg-4">
                                
                                <div class="d-flex justify-content-center">
                                    <div class="containerFile mx-auto" style="margin-top: 10px;">
                                        <div class="folder">
                                        <div class="front-side">
                                        <div class="tip"></div>
                                        <div class="cover"></div>
                                        </div>
                                        <div class="back-side cover"></div>
                                    </div>
                                        <label class="custom-file-upload">
                                            <input class="title" type="file" @change="insurer1" 
                                                accept=".pdf"
                                                id="insurer_id1"/>
                                            Selecciona archivo...
                                            <p v-if="selectedFileName1" v-text="selectedFileName1" class="text-white fw-bolder" style="font-size: 8px;"></p>
                                        </label>
                                    
                                    </div>
                                </div>
                            </div>
                            <!--Archivo 2-->
                            <div class="col-lg-4">
                             
                                <div class="d-flex justify-content-center">
                                    <div class="containerFile mx-auto" style="margin-top: 10px;">
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
                            </div>
                            <!--Archivo 3-->
                            <div class="col-lg-4">
                               
                                <div class="d-flex justify-content-center">
                                    <div class="containerFile mx-auto" style="margin-top: 10px;">
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
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                 <select class="form-select form-select-sm w-50 mt-5" 
                                        id="selectStatus"
                                        aria-label="Small select example">
                                    <option selected>Selecciona una opcion...</option>
                                    <option value="1">Aprobar</option>
                                    <option value="2">Rechazar</option>
                                </select>
                            </div>
                           

                            <div class="d-flex justify-content-end mt-5">
                                <button type="button" class="btn btn-sm btn-success" @click="validateFiles()">
                                    <span class="text-uppercase text-white" style="font-size: 12px;">
                                        guardar
                                    </span>
                                </button>
                            </div>


                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="text-center mb-2">
                            <span class="text-uppercase" style="font-family:'Times New Roman', Times, serif; font-size: 16px;">
                                historial
                            </span>
                        </div>
                        <i class="bi bi-circle text-danger me-1" style="font-size: 13px;"></i>
                        <span class="text-uppercase" style="font-size: 13px;">
                            el usuario ha cargado los archivos 
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import { computed, ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2'

const selectedFileName1 = ref('');
const selectedFileName2 = ref('');
const selectedFileName3 = ref('');

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

</script>