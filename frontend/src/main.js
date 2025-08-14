import { createApp } from 'vue'
import App from './App.vue'
// Router
import router from './router'
import { fetchCurrentUser, currentUser } from './auth'
import { loading } from './loadingStore'
// Bootstrap y tu estilo personalizado
import './assets/styles/login.css'
import './assets/styles/sidebar.css'
import 'bootstrap-icons/font/bootstrap-icons.css';
import './assets/styles/uploadFile.css'
import './assets/styles/preloader.css'
import './assets/styles/uploadPay.css'
import './assets/styles/usersBackground.css'
import './assets/access/access_denied.css'
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/styles/progress.css'
import 'bootstrap'

// CoreUI
import CoreuiVue from '@coreui/vue'
import '@coreui/coreui/dist/css/coreui.min.css'

import CIcon from '@coreui/icons-vue'
import * as iconSet from '@coreui/icons'

async function initApp() {
  loading.value = true

  await fetchCurrentUser() 

  if (!currentUser.value && router.currentRoute.value.meta.requiresAuth) {
    router.push('/login')
  }

  const app = createApp(App)

  app.use(router)
  app.use(CoreuiVue)

  app.component('CIcon', CIcon)
  app.provide('icons', iconSet)

  router.beforeEach((to, from, next) => {
    loading.value = true
    //Se importa el store global para saber si se debe mostrar el preloader al cambiar de paginas
    next()
  })

  router.afterEach(() => {
   
    setTimeout(() => {
      loading.value = false
      //Se oculta despues de un cierto periodo cuando termina de cambiar de rutas
    }, 500)
  })

  app.mount('#app')

  
}

initApp()





