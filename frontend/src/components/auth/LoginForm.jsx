// src/components/auth/LoginForm.jsx
// Bootstrap login form with validation error display.
// On success: navigates to home. On error: shows field-level errors from Laravel.

import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import { useTranslation } from 'react-i18next'
import { useAuth } from '../../hooks/useAuth'

export default function LoginForm() {
  const { t }        = useTranslation()
  const { login }    = useAuth()
  const navigate     = useNavigate()

  const [email, setEmail]       = useState('')
  const [password, setPassword] = useState('')
  const [errors, setErrors]     = useState({})
  const [submitting, setSub]    = useState(false)
  const [globalError, setGlobal] = useState('')

  const handleSubmit = async (e) => {
    e.preventDefault()
    setSub(true)
    setErrors({})
    setGlobal('')

    try {
      await login(email, password)
      navigate('/')
    } catch (err) {
      if (err?.validationErrors) {
        setErrors(err.validationErrors)
      } else if (err?.response?.status === 401) {
        setGlobal(t('auth.invalidCredentials'))
      } else {
        setGlobal(t('errors.serverError'))
      }
    } finally {
      setSub(false)
    }
  }

  return (
    <form onSubmit={handleSubmit} noValidate>
      {globalError && (
        <div className="alert alert-danger">{globalError}</div>
      )}

      <div className="mb-3">
        <label className="form-label" htmlFor="login-email">{t('auth.email')}</label>
        <input
          id="login-email"
          type="email"
          className={`form-control ${errors.email ? 'is-invalid' : ''}`}
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
        />
        {errors.email && <div className="invalid-feedback">{errors.email}</div>}
      </div>

      <div className="mb-3">
        <label className="form-label" htmlFor="login-password">{t('auth.password')}</label>
        <input
          id="login-password"
          type="password"
          className={`form-control ${errors.password ? 'is-invalid' : ''}`}
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          required
        />
        {errors.password && <div className="invalid-feedback">{errors.password}</div>}
      </div>

      <button className="btn btn-accent w-100" type="submit" disabled={submitting}>
        {submitting ? (
          <><span className="spinner-border spinner-border-sm me-2" />Iniciando...</>
        ) : (
          t('auth.login')
        )}
      </button>

      <p className="text-center mt-3 small">
        {t('auth.noAccount')}{' '}
        <Link to="/registro">{t('auth.register')}</Link>
      </p>
    </form>
  )
}
