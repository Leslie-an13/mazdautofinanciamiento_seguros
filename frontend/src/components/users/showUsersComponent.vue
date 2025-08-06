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
                        <span class="text-uppercase fw-bolder text-white" style="font-size: 12px;">
                            crear usuario
                        </span>
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
                        <tr class="table-active text-center ">
                            <template  v-for="user in arrayUsers" :key="user.idUser">
                                <td >
                                    <span class="text-dark" v-text="user.idUser"></span>
                                </td>
                                <td >
                                    <span class="text-dark" v-text="user.username"></span>
                                </td>
                                <td >
                                    <span class="text-dark text-uppercase" v-text="user.name + ' ' + user.paternal_last_name + ' ' + user.maternal_last_name "></span>
                                </td>
                                <td >
                                    <span class="text-dark" v-text="user.email"></span>
                                </td>
                                <td> 
                                    <button class="btn btn-sm btn-warning" @click="editUser(user.idUser)">
                                        <span class="text-uppercase fw-bold" style="font-size: 12px;">editar</span>
                                    </button>
                                </td>
                            </template>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  

</template>

<script setup>
import { Modal } from 'bootstrap'
import { onBeforeMount, ref } from 'vue';
const arrayUsers = ref('[]')



//Open modal SIN data-bs-target and JQuery
const editUser =  (idUser) =>{
    const modalEdit = document.getElementById('editUserModal');
    const modalInstance = new Modal(modalEdit);
    modalInstance.show();
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
            arrayUsers.value = [response.history[0]];

        }
    })
})

</script>