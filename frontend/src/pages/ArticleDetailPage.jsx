// src/pages/ArticleDetailPage.jsx
// Full article view. Reads the :slug param from the URL and fetches from API.
// Renders the HTML content from the database via dangerouslySetInnerHTML.

import { useEffect, useState } from 'react'
import { useParams, Link } from 'react-router-dom'
import { useTranslation } from 'react-i18next'
import { getArticle } from '../api/articles'
import LoadingSpinner from '../components/ui/LoadingSpinner'
import ErrorMessage from '../components/ui/ErrorMessage'

export default function ArticleDetailPage() {
  const { slug }  = useParams()
  const { i18n, t } = useTranslation('articles')

  const [article, setArticle]   = useState(null)
  const [isLoading, setLoading] = useState(true)
  const [error, setError]       = useState(null)

  useEffect(() => {
    setLoading(true)
    setError(null)

    getArticle(slug, i18n.language)
      .then((data) => setArticle(data.data))
      .catch(() => setError(t('notFound')))
      .finally(() => setLoading(false))
  }, [slug, i18n.language])

  if (isLoading) return <div className="container py-5"><LoadingSpinner /></div>
  if (error)     return <div className="container py-5"><ErrorMessage message={error} /></div>
  if (!article)  return null

  return (
    <div className="container py-5">
      <div className="row justify-content-center">
        <div className="col-lg-8">

          {/* Breadcrumb */}
          <nav aria-label="breadcrumb" className="mb-4">
            <ol className="breadcrumb">
              <li className="breadcrumb-item"><Link to="/">Inicio</Link></li>
              <li className="breadcrumb-item">
                <Link to={`/${article.category.slug}`}>{article.category.name}</Link>
              </li>
              <li className="breadcrumb-item active">{article.title}</li>
            </ol>
          </nav>

          {/* Header */}
          <span className="badge bg-accent mb-3">{article.category.name}</span>
          <h1 className="fw-bold mb-3">{article.title}</h1>
          <p className="lead text-body-secondary mb-4">{article.description}</p>

          {/* Meta */}
          <div className="d-flex gap-3 text-body-secondary small mb-4">
            <span>👁 {article.view_count} {t('views')}</span>
            {article.published_at && (
              <span>📅 {new Date(article.published_at).toLocaleDateString()}</span>
            )}
          </div>

          <hr />

          {/* Article body — content is HTML from the rich-text editor */}
          <div
            className="article-content mt-4"
            dangerouslySetInnerHTML={{ __html: article.content }}
          />

          <hr className="mt-5" />

          {/* Back button */}
          <Link to={`/${article.category.slug}`} className="btn btn-outline-secondary">
            ← {t('backToCategory', { category: article.category.name })}
          </Link>

        </div>
      </div>
    </div>
  )
}
