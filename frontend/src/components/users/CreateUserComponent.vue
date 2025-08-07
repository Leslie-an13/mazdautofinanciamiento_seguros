<style>
    .is-invalid {
    border-color: #dc3545;
    }
</style>


<template>
      <!--Modal create users-->
    <div class="modal fade" id="createUserModal" data-bs-backdrop="static" data-bs-keyboard="false" 
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Crear usuario</h1>
                <button type="button" class="btn-close" @click="closeModalCreate()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa usuario:</label>
                        <input type="text" class="form-control mb-3" 
                                id="userValue"
                                placeholder="Escribe usuario" aria-label="Username" aria-describedby="visible-addon">

                        <!--Apellido paterno-->
                        <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa apellido paterno:</label>
                        <input type="text" class="form-control mb-3" 
                                id="paternalValue"
                                placeholder="Escribe paterno" aria-label="Username" aria-describedby="visible-addon">

                        <!--Correo electronico-->
                        <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa correo electronico</label>
                        <input type="email" :class="['form-control', 'mb-3', { 'is-invalid': showError }]"
                                id="email"
                                v-model="email"
                                placeholder="Escribe correo" aria-label="Username" aria-describedby="visible-addon">

                    </div>


                    <div class="col-lg-6">

                        <label class="text-uppercase text-muted" style="font-size: 10px;">Ingresar nombre(s)</label>
                        <input type="text" class="form-control mb-3" 
                                id="last_nameValue"
                                placeholder="Escribe nombre(s)" aria-label="Username" aria-describedby="visible-addon">
                        
                        <!--Apellido paterno-->
                        <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa apellido materno:</label>
                        <input type="text" class="form-control mb-3"
                                id="maternalValue"
                                placeholder="Escribe materno" aria-label="Username" aria-describedby="visible-addon">

                        <!--Rol-->
                        <label class="text-uppercase text-muted mt-2" style="font-size: 13px;">Selecciona un rol:</label>
                        <select class="form-select form-select-sm" 
                                id="selectRolValue"
                                aria-label="Small select example" style="height: 35px;">
                            <option value="0">Selecciona...</option>
                            <option value="1">Admin</option>
                            <option value="2">Gestor de siniestros</option>
                            <option value="3">Tesorero</option>
                            <option value="4">Auxiliar contable</option>
                        </select>
                    
                    
                    </div>
                    <!--Password-->
                    <div class="text-center mt-3">
                         <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Escribe una contraseña:</label>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <input type="password" class="form-control mb-3 w-75" 
                                id="passValue"
                                placeholder="Escribe contraseña" aria-label="Username" aria-describedby="visible-addon">
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between ">
                <!--Button Close-->
                <button type="button" class="btn btn-danger btn-sm text-white" @click="closeModalCreate()">
                    <i class="bi bi-x-lg text-white me-2"></i>
                    <span class="text-uppercase tex-white" style="font-size: 11px;">Cerrar</span>
                </button>
                <!--Button Save-->
                <button type="button" class="btn btn-success btn-sm " @click="validateInputs()">
                    <i class="bi bi-floppy text-white me-2"></i>
                    <span class="text-uppercase text-white" style="font-size: 11px;">Guardar</span>
                   
                </button>
            </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Modal } from 'bootstrap'
import { ref } from 'vue';
import Swal from 'sweetalert2'

const email = ref('');
const showError = ref(false)

const closeModalCreate = () =>{

    const modalCreate = document.getElementById('createUserModal');
    let modalInstance = Modal.getInstance(modalCreate); //Devuelve la instancia si ya existe en este caso existe porque se abre la modal con data-bs
    if (!modalInstance) { //Asegura que solo se cree una y no varias y no haya tema con show() y hide()
        modalInstance = new Modal(modalCreate); //}Crea una nueva instancia desde cero
    }

    document.activeElement.blur();
    modalInstance.hide();

}

function validateInputs(){

    let valueUser = document.getElementById('userValue').value;
    let valuePaternal = document.getElementById('paternalValue').value;
    let valueEmail = document.getElementById('email').value;
    let valueNames = document.getElementById('last_nameValue').value;
    let valueMaternal = document.getElementById('maternalValue').value;
    let valueRol = document.getElementById('selectRolValue').value;
    let ValuePassword = document.getElementById('passValue').value;
    let valid = true;

    if(valueUser == "" || valueUser == 0){

        document.getElementById('userValue').classList.add('border-danger');
        setTimeout(() => document.getElementById('userValue').classList.remove('border-danger'),3000);

        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un usuario valido',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valuePaternal == "" || valuePaternal == 0){
        document.getElementById('paternalValue').classList.add('border-danger');
        setTimeout(() => document.getElementById('paternalValue').classList.remove('border-danger'),3000);

        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un apellido paterno',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;

    }

    if(valueEmail == "" || valueEmail == 0){
        document.getElementById('email').classList.add('border-danger');
        setTimeout(() => document.getElementById('email').classList.remove('border-danger'),3000);

        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un correo valido',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(valueEmail)) {
        showError.value = true
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un correo valido',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return 
        
    } 


    if(valueNames == "" || valueNames == ""){

        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un nombre(s)',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }


    if(valueMaternal == "" || valueMaternal == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir un apellido materno',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valueRol == "0"){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes selecccionar un rol',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }
    
    if(ValuePassword == "" || ValuePassword == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'error',     
            title: 'Invalido debes escribir una contraseña',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
        return;
    }

    if(valid){
        questionSaveCreateUser();
    }
}

function questionSaveCreateUser(){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se procesara el usuario",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                saveUserCreate();

            }
        });
}

function saveUserCreate(){

    let valueUser = document.getElementById('userValue').value;
    let valuePaternal = document.getElementById('paternalValue').value;
    let valueEmail = document.getElementById('email').value;
    let valueNames = document.getElementById('last_nameValue').value;
    let valueMaternal = document.getElementById('maternalValue').value;
    let valueRol = document.getElementById('selectRolValue');
    let textRol = valueRol.options[valueRol.selectedIndex].text;
    let valuePassword = document.getElementById('passValue').value;

    let formData = new FormData();
    formData.append('func', 'createUserNew');
    formData.append('valueUser', valueUser);
    formData.append('valuePaternal', valuePaternal);
    formData.append('valueEmail', valueEmail);
    formData.append('valueNames', valueNames);
    formData.append('valueMaternal', valueMaternal);
    formData.append('roleValue', textRol);
    formData.append('valuePassword', valuePassword);
    debugger


    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 


    fetch('/api/getUsers/createUser.php', {
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
        debugger
        if(data.success){
            
            Swal.fire({
              icon: "success",
              title: "Datos insertados correctamente",
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