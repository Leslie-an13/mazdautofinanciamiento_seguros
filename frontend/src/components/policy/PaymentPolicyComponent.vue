<template>
    <div class="col-lg-9 mx-auto" style="margin-top: 100px;">
        <div class="card shadow rounded-10">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 mx-auto " v-if="routetofile.existe">
                        
                        <div class="text-center mt-3 mb-3">
                            <span class="fw-bolder text-uppercase fs-6">descargar base aon</span>
                        </div>

                        <div class="d-flex justify-content-center">
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
                                    <div class="text">Download</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        

                    </div>
                    <div class="col-lg-5 mx-auto">

                        <div class="text-center mt-3 mb-3">
                            <span class="text-uppercase fw-bolder fs-7">
                                subir comprobante de pago
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
                                <input class="title" type="file" @change="selectUpload" 
                                    accept=".pdf"
                                    id="payPolicy"/>
                                Selecciona archivo...
                                  <p v-if="selectedFileName" v-text="selectedFileName" class="text-white fw-bolder" style="font-size: 8px;"></p>
                            </label>
                          
                        </div>


                        <div class="d-flex justify-content-center mt-5 mb-3">
                            <select class="form-select form-select-sm w-75" 
                                    id="selectStatus"
                                    aria-label="Small select example">
                                <option value="0">Selecciona una opcion...</option>
                                <option value="1">Aprobar</option>
                                <option value="2">Rechazar</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button class="btn btn-sm btn-success" @click="validateValues">
                                <span class="text-white text-uppercase fw-bolder">
                                    guardar
                                </span>
                            </button>
                        </div>


                    </div>
                    <div class="col-lg-5 mx-auto">
                        <div class="text-center">
                            <span class="text-uppercase fs-6 fw-bold mb-3 mt-5">
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

const uploadFile = ref('');
const approvedFile = ref('');

const props = defineProps({
  routetofile: {
    type: Object,
    required: true
  }

});

const selectedFileName = ref('');

function selectUpload(event){
    let file =  event.target.files[0];

    if(file){
        selectedFileName.value  =  file.name
    }
}

function validateValues(){
  
    let file = document.getElementById('payPolicy').files[0];
    let select1 = document.getElementById('selectStatus').value;
    let select = document.getElementById('selectStatus');
    let textSelect = select.options[select.selectedIndex].text;
    let valid = true;
    if(file == '' || file == undefined){
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

    if(select1 == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
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
  
    let formData = new FormData();
    formData.append('func','saveThePaymentReceipt');
    formData.append('status', textSelect);
    formData.append('filePayment', file)


    fetch('api/paymentReceipt/insertPaymentForPolicy.php', {
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
              showConfirmButton: true
            }).then(() => {
              location.reload(); 
            });
            
        }
    })
    .catch(error => {
        //console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}


const downloadUrl = computed(() => {
  if (!props.routetofile || !props.routetofile.route) return '';
  const fileName = props.routetofile.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/downloadFile.php?file=${fileName}`;
});


onBeforeMount(async() =>{
    const response = await fetch('/api/paymentReceipt/paymentHistory.php', {
        method: 'GET'
    }).then(response =>{
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(response =>{
        debugger

        if(response.success){
            uploadFile.value = response.history[0].proof_upload_date;
            approvedFile.value = response.history[0].user_approval_date;
        
        }
    })


})



</script>