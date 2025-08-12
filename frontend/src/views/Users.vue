<template>
   <!--title-->
  <div style="background-color: rgb(222, 222, 222); height: 25px;">
        <i class="bi bi-caret-right"></i>
        <span class="text-uppercase fw-boldest" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande',            'Lucida Sans', Arial, sans-serif; font-size: 11px;">
            Usuarios
        </span>
  </div>

  <div class="imgBackground row">
    <!--Show all users-->
    <showUsersComponent @eventUsers="getEmitUser"></showUsersComponent>

    <!--Modal create users-->
    <CreateUserComponent></CreateUserComponent>

    <!--Modal edit user-->
    <editUserComponent :userToEdit="userToEdit"></editUserComponent>
  </div>
</template>

<script>
import showUsersComponent from '../components/users/showUsersComponent.vue';
import CreateUserComponent from '../components/users/CreateUserComponent.vue';
import editUserComponent from '../components/users/editUserComponent.vue';

export default {
  components: {
    showUsersComponent,
    CreateUserComponent,
    editUserComponent
  },
  data() {
    return {
      userToEdit: {
        names: '',
        paternal: '',
        maternal: '',
        email: '',
        user: '',
        role: '',
        userId: 0
      }
    }
  },
  methods: {
    getEmitUser(values){
      let userFound = values.users.find(u => u.idUser === values.idUser);

      if(userFound){
        this.userToEdit = {
            names: userFound.names,
            paternal: userFound.paternal_last_name,
            maternal: userFound.maternal_last_name,
            email: userFound.email,
            user: userFound.username,
            role: userFound.role,
            userId: userFound.idUser
        }
      }
          
    }

  }

}
</script>
