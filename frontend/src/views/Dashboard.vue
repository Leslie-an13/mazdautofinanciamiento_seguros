<template class="">
  <div>
    <h2>Dashboard</h2>
    <p>Bienvenido al panel de control.</p>

  </div>
</template>

<div class="row imgFondo">

</div>

<script>
import { CButton } from '@coreui/vue'

export default {
  components: { CButton },
  data() {
    return {
      user: '',
      clave: ''
    }
  },
  methods: {
    validateUser(){

      alert('Validando usuario...')
    }
  }
}
</script>