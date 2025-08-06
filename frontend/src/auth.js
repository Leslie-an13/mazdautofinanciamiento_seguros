import { ref } from 'vue'

// Estado de autenticación
export const isAuthenticated = ref(!!localStorage.getItem('user'))

// Estado global del usuario
export const currentUser = ref(null)

// Función para iniciar sesión (guarda en localStorage)
export function login(user) {
  localStorage.setItem('user', JSON.stringify(user))
  isAuthenticated.value = true
  currentUser.value = user
}

// Función para cerrar sesión
export function logout() {
  localStorage.removeItem('user')
  isAuthenticated.value = false
  currentUser.value = null
}

// Función para recuperar la sesión desde el backend
export async function fetchCurrentUser() {

  try {
    const res = await fetch('/api/getCurrentUser.php', {
      credentials: 'include'
    })
    const data = await res.json()

    if (data.logged_in) {
      debugger
      currentUser.value = {
        id: data.user_id,
        name: data.username,
        role: data.role
      }
      isAuthenticated.value = true
    } else {
      currentUser.value = null
      isAuthenticated.value = false
    }
  } catch {
    currentUser.value = null
    isAuthenticated.value = false
  }
}


