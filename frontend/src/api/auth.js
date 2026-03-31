// src/api/auth.js
// Authentication API calls. All functions return the axios response data.

import api from './axios'

// POST /api/v1/auth/login
// Returns: { token, user }
export const login = (email, password) =>
  api.post('/auth/login', { email, password }).then((r) => r.data)

// POST /api/v1/auth/register
// Returns: { token, user }
export const register = (name, email, password, passwordConfirmation) =>
  api
    .post('/auth/register', {
      name,
      email,
      password,
      password_confirmation: passwordConfirmation,
    })
    .then((r) => r.data)

// POST /api/v1/auth/logout (requires Bearer token)
export const logout = () => api.post('/auth/logout').then((r) => r.data)

// GET /api/v1/auth/me (requires Bearer token)
// Returns: { id, name, email, role }
export const getMe = () => api.get('/auth/me').then((r) => r.data)
