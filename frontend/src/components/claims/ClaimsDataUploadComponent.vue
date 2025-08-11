<template>
    <div class="col-lg-10 mx-auto" style="margin-top: 45px; ">
        <div class="card shadow rounded-15" style="height: 450px;">
            <div class="card-body">
                <div class="row">

                    <!--Upload file-->
                    <div class="col-lg-6">
                        <div class="containerFile mx-auto" style="margin-top: 10px;">
                                <div class="folder">
                                <div class="front-side">
                                <div class="tip"></div>
                                <div class="cover"></div>
                                </div>
                                <div class="back-side cover"></div>
                            </div>
                                <label class="custom-file-upload">
                                    <input class="title" type="file" @change="selectFileClaims" 
                                        accept=".pdf"
                                        id="payPolicy"/>
                                    Selecciona archivo...
                                   <!-- <p v-if="selectedFileName" v-text="selectedFileName" class="text-white fw-bolder" style="font-size: 8px;"></p>-->
                                </label>
                            
                        </div>


                        <div class="text-center mt-5">
                            <span class="text-uppercase">aprobar archivo</span>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <select class="form-select form-select-sm w-50" aria-label="Small select example">
                                <option value="0">Selecciona un estatus</option>
                                <option value="1">Aprobar</option>
                                <option value="2">Rechazar</option>
                               
                            </select>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" class="btn btn-sm btn-success">
                                <i class="bi bi-floppy me-2 text-white"></i>
                                <span class="text-uppercase text-white" style="font-size: 15px;">
                                    guardar
                                </span>
                            </button>
                        </div>
                    </div>

                    <!--Historial-->
                    <div class="col-lg-6">
                        <i class="bi bi-circle me-2 text-danger"></i>
                        <span>Usuario</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>



<script setup>
import { computed, ref, onBeforeMount } from 'vue';
import Swal from 'sweetalert2'



function selectFileClaims(){

}

</script>