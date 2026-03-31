// src/context/AuthContext.jsx
// Provides authentication state to the entire app.
// On mount: reads token from localStorage and validates it with GET /auth/me.
// Exposes: user, isLoading, login(), logout()

import { createContext, useState, useEffect, useCallback } from 'react'
import * as authApi from '../api/auth'

export const AuthContext = createContext(null)

export function AuthProvider({ children }) {
  const [user, setUser]         = useState(null)
  const [isLoading, setLoading] = useState(true)

  // On first load: try to restore the session from localStorage
  useEffect(() => {
    const token = localStorage.getItem('auth_token')
    if (!token) {
      setLoading(false)
      return
    }

    authApi
      .getMe()
      .then((userData) => setUser(userData))
      .catch(() => {
        // Token is invalid or expired — clear it
        localStorage.removeItem('auth_token')
        localStorage.removeItem('auth_user')
      })
      .finally(() => setLoading(false))
  }, [])

  // Calls the API, saves the token, updates state
  const login = useCallback(async (email, password) => {
    const data = await authApi.login(email, password)
    localStorage.setItem('auth_token', data.token)
    localStorage.setItem('auth_user', JSON.stringify(data.user))
    setUser(data.user)
    return data
  }, [])

  // Calls the API to revoke the token, then clears local state
  const logout = useCallback(async () => {
    try {
      await authApi.logout()
    } finally {
      localStorage.removeItem('auth_token')
      localStorage.removeItem('auth_user')
      setUser(null)
    }
  }, [])

  return (
    <AuthContext.Provider value={{ user, isLoading, login, logout }}>
      {children}
    </AuthContext.Provider>
  )
}
