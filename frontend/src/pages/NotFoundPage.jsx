// src/pages/NotFoundPage.jsx

import { Link } from 'react-router-dom'
import { useTranslation } from 'react-i18next'

export default function NotFoundPage() {
  const { t } = useTranslation()

  return (
    <div className="container py-5 text-center">
      <h1 className="display-1 fw-bold text-gradient-accent">404</h1>
      <h2 className="mb-3">{t('errors.notFound')}</h2>
      <Link to="/" className="btn btn-accent btn-lg mt-3">
        ← Volver al inicio
      </Link>
    </div>
  )
}
