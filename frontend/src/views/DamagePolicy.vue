<template>
  <div  class="row imgFondo">
    <UploadDataBaseComponent />
  </div>
</template>

<script>
import UploadDataBaseComponent from '../components/policy/UploadDataBaseComponent.vue';

export default {
  components: {
    UploadDataBaseComponent
  },
  data() {
    return {
      name: 'Leslie'
    }
  }
}
</script>
