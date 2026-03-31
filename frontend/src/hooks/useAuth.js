// src/hooks/useAuth.js
// Shorthand hook for consuming AuthContext.
// Usage: const { user, login, logout } = useAuth()

import { useContext } from 'react'
import { AuthContext } from '../context/AuthContext'

export function useAuth() {
  const ctx = useContext(AuthContext)
  if (!ctx) throw new Error('useAuth must be used inside <AuthProvider>')
  return ctx
}
