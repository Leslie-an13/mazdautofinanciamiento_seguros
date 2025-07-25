import { createApp } from 'vue'
import App from './App.vue'

// Bootstrap y tu estilo personalizado
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/styles/login.css'
import './assets/styles/sidebar.css'

// CoreUI
import CoreuiVue from '@coreui/vue'
import '@coreui/coreui/dist/css/coreui.min.css'

import CIcon from '@coreui/icons-vue'
import * as iconSet from '@coreui/icons'

// Router
import router from './router'

const app = createApp(App)

app.use(router)
app.use(CoreuiVue)

app.component('CIcon', CIcon)
app.provide('icons', iconSet)

app.mount('#app')

