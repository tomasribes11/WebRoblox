// vite.config.js
// Vite build configuration for the React frontend.
// In development: Vite runs on port 5173 and nginx proxies to it.
// In production: `vite build` outputs to /dist and nginx serves it statically.

import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],

  server: {
    // Listen on all network interfaces inside Docker
    host: '0.0.0.0',
    port: 5173,
    // Needed for Vite HMR to work behind nginx proxy
    hmr: {
      host: 'localhost',
      port: 5173,
    },
  },
})
