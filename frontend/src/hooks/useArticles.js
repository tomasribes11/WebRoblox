// src/hooks/useArticles.js
// Custom hook that fetches a paginated list of articles from the API.
// Re-fetches automatically when locale, category, or page changes.
//
// Usage:
//   const { articles, meta, isLoading, error } = useArticles({ locale, category, page })

import { useState, useEffect } from 'react'
import { useTranslation } from 'react-i18next'
import { getArticles } from '../api/articles'

export function useArticles({ category = null, page = 1 } = {}) {
  const { i18n } = useTranslation()
  const locale   = i18n.language

  const [articles, setArticles] = useState([])
  const [meta, setMeta]         = useState(null)
  const [isLoading, setLoading] = useState(true)
  const [error, setError]       = useState(null)

  useEffect(() => {
    setLoading(true)
    setError(null)

    getArticles({ locale, category, page })
      .then((data) => {
        setArticles(data.data)
        setMeta(data.meta)
      })
      .catch((err) => {
        setError(err?.message || 'Error al cargar los artículos')
      })
      .finally(() => setLoading(false))
  }, [locale, category, page])

  return { articles, meta, isLoading, error }
}
