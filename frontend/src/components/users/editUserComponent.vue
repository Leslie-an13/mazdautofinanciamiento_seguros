
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
                ...
            </div>
            <div class="modal-footer d-flex justify-content-between text-uppercase">
                <button type="button" class="btn btn-sm btn-danger" @click="closeModal()">Cerrar</button>
                <button type="button" class="btn btn-sm btn-success">guardar</button>
            </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { Modal } from 'bootstrap'

const closeModal = () => {
    const modalEdit = document.getElementById('editUserModal');
    let modalInstance = Modal.getInstance(modalEdit); //Devuelve la instancia si ya existe en este caso existe porque se abre la modal con data-bs
    if (!modalInstance) { //Asegura que solo se cree una y no varias y no haya tema con show() y hide()
        modalInstance = new Modal(modalEdit); //}Crea una nueva instancia desde cero
    }
    document.activeElement.blur();

    modalInstance.hide();
}

</script>