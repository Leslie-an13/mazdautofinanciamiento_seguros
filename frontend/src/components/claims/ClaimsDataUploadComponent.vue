<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 45px; ">

        <div class="row">
            <div class="col-lg-4">
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body"></div>
                </div>
            </div>
        </div>



       
    </div>

</template>

<script setup>
import { ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2'

/*const props = defineProps({
  getFilesPayments: {
    type: Object,
    required: true
  }
});*/


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



</script>