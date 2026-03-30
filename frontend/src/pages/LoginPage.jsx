// src/pages/LoginPage.jsx

import { useTranslation } from 'react-i18next'
import LoginForm from '../components/auth/LoginForm'

export default function LoginPage() {
  const { t } = useTranslation()

  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-sm-8 col-md-6 col-lg-5">
          <div className="card shadow-sm">
            <div className="card-body p-4">
              <h2 className="card-title fw-bold text-center mb-4">{t('auth.login')}</h2>
              <LoginForm />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
