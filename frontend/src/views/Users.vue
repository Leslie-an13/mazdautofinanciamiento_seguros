<template>
  <div class="imgBackground row">
    <!--Show all users-->
    <showUsersComponent></showUsersComponent>

    <!--Modal create users-->
    <CreateUserComponent></CreateUserComponent>

    <!--Modal edit user-->
    <editUserComponent></editUserComponent>
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
      name: 'Leslie'
    }
  }
}
</script>
