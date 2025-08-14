<template>

    <div class="col-lg-11 mx-auto" style="margin-top: 60px;">

        <div class="row">

            <!--Download file-->
            <div class="col-lg-3">
                <div class="card shadow">
                    <div class="card-body">

                        <!--text-->
                        <div class="text-center mt-3 mb-3">
                            <span class="fw-bolder text-uppercase fs-6" style="font-family:'Times New Roman', Times, serif; ">
                                descargar base aon</span>
                        </div>

                        <div class="d-flex justify-content-center">
                            <img src="/img/revisarbase.jpg" alt="No se puede ver" style="width: 220px; height: 250px;">
                        </div>

                        <!--Download file-->
                        <div class="d-flex justify-content-center mt-5 mb-3" v-if="routetofile.existe">
                            <a class="buttonDown" :href="downloadUrl" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                        </div>
                    
                    </div>
                </div>
            </div>

            <!--Upload file and history-->
            <div class="col-lg-9 mx-auto">
                <div class="card shadow" style="height: 443px;">
                    <div class="card-body">
                        <div class="row">
                            <!--Upload file-->
                            <div class="col-lg-7">
                                 <div class="text-center mt-3 mb-3">
                                    <span class="text-uppercase fw-bolder fs-7" style="font-family:'Times New Roman', Times, serif; ">
                                        subir comprobante de pago
                                    </span>
                                </div>

                                <!--Upload file-->
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
                                
                                <!--Select status-->
                                <div class="d-flex justify-content-center mt-5 mb-3">
                                    <select class="form-select form-select-sm w-75" 
                                            id="selectStatus"
                                            aria-label="Small select example">
                                        <option value="0">Selecciona una opcion...</option>
                                        <option value="1">Aprobar pago</option>
                                        <option value="2">Rechazar pago</option>
                                    </select>
                                </div>

                                <!--Button save-->
                                <div class="d-flex justify-content-end mt-5">
                                    <button class="btn btn-sm btn-success" @click="validateValues">
                                        <span class="text-white text-uppercase fw-bolder">
                                            guardar
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="text-center mt-3">
                                    <span class="text-uppercase fs-6 fw-bold" style="font-family:'Times New Roman', Times, serif; ">
                                        historial
                                    </span>
                                </div>
                                <template v-if="approvedFile">
                                    <i class="bi bi-circle me-2" style="color:red;"></i>
                                    <span class="text-dark" v-text="approvedFile"></span>
                                </template>
                            </div>
                        </div>
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
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se guarda la informacion",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                saveInfoPayment(textSelect, file);

            }
        });
}

function saveInfoPayment(textSelect, file){
  
    let formData = new FormData();
    formData.append('func','saveThePaymentReceipt');
    formData.append('status', textSelect);
    formData.append('filePayment', file)


    fetch('api/paymentReceipt/insertPaymentForPolicy.php', {
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
        //console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

const downloadUrl = computed(() => {
  if (!props.routetofile || !props.routetofile.route) return '';
  const fileName = props.routetofile.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/downloadFile.php?file=${fileName}`;
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
      
        if(response.success){
            approvedFile.value = response.history[0].user_approval_date;
        
        }
    })


})



</script>