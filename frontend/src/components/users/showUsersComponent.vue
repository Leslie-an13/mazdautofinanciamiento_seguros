<template>
    <div class="col-lg-11 mx-auto" style="margin-top: 60px;">
        <div class="card shadow rounded-10 " style="height: 600px;">
            <div class="card-header min-h-6px">
                <div class="d-flex justify-content-end">
                   <!--Searching user-->
                    <input class="form-control form-control-sm w-25 me-3" placeholder="Buscar"></input>

                    <!--Create user-->
                     <button type="button" class="btn btn-primary btn-sm " 
                             @click="openModalCreate()">
                        <span class="text-uppercase fw-bolder text-white me-2" style="font-size: 12px;">
                            crear usuario
                        </span>
                        <i class="bi bi-plus-circle text-white"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class="text-center text-muted text-uppercase" style="font-size: 12px;">
                        <tr>
                           <th>folio</th>
                           <th>usuario</th>
                           <th>nombre completo</th>
                           <th>correo electronico</th>
                           <th>editar</th>
                        </tr>
                     
                    </thead>
                    <tbody>
                        <template  v-for="(user, index) in arrayUsers[0]" :key="user.idUser">
                            <tr class="table-active text-center ">
                                <td >
                                    <span class="text-dark" v-text="user.idUser"></span>
                                </td>
                                <td >
                                    <span class="text-dark" v-text="user.username"></span>
                                </td>
                                <td >
                                    <span class="text-dark text-uppercase" v-text="user.names + ' ' + user.paternal_last_name + ' ' + user.maternal_last_name "></span>
                                </td>
                                <td >
                                    <span class="text-dark" v-text="user.email"></span>
                                </td>
                                <td> 
                                    <button class="btn btn-sm btn-warning" @click="editUser(user.idUser, arrayUsers[0])">
                                        <i class="bi bi-pen text-white me-2"></i>
                                        <span class="text-uppercase fw-bold text-white" style="font-size: 12px;">editar</span>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  

</template>

<script setup>
import { Modal } from 'bootstrap'
import { onBeforeMount, ref, defineEmits } from 'vue';

const arrayUsers = ref('[]')
const emit = defineEmits(['eventUsers']);

//Open modal SIN data-bs-target and JQuery
const editUser =  (idUser, users) =>{

    const modalEdit = document.getElementById('editUserModal');
    const modalInstance = new Modal(modalEdit);
    modalInstance.show();

    emit('eventUsers', {idUser,users});

}

const openModalCreate = () =>{
    const modalCreate = document.getElementById('createUserModal');
    const modalInstance = new Modal(modalCreate);

    modalInstance.show();
}

onBeforeMount(async() =>{
    const response = await fetch('/api/getUsers/getInfoUser.php', {
        method: 'GET'
    }).then(response =>{
        if (!response.ok) {
            throw new Error('Respuesta no OK del servidor: ' + response.status);
        }
        return response.json();
    }).then(response =>{
        if(response.success){
            arrayUsers.value = [response.history];

        }
    })
})

</script>