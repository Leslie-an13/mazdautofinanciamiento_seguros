import { ref } from 'vue'

export const isAuthenticated = ref(!!localStorage.getItem('user'))

export function login(user) {
  localStorage.setItem('user', JSON.stringify(user))
  isAuthenticated.value = true
}

export function logout() {
  localStorage.removeItem('user')
  isAuthenticated.value = false
}
