// src/pages/ArticlesPage.jsx
// Shows a paginated grid of articles. Optional `category` prop filters results.
// Used directly for /articulos AND for /trucos, /guias, /noticias via App.jsx.

import { useState } from 'react'
import { useTranslation } from 'react-i18next'
import { useArticles } from '../hooks/useArticles'
import ArticleGrid from '../components/articles/ArticleGrid'

const CATEGORY_LABELS = {
  trucos:   { es: 'Trucos', en: 'Tricks',  fr: 'Astuces'    },
  guias:    { es: 'Guías',  en: 'Guides',  fr: 'Guides'      },
  noticias: { es: 'Noticias', en: 'News',  fr: 'Actualités' },
}

export default function ArticlesPage({ category = null }) {
  const { t, i18n }                    = useTranslation('articles')
  const [page, setPage]                = useState(1)
  const { articles, meta, isLoading, error } = useArticles({ category, page })

  const sectionTitle = category
    ? (CATEGORY_LABELS[category]?.[i18n.language] ?? category)
    : t('all')

  return (
    <div className="container py-5">
      <h2 className="fw-bold mb-4">{sectionTitle}</h2>

      <ArticleGrid articles={articles} isLoading={isLoading} error={error} />

      {/* Pagination */}
      {meta && meta.last_page > 1 && (
        <nav className="mt-5 d-flex justify-content-center">
          <ul className="pagination">
            <li className={`page-item ${page === 1 ? 'disabled' : ''}`}>
              <button className="page-link" onClick={() => setPage((p) => p - 1)}>
                ←
              </button>
            </li>
            {[...Array(meta.last_page)].map((_, i) => (
              <li key={i} className={`page-item ${page === i + 1 ? 'active' : ''}`}>
                <button className="page-link" onClick={() => setPage(i + 1)}>
                  {i + 1}
                </button>
              </li>
            ))}
            <li className={`page-item ${page === meta.last_page ? 'disabled' : ''}`}>
              <button className="page-link" onClick={() => setPage((p) => p + 1)}>
                →
              </button>
            </li>
          </ul>
        </nav>
      )}
    </div>
  )
}
