// src/pages/HomePage.jsx
// Landing page: hero section + grid of featured articles.

import { useTranslation } from 'react-i18next'
import { Link } from 'react-router-dom'
import { useArticles } from '../hooks/useArticles'
import ArticleGrid from '../components/articles/ArticleGrid'

export default function HomePage() {
  const { t }                        = useTranslation()
  const { articles, isLoading, error } = useArticles()

  return (
    <>
      {/* ─── Hero ──────────────────────────────────────────────────────── */}
      <section className="hero-section text-center py-5">
        <div className="container py-4">
          <h1 className="display-4 fw-bold text-gradient-accent mb-3">
            {t('hero.title')}
          </h1>
          <p className="lead text-body-secondary mb-4">
            {t('hero.subtitle')}
          </p>
          <Link to="/articulos" className="btn btn-accent btn-lg px-5">
            {t('hero.cta')}
          </Link>
        </div>
      </section>

      {/* ─── Featured articles ─────────────────────────────────────────── */}
      <section className="container py-5">
        <h2 className="fw-bold mb-4">{t('articles:featured')}</h2>
        <ArticleGrid articles={articles} isLoading={isLoading} error={error} />
      </section>
    </>
  )
}
