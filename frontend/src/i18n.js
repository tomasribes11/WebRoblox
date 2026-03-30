// src/i18n.js
// react-i18next configuration.
// Translation JSON files live in /public/locales/{lng}/{ns}.json
// They are loaded at runtime via i18next-http-backend (no bundling needed).

import i18n from 'i18next'
import { initReactI18next } from 'react-i18next'
import HttpBackend from 'i18next-http-backend'
import LanguageDetector from 'i18next-browser-languagedetector'

i18n
  // Load translation files from /public/locales/
  .use(HttpBackend)
  // Detect browser language from localStorage, then navigator.language
  .use(LanguageDetector)
  // Connect to React
  .use(initReactI18next)
  .init({
    // Supported languages
    supportedLngs: ['es', 'en', 'fr'],
    fallbackLng: 'es',

    // Namespaces: common (nav, buttons, errors) and articles (UI strings)
    ns: ['common', 'articles'],
    defaultNS: 'common',

    // Where to load translation files from
    backend: {
      loadPath: '/locales/{{lng}}/{{ns}}.json',
    },

    // Detection order: localStorage first, then browser language
    detection: {
      order: ['localStorage', 'navigator'],
      lookupLocalStorage: 'language',
      caches: ['localStorage'],
    },

    interpolation: {
      // React already handles XSS, no need to escape here
      escapeValue: false,
    },
  })

export default i18n
