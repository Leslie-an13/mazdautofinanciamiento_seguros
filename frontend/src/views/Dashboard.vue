<template>
  <div>
    <h2>Dashboard</h2>
    <p>Bienvenido al panel de control.</p>
    <CButton color="primary" @click="validateUser">Primary</CButton>
  </div>
</template>

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