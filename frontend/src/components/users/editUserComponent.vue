
<template>
    <!--Modal edit-->
    <div class="modal fade" id="editUserModal" data-bs-backdrop="static" 
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar usuario</h1>
                    <button type="button" class="btn-close" @click="closeModal()" ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!--Info part1-->
                        <div class="col-lg-6">
                            <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa usuario:</label>
                            <input type="text" class="form-control mb-3" 
                                    v-model="userToEdit.user"
                                    id="valuesUser"
                                    placeholder="Escribe usuario" aria-label="Username" aria-describedby="visible-addon">

                            <!--Apellido paterno-->
                            <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa apellido paterno:</label>
                            <input type="text" class="form-control mb-3" 
                                    id="valuesPaternal"
                                    v-model="userToEdit.paternal"
                                    placeholder="Escribe paterno" aria-label="Username" aria-describedby="visible-addon">

                            <!--Correo electronico-->
                            <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa correo electronico</label>
                            <input type="email" class="form-control mb-3"
                                    id="valuesEmail"
                                    v-model="userToEdit.email"
                                    placeholder="Escribe correo" aria-label="Username" aria-describedby="visible-addon">

                        </div>

                        <!--Infor part2-->
                        <div class="col-lg-6">

                            <label class="text-uppercase text-muted" style="font-size: 10px;">Ingresar nombre(s)</label>
                            <input type="text" class="form-control mb-3" 
                                    v-model="userToEdit.names"
                                    id="valuesNames"
                                    placeholder="Escribe nombre(s)" aria-label="Username" aria-describedby="visible-addon">
                            
                            <!--Apellido materno-->
                            <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Ingresa apellido materno:</label>
                            <input type="text" class="form-control mb-3"
                                    v-model="userToEdit.maternal"
                                    id="valuesMaternal"
                                    placeholder="Escribe materno" aria-label="Username" aria-describedby="visible-addon">

                            <!--Rol-->
                            <label class="text-uppercase text-muted mt-2" style="font-size: 13px;">Selecciona un rol:</label>
                            <select class="form-select form-select-sm"  v-if="userToEdit"
                                    id="selectRolValue"
                                    aria-label="Small select example" style="height: 35px;">
                                <option  value="0">Selecciona...</option>
                                <option value="1">Admin</option>
                                <option value="2">Gestor de siniestros</option>
                                <option value="3">Tesorero</option>
                                <option value="4">Auxiliar contable</option>
                            </select>
                        
                        
                        </div>

                        <!--Password && text -->
                        <div class="text-center mt-3">
                            <label class="text-uppercase text-muted mt-2" style="font-size: 10px;">Escribe una contraseña:</label>
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <input type="password" class="form-control mb-3 w-75" 
                                    id="valuePass"
                                    placeholder="Escribe contraseña" aria-label="Username" aria-describedby="visible-addon">
                        </div>

                    </div>
                </div>
                <!--Footer modal-->
                <div class="modal-footer d-flex justify-content-between text-uppercase">
                    <button type="button" class="btn btn-sm btn-danger" @click="closeModal()">
                        <i class="bi bi-x-lg me-2 text-white"></i>
                        <span class="text-uppercase text-white fw-bold" style="font-size: 12px;">Cerrar</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-success" @click="validateValues(userToEdit.userId)">
                        <i class="bi bi-floppy text-white me-2"></i>
                        <span class="text-white text-uppercase fw-bold" style="font-size: 12px;">guardar</span></button>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Modal } from 'bootstrap'
import Swal from 'sweetalert2'

const props = defineProps({
  userToEdit: {
    type: Object,
    default: () => ({ users: [] })
  }
})

const closeModal = () => {
    const modalEdit = document.getElementById('editUserModal');
    let modalInstance = Modal.getInstance(modalEdit); //Devuelve la instancia si ya existe en este caso existe porque se abre la modal con data-bs
    if (!modalInstance) { //Asegura que solo se cree una y no varias y no haya tema con show() y hide()
        modalInstance = new Modal(modalEdit); //}Crea una nueva instancia desde cero
    }
    document.activeElement.blur();

    modalInstance.hide();
}

function validateValues(userID){

    let user = document.getElementById('valuesUser').value;
    let paternal = document.getElementById('valuesPaternal').value;
    let maternal = document.getElementById('valuesMaternal').value;
    let names = document.getElementById('valuesNames').value;
    let email = document.getElementById('valuesEmail').value;
    let rol = document.getElementById('selectRolValue').value;
    let pass = document.getElementById('valuePass').value;
    let valid = true;

    if(user == "" || user == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes ingresar un usuario',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
    }

     if(paternal == "" || paternal == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes ingresar un apellido paterno',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
    }

    if(maternal == "" || maternal == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes ingresar un apellido materno',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
    }

    if(names == "" || names == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes ingresar un apellido materno',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
    }

     if(email == "" || email == 0){
        Swal.fire({
            toast: true,
            position: 'top-end', 
            icon: 'warning',     
            title: 'Invalido debes ingresar un correo',
            showConfirmButton: false,
            timer: 3000, 
            timerProgressBar: true
        });
        valid = false;
    }

    if(valid){
        questionEditUser(userID);
    }


}


function questionEditUser(userID){
    Swal.fire({
        title: '&iquest;Est&aacute;s seguro?',
        text: "Se editara la informacion",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Confirmar!",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#45A141",
        cancelButtonColor: "#F62E2E",
        reverseButtons: true,
    }).then((result) => {
            if (result.isConfirmed) {
                editUser(userID);

            }
        });
}

function editUser(userID){
    let user = document.getElementById('valuesUser').value;
    let paternal = document.getElementById('valuesPaternal').value;
    let maternal = document.getElementById('valuesMaternal').value;
    let names = document.getElementById('valuesNames').value;
    let email = document.getElementById('valuesEmail').value;
    let rol = document.getElementById('selectRolValue');
    let textRol = rol.options[rol.selectedIndex].text;
    let pass = document.getElementById('valuePass').value;

    let formData = new FormData();
    formData.append('func', 'editInformationUser');
    formData.append('user', user);
    formData.append('paternal', paternal);
    formData.append('maternal', maternal);
    formData.append('names', names);
    formData.append('email', email);
    formData.append('role', textRol);
    formData.append('pass', pass );
    formData.append('userId', userID);

    Swal.fire({
        title: "Procesando...",
        text: "Por favor, espera mientras se procesa la informacion.",
        icon: "info",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    }); 

    fetch('api/getUsers/editUser.php', {
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
              title: "Datos actualizados correctamente",
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

</script>