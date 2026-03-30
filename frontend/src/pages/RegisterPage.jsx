// src/pages/RegisterPage.jsx

import { useTranslation } from 'react-i18next'
import RegisterForm from '../components/auth/RegisterForm'

export default function RegisterPage() {
  const { t } = useTranslation()

  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-sm-8 col-md-6 col-lg-5">
          <div className="card shadow-sm">
            <div className="card-body p-4">
              <h2 className="card-title fw-bold text-center mb-4">{t('auth.register')}</h2>
              <RegisterForm />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}
