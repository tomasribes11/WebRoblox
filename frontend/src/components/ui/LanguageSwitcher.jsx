// src/components/ui/LanguageSwitcher.jsx
// Bootstrap dropdown for switching between ES, EN, and FR.
// Changes language in react-i18next and persists to localStorage.

import { useTranslation } from 'react-i18next'

const LANGUAGES = [
  { code: 'es', label: 'ES', flag: '🇪🇸' },
  { code: 'en', label: 'EN', flag: '🇬🇧' },
  { code: 'fr', label: 'FR', flag: '🇫🇷' },
]

export default function LanguageSwitcher() {
  const { i18n } = useTranslation()
  const current  = LANGUAGES.find((l) => l.code === i18n.language) || LANGUAGES[0]

  const changeLanguage = (code) => {
    i18n.changeLanguage(code)
    localStorage.setItem('language', code)
  }

  return (
    <div className="dropdown">
      <button
        className="btn btn-outline-secondary btn-sm dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
      >
        {current.flag} {current.label}
      </button>
      <ul className="dropdown-menu dropdown-menu-end">
        {LANGUAGES.map((lang) => (
          <li key={lang.code}>
            <button
              className={`dropdown-item ${lang.code === i18n.language ? 'active' : ''}`}
              onClick={() => changeLanguage(lang.code)}
            >
              {lang.flag} {lang.label}
            </button>
          </li>
        ))}
      </ul>
    </div>
  )
}
