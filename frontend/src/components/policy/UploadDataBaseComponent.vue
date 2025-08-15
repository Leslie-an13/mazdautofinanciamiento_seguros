<template>

    <div class="col-lg-11 mx-auto">

        <div class="row" style="margin-top: 55px;">
            <!--File base-->
            <div class="col-lg-3 mx-auto">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <div class="text-center">
                            <span class="text-uppercase" style="font-size: 14px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Descargar base</span>
                        </div>

                        <div class="d-flex justify-content-center mt-3 mb-3">
                            <img src="/img/revisarbase.jpg" alt="imagen no encontrada" style="width: 220px; height: 250px;">
                        </div>

                        <div class="d-flex justify-content-center mt-3" v-if="getRoute.exist">
                            <a class="buttonDown" :href="downloadBase" style="color: inherit; text-decoration: none;">
                                <span class="button__text text-white">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                        </div>

                        <select class="form-select form-select-sm w-100 mb-3" 
                                style="margin-top: 20px;"
                                aria-label="Large select example" id="selectAp">
                                <option value="0">Selecciona...</option>
                                <option value="1">Aprobar base</option>
                                <option value="1">Rechazar base</option>
                        </select>

                        <div class="d-flex justify-content-end mt-5">
                            <button class="btn btn-sm btn-success" @click="validateBase">
                                <span class="text-uppercase text-white fs-7 fw-bolder">Guardar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--History and file-->
            <div class="col-lg-9 mx-auto">
                <div class="card shadow" style="height: 510px;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto border-2 border-light-secondary border-end">
                                <div class="text-center">
                                    <span class="text-uppercase" style="font-size: 14px; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">historial</span>
                                </div>
                                
                                <template v-if="uploadFile != '' ">
                                    <i class="bi bi-circle me-2" style="color: red;"></i>
                                    <span class="text-dark" v-text="uploadFile"></span>
                                </template>
                                <br>
                                <template v-if="approvedFile != '' ">
                                    <i class="bi bi-circle me-2" style="color: red;"></i>
                                    <span class="text-dark" v-text="approvedFile"></span>
                                </template>
                                
                            </div>
                            <div class="col-lg -5 mx-auto">
                                <div class="text-center">
                                    <span class="text-uppercase" style="font-size: 14px; ">Descargar comprobante</span>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <img src="/img/facturas.jpg" style="width: 225px; height: 240px;">
                                </div>

                                 <div class="d-flex justify-content-center mt-3" v-if="getRouteFile.exist">
                                    <a class="buttonDown" :href="downloadFile" style="color: inherit; text-decoration: none;">
                                        <span class="button__text text-white">Download</span>
                                        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                                    </a>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <select class="form-select form-select-sm w-75 mb-3" 
                                            style="margin-top: 0px;"
                                            aria-label="Large select example" id="selectPayment">
                                            <option value="0">Selecciona...</option>
                                            <option value="1">Aprobar pago</option>
                                            <option value="1">Rechazar pago</option>
                                    </select>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-5">
                                    <button class="btn btn-sm btn-success" @click="validatePayment">
                                        <span class="text-uppercase text-white fs-7 fw-bolder">Guardar</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
</template>

<script setup>

const props = defineProps({
  getRouteFile: {
    type: Object,
    required: true
  },
  getRoute: {
    type: Object,
    required: true
  }

});

import { onBeforeMount, ref, computed} from 'vue';
import Swal from 'sweetalert2'

const uploadFile = ref('');
const approvedFile = ref('');

function validatePayment(){
    let select1 = document.getElementById('selectPayment').value;
    let valid = true;

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

    if(valid){
        questionPayment();
    }

}

function questionPayment(){
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
                savePaymentStatus();

            }
        });
}

function savePaymentStatus(){
   
    let select = document.getElementById('selectPayment');
    let textSelect = select.options[select.selectedIndex].text;

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

    let formData = new FormData();
    formData.append('status_payment', textSelect);


    fetch('/api/getPolicy/store_base_status.php', {
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
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });

}

function validateBase(){
    let select1 = document.getElementById('selectAp').value;

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

    questionApproveBase();
}

function questionApproveBase(){

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
                saveApproved();

            }
        });
}

function saveApproved(){

    let select = document.getElementById('selectAp');
    let textSelect = select.options[select.selectedIndex].text;

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

    let formData = new FormData();
    formData.append('textPolicy', textSelect);


    fetch('/api/getPolicy/store_base_status.php', {
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
       // console.error('Error atrapado en catch:', error);
        Swal.close();
    });


}

//Se descarga comprobante 
const downloadFile = computed(() => {
  if (!props.getRouteFile || !props.getRouteFile.route) return '';
  const fileName = props.getRouteFile.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_files_payment.php?file=${fileName}`;
});

//Descargar base aon
const downloadBase = computed(() => {
  if (!props.getRoute || !props.getRoute.route) return '';
  const fileName = props.getRoute.route.split('/').pop(); 
  return `http://localhost/mazdautofinanciamiento_seguros/backend/api/getRouteFiles/download_base_aon.php?file=${fileName}`;
});

//Obtener el historial
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
            uploadFile.value = response.history[0].	base_file_approved;
            approvedFile.value = response.history[0].invoice_approved;
        }
    })
})


</script>