// src/components/auth/RegisterForm.jsx
// Bootstrap register form with server-side validation from Laravel.

import { useState } from 'react'
import { useNavigate, Link } from 'react-router-dom'
import { useTranslation } from 'react-i18next'
import { useAuth } from '../../hooks/useAuth'
import * as authApi from '../../api/auth'

export default function RegisterForm() {
  const { t }     = useTranslation()
  const { login } = useAuth()
  const navigate  = useNavigate()

  const [form, setForm]       = useState({ name: '', email: '', password: '', password_confirmation: '' })
  const [errors, setErrors]   = useState({})
  const [submitting, setSub]  = useState(false)
  const [globalError, setGlobal] = useState('')

  const update = (field) => (e) => setForm((prev) => ({ ...prev, [field]: e.target.value }))

  const handleSubmit = async (e) => {
    e.preventDefault()
    setSub(true)
    setErrors({})
    setGlobal('')

    try {
      await authApi.register(form.name, form.email, form.password, form.password_confirmation)
      // Auto-login after registration
      await login(form.email, form.password)
      navigate('/')
    } catch (err) {
      if (err?.validationErrors) {
        setErrors(err.validationErrors)
      } else {
        setGlobal(t('errors.serverError'))
      }
    } finally {
      setSub(false)
    }
  }

  const field = (name, label, type = 'text') => (
    <div className="mb-3">
      <label className="form-label" htmlFor={`reg-${name}`}>{label}</label>
      <input
        id={`reg-${name}`}
        type={type}
        className={`form-control ${errors[name] ? 'is-invalid' : ''}`}
        value={form[name]}
        onChange={update(name)}
        required
      />
      {errors[name] && <div className="invalid-feedback">{errors[name]}</div>}
    </div>
  )

  return (
    <form onSubmit={handleSubmit} noValidate>
      {globalError && <div className="alert alert-danger">{globalError}</div>}

      {field('name',                 t('auth.name'))}
      {field('email',                t('auth.email'),    'email')}
      {field('password',             t('auth.password'), 'password')}
      {field('password_confirmation', t('auth.confirmPassword'), 'password')}

      <button className="btn btn-accent w-100" type="submit" disabled={submitting}>
        {submitting ? (
          <><span className="spinner-border spinner-border-sm me-2" />Registrando...</>
        ) : (
          t('auth.register')
        )}
      </button>

      <p className="text-center mt-3 small">
        {t('auth.hasAccount')}{' '}
        <Link to="/login">{t('auth.login')}</Link>
      </p>
    </form>
  )
}
