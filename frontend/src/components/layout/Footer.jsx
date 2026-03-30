// src/components/layout/Footer.jsx

import { useTranslation } from 'react-i18next'

export default function Footer() {
  const { t } = useTranslation()
  const year  = new Date().getFullYear()

  return (
    <footer className="py-4 mt-auto border-top">
      <div className="container text-center">
        <p className="text-body-secondary small mb-0">
          © {year} Mundo Roblox · {t('footer.rights')}
        </p>
      </div>
    </footer>
  )
}
