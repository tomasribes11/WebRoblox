// src/api/axios.js
// Central Axios instance used by all API modules.
// Interceptors handle auth token injection and common error cases.

import axios from 'axios'

const api = axios.create({
  // Base URL read from Vite env variable (set in frontend/.env or .env.local)
  // Default: http://localhost/api/v1
  baseURL: import.meta.env.VITE_API_URL || 'http://localhost/api/v1',
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
})

// ─── Request interceptor ──────────────────────────────────────────────────
// Attaches the Bearer token to every outgoing request if the user is logged in.
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('auth_token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

// ─── Response interceptor ─────────────────────────────────────────────────
api.interceptors.response.use(
  // Success: pass through unchanged
  (response) => response,

  // Error: handle common cases
  (error) => {
    if (error.response?.status === 401) {
      // Token expired or invalid → clear session and redirect to login
      localStorage.removeItem('auth_token')
      localStorage.removeItem('auth_user')
      window.location.href = '/login'
    }

    if (error.response?.status === 422) {
      // Laravel validation error → reshape into a user-friendly object
      // error.response.data.errors is: { field: ['message', ...], ... }
      const validationErrors = error.response.data.errors || {}
      const firstErrors = Object.fromEntries(
        Object.entries(validationErrors).map(([field, messages]) => [
          field,
          messages[0], // take only the first error per field
        ])
      )
      return Promise.reject({ validationErrors: firstErrors, status: 422 })
    }

    return Promise.reject(error)
  }
)

export default api
