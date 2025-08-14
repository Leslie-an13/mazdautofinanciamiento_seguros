import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  base: '/', // <- aquí pones '/' para root del subdominio, o '/subcarpeta/' si aplica
  server: {
    proxy: {
      '/api': {
        target: 'http://localhost/mazdautofinanciamiento_seguros/backend/api',
        changeOrigin: true,
        rewrite: path => path.replace(/^\/api/, '')
      }
    }
  }
})
